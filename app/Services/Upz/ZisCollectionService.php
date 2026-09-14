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
     * Syariah: hanya zakat (maal/fitrah) berhak atas bagian amil maks 12.5% (QS At-Taubah:60, PSAK 109).
     * Infak/sedekah/DSKL/fidyah tidak dikenakan hak amil — 100% hak mustahik/program.
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

            // Hak amil hanya untuk zakat (QS At-Taubah:60, PSAK 109, Perbaznas 2/2016): zakat_maal/fitrah saja; infak/sedekah/DSKL/fidyah = 0
            $isZakat = in_array($data['fund_type'], ['zakat_maal', 'zakat_fitrah']);
            if ($isZakat) {
                $amilPercent = (isset($data['amil_percentage']) && $data['amil_percentage'] !== '' && $data['amil_percentage'] !== null)
                    ? (float) $data['amil_percentage']
                    : (float) $upz->amil_share_percentage;
                $amilPercent = min($amilPercent, 12.50);
            } else {
                $amilPercent = 0.0;
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
        $cashOrBankCode = in_array($collection->payment_method, ['kas','kas_tunai']) ? '1-1101' : '1-1103';
        $debitAccount = Account::where('code', $cashOrBankCode)->firstOrFail();

        // 2. Determine Credit Account for ZIS (Restricted Revenue)
        // Generic COA: all zakat/infak -> Pendapatan Sumbangan & Hibah (4-1300), dskl -> Lain-lain
        $revenueCode = match ($collection->fund_type) {
            'zakat_maal' => '4-1300',
            'zakat_fitrah' => '4-1300',
            'infak_terikat' => '4-1300',
            'dskl' => '4-1500',
            default => '4-1300',
        };
        $revenueAccount = Account::where('code', $revenueCode)->firstOrFail();

        // 3. Amil Account (Unrestricted Revenue)
        $amilAccount = Account::where('code', '4-1100')->firstOrFail();

        $entryCount = JournalEntry::whereYear('entry_date', Carbon::parse($collection->transaction_date)->year)->count() + 1;
        $entryNumber = sprintf('JV/%s/%04d', Carbon::parse($collection->transaction_date)->format('Ym'), $entryCount);

        $journalEntry = JournalEntry::create([
            'upz_profile_id' => $collection->upz_profile_id,
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
