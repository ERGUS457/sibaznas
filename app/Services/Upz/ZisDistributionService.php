<?php

namespace App\Services\Upz;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisDistribution;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class ZisDistributionService
{
    /**
     * Record a new ZIS distribution and create associated double-entry journal items.
     */
    public function recordDistribution(array $data, ?User $user = null): ZisDistribution
    {
        return DB::transaction(function () use ($data, $user) {
            $upz = UpzProfile::findOrFail($data['upz_profile_id']);
            $distributionDate = Carbon::parse($data['distribution_date'] ?? now());
            $amount = (float) $data['amount'];

            if ($amount <= 0) {
                throw new InvalidArgumentException('Nominal penyaluran ZIS harus lebih besar dari nol.');
            }

            // Generate Sequential Distribution Number: DST/{UPZ_CODE}/{YEAR}{MONTH}/{COUNTER}
            $yearMonth = $distributionDate->format('Ym');
            $countThisMonth = ZisDistribution::where('upz_profile_id', $upz->id)
                ->whereYear('distribution_date', $distributionDate->year)
                ->whereMonth('distribution_date', $distributionDate->month)
                ->count() + 1;

            $distributionNumber = sprintf('DST/%s/%s/%04d', $upz->code, $yearMonth, $countThisMonth);

            $distribution = ZisDistribution::create([
                'upz_profile_id' => $upz->id,
                'mustahiq_id' => $data['mustahiq_id'] ?? null,
                'distribution_number' => $distributionNumber,
                'distribution_date' => $distributionDate->toDateString(),
                'fund_type' => $data['fund_type'],
                'asnaf_category' => $data['asnaf_category'],
                'program_name' => $data['program_name'] ?? 'Bantuan Asnaf ' . ucfirst($data['asnaf_category']),
                'distribution_type' => $data['distribution_type'] ?? 'konsumtif',
                'amount' => $amount,
                'quantity_in_kind' => $data['quantity_in_kind'] ?? null,
                'unit_in_kind' => $data['unit_in_kind'] ?? null,
                'description' => $data['description'] ?? null,
                'recipient_identity_name' => $data['recipient_identity_name'] ?? null,
                'status' => 'distributed',
                'approved_by_user_id' => $user?->id,
            ]);

            // Automatic Journal Entry Creation (DE ISAK 35 Format A)
            $this->createAccountingJournal($distribution, $user);

            return $distribution;
        });
    }

    protected function createAccountingJournal(ZisDistribution $distribution, ?User $user = null): JournalEntry
    {
        // 1. Determine Expense Account based on Asnaf Category
        $expenseCode = match ($distribution->asnaf_category) {
            'fakir', 'miskin' => '5-1100',
            'fisabilillah' => '5-1200',
            'gharimin' => '5-1300',
            default => '5-1400',
        };

        if ($distribution->fund_type === 'infak_terikat') {
            $expenseCode = '5-1500';
        }

        $expenseAccount = Account::where('code', $expenseCode)->firstOrFail();

        // 2. Credit Bank / Kas Penampungan ZIS
        $creditAccount = Account::where('code', '1-1103')->firstOrFail();

        $entryCount = JournalEntry::whereYear('entry_date', Carbon::parse($distribution->distribution_date)->year)->count() + 1;
        $entryNumber = sprintf('JV/%s/%04d', Carbon::parse($distribution->distribution_date)->format('Ym'), $entryCount);

        $journalEntry = JournalEntry::create([
            'upz_profile_id' => $distribution->upz_profile_id,
            'voucher_number' => $entryNumber,
            'entry_date' => $distribution->distribution_date,
            'description' => "Penyaluran ZIS No. {$distribution->distribution_number} ({$distribution->program_name} - Asnaf " . ucfirst($distribution->asnaf_category) . ")",
            'source_module' => 'UPZ_DISTRIBUTION',
        ]);

        // Item 1: Debit Beban Penyaluran (Dengan Pembatasan)
        JournalItem::create([
            'journal_entry_id' => $journalEntry->id,
            'account_id' => $expenseAccount->id,
            'debit' => $distribution->amount,
            'credit' => 0,
            'restriction_type' => 'WITH_RESTRICTION',
        ]);

        // Item 2: Credit Kas / Bank Penampungan ZIS
        JournalItem::create([
            'journal_entry_id' => $journalEntry->id,
            'account_id' => $creditAccount->id,
            'debit' => 0,
            'credit' => $distribution->amount,
            'restriction_type' => 'WITH_RESTRICTION',
        ]);

        return $journalEntry;
    }
}
