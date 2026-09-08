<?php

namespace App\Services\Upz;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ZisCollectionService
{
    /**
     * Record a new ZIS collection and automatically generate double-entry journal items.
     */
    public function recordCollection(array $data, ?User $user = null): ZisCollection
    {
        return DB::transaction(function () use ($data, $user) {
            $upz = UpzProfile::findOrFail($data['upz_profile_id']);
            $transactionDate = Carbon::parse($data['transaction_date'] ?? now());
            $amount = (float) $data['amount'];

            if ($amount <= 0) {
                throw new InvalidArgumentException('Nominal pengumpulan ZIS harus lebih besar dari nol.');
            }

            // Amil percentage calculation (capped at 12.5% per Perbaznas No. 2/2016 for zakat)
            $amilPercent = isset($data['amil_percentage']) 
                ? (float) $data['amil_percentage'] 
                : (float) $upz->amil_share_percentage;
            
            if ($amilPercent > 12.50 && in_array($data['fund_type'], ['zakat_maal', 'zakat_fitrah'])) {
                throw new InvalidArgumentException('Hak amil untuk dana zakat tidak boleh melebihi 12.50% sesuai syariah dan regulasi BAZNAS.');
            }

            $amilAmount = round(($amount * $amilPercent) / 100, 2);
            $netFundAmount = round($amount - $amilAmount, 2);

            // Generate Sequential BSZ Number: BSZ/{UPZ_CODE}/{YEAR}{MONTH}/{COUNTER}
            $yearMonth = $transactionDate->format('Ym');
            $countThisMonth = ZisCollection::where('upz_profile_id', $upz->id)
                ->whereYear('transaction_date', $transactionDate->year)
                ->whereMonth('transaction_date', $transactionDate->month)
                ->count() + 1;

            $bszNumber = sprintf('BSZ/%s/%s/%04d', $upz->code, $yearMonth, $countThisMonth);

            $collection = ZisCollection::create([
                'upz_profile_id' => $upz->id,
                'muzakki_id' => $data['muzakki_id'],
                'bsz_number' => $bszNumber,
                'transaction_date' => $transactionDate->toDateString(),
                'fund_type' => $data['fund_type'],
                'fund_subtype' => $data['fund_subtype'] ?? null,
                'payment_method' => $data['payment_method'] ?? 'transfer_bank',
                'amount' => $amount,
                'quantity_in_kind' => $data['quantity_in_kind'] ?? null,
                'unit_in_kind' => $data['unit_in_kind'] ?? null,
                'amil_percentage' => $amilPercent,
                'amil_amount' => $amilAmount,
                'net_fund_amount' => $netFundAmount,
                'description' => $data['description'] ?? ("Penerimaan " . $data['fund_type'] . " dari Muzakki"),
                'reference_number' => $data['reference_number'] ?? null,
                'status' => 'verified',
                'received_by_user_id' => $user?->id,
            ]);

            // Automatic Journal Entry Creation (DE ISAK 35 Format A)
            $this->createAccountingJournal($collection, $user);

            return $collection;
        });
    }

    protected function createAccountingJournal(ZisCollection $collection, ?User $user = null): JournalEntry
    {
        // 1. Determine Debit Account (Kas or Bank)
        $cashOrBankCode = $collection->payment_method === 'kas_tunai' ? '1-1101' : '1-1103';
        $debitAccount = Account::where('code', $cashOrBankCode)->firstOrFail();

        // 2. Determine Credit Account for ZIS (Restricted Revenue)
        $revenueCode = match ($collection->fund_type) {
            'zakat_maal' => '4-2100',
            'zakat_fitrah' => '4-2200',
            'infak_terikat' => '4-2300',
            'dskl' => '4-2400',
            default => '4-2100',
        };
        $revenueAccount = Account::where('code', $revenueCode)->firstOrFail();

        // 3. Amil Account (Unrestricted Revenue)
        $amilAccount = Account::where('code', '4-1100')->firstOrFail();

        $entryCount = JournalEntry::whereYear('entry_date', Carbon::parse($collection->transaction_date)->year)->count() + 1;
        $entryNumber = sprintf('JV/%s/%04d', Carbon::parse($collection->transaction_date)->format('Ym'), $entryCount);

        $journalEntry = JournalEntry::create([
            'voucher_number' => $entryNumber,
            'entry_date' => $collection->transaction_date,
            'description' => "Penerimaan {$collection->fund_type_label} No. {$collection->bsz_number} (Muzakki: {$collection->muzakki->name})",
            'source_module' => 'UPZ_RECEIPT',
        ]);

        // Item 1: Debit Kas / Bank
        JournalItem::create([
            'journal_entry_id' => $journalEntry->id,
            'account_id' => $debitAccount->id,
            'debit' => $collection->amount,
            'credit' => 0,
            'restriction_type' => 'WITH_RESTRICTION',
        ]);

        // Item 2: Credit Bagian Mustahiq (Dengan Pembatasan)
        if ($collection->net_fund_amount > 0) {
            JournalItem::create([
                'journal_entry_id' => $journalEntry->id,
                'account_id' => $revenueAccount->id,
                'debit' => 0,
                'credit' => $collection->net_fund_amount,
                'restriction_type' => 'WITH_RESTRICTION',
            ]);
        }

        // Item 3: Credit Hak Amil (Tanpa Pembatasan)
        if ($collection->amil_amount > 0) {
            JournalItem::create([
                'journal_entry_id' => $journalEntry->id,
                'account_id' => $amilAccount->id,
                'debit' => 0,
                'credit' => $collection->amil_amount,
                'restriction_type' => 'WITHOUT_RESTRICTION',
            ]);
        }

        return $journalEntry;
    }
}
