<?php

namespace App\Services\Upz;

use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\UpzProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class BaznasRemittanceService
{
    /**
     * Record a new remittance to BAZNAS and create associated accounting journal items.
     */
    public function recordRemittance(array $data, ?User $user = null): BaznasRemittance
    {
        return DB::transaction(function () use ($data, $user) {
            $upz = UpzProfile::findOrFail($data['upz_profile_id']);
            $remittanceDate = Carbon::parse($data['remittance_date'] ?? now());
            $amountRemitted = (float) $data['amount_remitted'];

            if ($amountRemitted <= 0) {
                throw new InvalidArgumentException('Nominal setoran ke BAZNAS harus lebih besar dari nol.');
            }

            $year = (int) ($data['period_year'] ?? $remittanceDate->year);
            $month = (int) ($data['period_month'] ?? $remittanceDate->month);

            // Generate Sequential Remittance Number: SET/BAZNAS/{YEAR}{MONTH}/{COUNTER}
            $countThisYear = BaznasRemittance::where('upz_profile_id', $upz->id)
                ->where('period_year', $year)
                ->count() + 1;

            $remittanceNumber = sprintf('SET/BAZNAS/%04d%02d/%03d', $year, $month, $countThisYear);

            $remittance = BaznasRemittance::create([
                'upz_profile_id' => $upz->id,
                'remittance_number' => $remittanceNumber,
                'remittance_date' => $remittanceDate->toDateString(),
                'period_month' => $month,
                'period_year' => $year,
                'total_collected' => $data['total_collected'] ?? $amountRemitted,
                'amil_retained' => $data['amil_retained'] ?? 0,
                'amount_remitted' => $amountRemitted,
                'target_baznas_bank' => $data['target_baznas_bank'] ?? 'Bank Syariah Indonesia (BSI) BAZNAS',
                'target_baznas_account_number' => $data['target_baznas_account_number'] ?? '7001122334',
                'proof_file_path' => $data['proof_file_path'] ?? null,
                'status' => $data['status'] ?? 'submitted',
                'notes' => $data['notes'] ?? null,
                'submitted_by_user_id' => $user?->id,
            ]);

            // Automatic Accounting Journal Creation
            $this->createAccountingJournal($remittance, $user);

            return $remittance;
        });
    }

    protected function createAccountingJournal(BaznasRemittance $remittance, ?User $user = null): JournalEntry
    {
        // 1. Debit Utang Penyetoran BAZNAS (or direct reduction)
        $debitAccount = Account::where('code', '2-1101')->firstOrFail();

        // 2. Credit Bank Penampungan ZIS
        $creditAccount = Account::where('code', '1-1103')->firstOrFail();

        $entryCount = JournalEntry::whereYear('entry_date', Carbon::parse($remittance->remittance_date)->year)->count() + 1;
        $entryNumber = sprintf('JV/%s/%04d', Carbon::parse($remittance->remittance_date)->format('Ym'), $entryCount);

        $journalEntry = JournalEntry::create([
            'upz_profile_id' => $remittance->upz_profile_id,
            'voucher_number' => $entryNumber,
            'entry_date' => $remittance->remittance_date,
            'description' => "Penyetoran ZIS ke BAZNAS No. {$remittance->remittance_number} (Periode {$remittance->period_label})",
            'source_module' => 'UPZ_DISTRIBUTION',
        ]);

        // Item 1: Debit Utang Penyetoran ke BAZNAS
        JournalItem::create([
            'journal_entry_id' => $journalEntry->id,
            'account_id' => $debitAccount->id,
            'debit' => $remittance->amount_remitted,
            'credit' => 0,
            'restriction_type' => 'WITH_RESTRICTION',
        ]);

        // Item 2: Credit Rekening Bank Penampungan ZIS
        JournalItem::create([
            'journal_entry_id' => $journalEntry->id,
            'account_id' => $creditAccount->id,
            'debit' => 0,
            'credit' => $remittance->amount_remitted,
            'restriction_type' => 'WITH_RESTRICTION',
        ]);

        return $journalEntry;
    }
}
