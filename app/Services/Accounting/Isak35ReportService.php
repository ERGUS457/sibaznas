<?php

namespace App\Services\Accounting;

use App\Models\Accounting\Account;
use App\Models\Accounting\JournalItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Isak35ReportService
{
    /**
     * Batch calculate account balances using a single aggregated SQL query scoped to organization.
     */
    public function getAccountBalancesBatch(?string $startDate = null, ?string $endDate = null, ?int $upzId = null): array
    {
        $orgId = $upzId ?? auth()->user()?->upz_profile_id ?? \App\Models\Upz\UpzProfile::first()?->id;

        $query = JournalItem::query()
            ->join('journal_entries', 'journal_items.journal_entry_id', '=', 'journal_entries.id');

        if ($startDate) {
            $query->where('journal_entries.entry_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('journal_entries.entry_date', '<=', $endDate);
        }
        if ($orgId) {
            $query->where('journal_entries.upz_profile_id', $orgId);
        }

        $records = $query->select(
            'journal_items.account_id',
            DB::raw('SUM(journal_items.debit) as total_debit'),
            DB::raw('SUM(journal_items.credit) as total_credit')
        )
        ->groupBy('journal_items.account_id')
        ->get();

        $balances = [];
        foreach ($records as $row) {
            $balances[$row->account_id] = [
                'total_debit' => (float) $row->total_debit,
                'total_credit' => (float) $row->total_credit,
            ];
        }

        return $balances;
    }

    /**
     * Laporan Posisi Keuangan (Statement of Financial Position) - DE ISAK 35 Format A
     */
    public function getStatementOfFinancialPosition($asOfDate = null, ?int $upzId = null): array
    {
        if (is_int($asOfDate)) {
            $upzId = $asOfDate;
            $asOfDate = null;
        }

        $orgId = $upzId ?? auth()->user()?->upz_profile_id ?? \App\Models\Upz\UpzProfile::first()?->id;
        $asOfDate = $asOfDate ? Carbon::parse($asOfDate)->endOfDay()->toDateString() : now()->toDateString();
        $accounts = Account::active()->orderBy('code')->get();
        $batchBalances = $this->getAccountBalancesBatch(null, $asOfDate, $orgId);
        $incomeStatement = $this->getStatementOfComprehensiveIncome(null, $asOfDate, $orgId);

        // 1. Assets
        $currentAssets = [];
        $totalCurrentAssets = 0;

        $nonCurrentAssets = [];
        $totalNonCurrentAssets = 0;

        // 2. Liabilities
        $currentLiabilities = [];
        $totalCurrentLiabilities = 0;

        $nonCurrentLiabilities = [];
        $totalNonCurrentLiabilities = 0;

        // 3. Net Assets
        $unrestrictedNetAssetsAccounts = [];
        $totalUnrestrictedNetAssets = 0;

        $restrictedNetAssetsAccounts = [];
        $totalRestrictedNetAssets = 0;

        foreach ($accounts as $account) {
            $debit = $batchBalances[$account->id]['total_debit'] ?? 0;
            $credit = $batchBalances[$account->id]['total_credit'] ?? 0;
            $balance = strtoupper($account->normal_balance ?? '') === 'DEBIT' ? ($debit - $credit) : ($credit - $debit);

            switch ($account->classification) {
                case 'aset_lancar':
                    $currentAssets[] = ['account' => $account, 'balance' => $balance];
                    $totalCurrentAssets += $balance;
                    break;
                case 'aset_tidak_lancar':
                    $nonCurrentAssets[] = ['account' => $account, 'balance' => $balance];
                    $totalNonCurrentAssets += $balance;
                    break;
                case 'liabilitas_jangka_pendek':
                    $currentLiabilities[] = ['account' => $account, 'balance' => $balance];
                    $totalCurrentLiabilities += $balance;
                    break;
                case 'liabilitas_jangka_panjang':
                    $nonCurrentLiabilities[] = ['account' => $account, 'balance' => $balance];
                    $totalNonCurrentLiabilities += $balance;
                    break;
                case 'aset_bersih_tanpa_pembatasan':
                    $unrestrictedNetAssetsAccounts[] = ['account' => $account, 'balance' => $balance];
                    $totalUnrestrictedNetAssets += $balance;
                    break;
                case 'aset_bersih_dengan_pembatasan':
                    $restrictedNetAssetsAccounts[] = ['account' => $account, 'balance' => $balance];
                    $totalRestrictedNetAssets += $balance;
                    break;
            }
        }

        // Calculate Surplus / Deficit from Comprehensive Income for the period and integrate into Net Assets
        $incomeStatement = $this->getStatementOfComprehensiveIncome(null, $asOfDate, $orgId);
        $totalUnrestrictedNetAssets += $incomeStatement['change_unrestricted_net_assets'];
        $totalRestrictedNetAssets += $incomeStatement['change_restricted_net_assets'];

        $totalAssets = $totalCurrentAssets + $totalNonCurrentAssets;
        $totalLiabilities = $totalCurrentLiabilities + $totalNonCurrentLiabilities;
        $totalNetAssets = $totalUnrestrictedNetAssets + $totalRestrictedNetAssets;
        $totalLiabilitiesAndNetAssets = $totalLiabilities + $totalNetAssets;

        return [
            'as_of_date' => $asOfDate,
            'current_assets' => $currentAssets,
            'total_current_assets' => $totalCurrentAssets,
            'non_current_assets' => $nonCurrentAssets,
            'total_non_current_assets' => $totalNonCurrentAssets,
            'total_assets' => $totalAssets,
            'current_liabilities' => $currentLiabilities,
            'total_current_liabilities' => $totalCurrentLiabilities,
            'non_current_liabilities' => $nonCurrentLiabilities,
            'total_non_current_liabilities' => $totalNonCurrentLiabilities,
            'total_liabilities' => $totalLiabilities,
            'unrestricted_net_assets_accounts' => $unrestrictedNetAssetsAccounts,
            'unrestricted_net_assets_current_change' => $incomeStatement['change_unrestricted_net_assets'],
            'total_unrestricted_net_assets' => $totalUnrestrictedNetAssets,
            'restricted_net_assets_accounts' => $restrictedNetAssetsAccounts,
            'restricted_net_assets_current_change' => $incomeStatement['change_restricted_net_assets'],
            'total_restricted_net_assets' => $totalRestrictedNetAssets,
            'total_net_assets' => $totalNetAssets,
            'total_liabilities_and_net_assets' => $totalLiabilitiesAndNetAssets,
            'is_balanced' => round($totalAssets, 2) === round($totalLiabilitiesAndNetAssets, 2),
        ];
    }

    /**
     * Laporan Penghasilan Komprehensif (Statement of Comprehensive Income) - DE ISAK 35 Format A
     */
    public function getStatementOfComprehensiveIncome(?string $startDate = null, ?string $endDate = null, ?int $upzId = null): array
    {
        $orgId = $upzId ?? auth()->user()?->upz_profile_id ?? \App\Models\Upz\UpzProfile::first()?->id;
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay()->toDateString() : Carbon::now()->startOfYear()->toDateString();
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay()->toDateString() : now()->toDateString();

        $accounts = Account::active()->orderBy('code')->get();
        $batchBalances = $this->getAccountBalancesBatch($startDate, $endDate, $orgId);

        // 1. Unrestricted Activities
        $unrestrictedRevenues = [];
        $totalUnrestrictedRevenue = 0;

        $unrestrictedExpenses = [];
        $totalUnrestrictedExpense = 0;

        // 2. Restricted Activities
        $restrictedRevenues = [];
        $totalRestrictedRevenue = 0;

        $programExpenses = [];
        $totalProgramExpense = 0;

        foreach ($accounts as $account) {
            $debit = $batchBalances[$account->id]['total_debit'] ?? 0;
            $credit = $batchBalances[$account->id]['total_credit'] ?? 0;
            $balance = strtoupper($account->normal_balance ?? '') === 'DEBIT' ? ($debit - $credit) : ($credit - $debit);

            switch ($account->classification) {
                case 'pendapatan_tanpa_pembatasan':
                    $unrestrictedRevenues[] = ['account' => $account, 'balance' => $balance];
                    $totalUnrestrictedRevenue += $balance;
                    break;
                case 'beban_manajemen_umum':
                    $unrestrictedExpenses[] = ['account' => $account, 'balance' => $balance];
                    $totalUnrestrictedExpense += $balance;
                    break;
                case 'pendapatan_dengan_pembatasan':
                    $restrictedRevenues[] = ['account' => $account, 'balance' => $balance];
                    $totalRestrictedRevenue += $balance;
                    break;
                case 'beban_program':
                    $programExpenses[] = ['account' => $account, 'balance' => $balance];
                    $totalProgramExpense += $balance;
                    break;
            }
        }

        $changeUnrestricted = $totalUnrestrictedRevenue - $totalUnrestrictedExpense;
        $changeRestricted = $totalRestrictedRevenue - $totalProgramExpense;
        $totalChangeInNetAssets = $changeUnrestricted + $changeRestricted;

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'unrestricted_revenues' => $unrestrictedRevenues,
            'total_unrestricted_revenue' => $totalUnrestrictedRevenue,
            'unrestricted_expenses' => $unrestrictedExpenses,
            'total_unrestricted_expense' => $totalUnrestrictedExpense,
            'change_unrestricted_net_assets' => $changeUnrestricted,
            'restricted_revenues' => $restrictedRevenues,
            'total_restricted_revenue' => $totalRestrictedRevenue,
            'program_expenses' => $programExpenses,
            'total_program_expense' => $totalProgramExpense,
            'change_restricted_net_assets' => $changeRestricted,
            'total_change_in_net_assets' => $totalChangeInNetAssets,
        ];
    }

    /**
     * Laporan Perubahan Aset Bersih (Statement of Changes in Net Assets) - DE ISAK 35 Format A
     */
    public function getStatementOfChangesInNetAssets(?string $startDate = null, ?string $endDate = null, ?int $upzId = null): array
    {
        $orgId = $upzId ?? auth()->user()?->upz_profile_id ?? \App\Models\Upz\UpzProfile::first()?->id;
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay()->toDateString() : Carbon::now()->startOfYear()->toDateString();
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay()->toDateString() : now()->toDateString();

        $incomeStatement = $this->getStatementOfComprehensiveIncome($startDate, $endDate, $orgId);

        // Saldo awal aset bersih
        $priorBalances = $this->getAccountBalancesBatch(null, Carbon::parse($startDate)->subDay()->toDateString(), $orgId);
        $accounts = Account::active()->get();
        $beginningUnrestricted = 0;
        $beginningRestricted = 0;

        foreach ($accounts as $account) {
            $debit = $priorBalances[$account->id]['total_debit'] ?? 0;
            $credit = $priorBalances[$account->id]['total_credit'] ?? 0;
            $balance = strtoupper($account->normal_balance ?? '') === 'DEBIT' ? ($debit - $credit) : ($credit - $debit);

            if ($account->classification === 'aset_bersih_tanpa_pembatasan') {
                $beginningUnrestricted += $balance;
            } elseif ($account->classification === 'aset_bersih_dengan_pembatasan') {
                $beginningRestricted += $balance;
            }
        }

        $endingUnrestricted = $beginningUnrestricted + $incomeStatement['change_unrestricted_net_assets'];
        $endingRestricted = $beginningRestricted + $incomeStatement['change_restricted_net_assets'];

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'beginning_unrestricted' => $beginningUnrestricted,
            'beginning_restricted' => $beginningRestricted,
            'beginning_total' => $beginningUnrestricted + $beginningRestricted,
            'change_unrestricted' => $incomeStatement['change_unrestricted_net_assets'],
            'change_restricted' => $incomeStatement['change_restricted_net_assets'],
            'change_total' => $incomeStatement['total_change_in_net_assets'],
            'ending_unrestricted' => $endingUnrestricted,
            'ending_restricted' => $endingRestricted,
            'ending_total' => $endingUnrestricted + $endingRestricted,
        ];
    }

    /**
     * Laporan Arus Kas (Statement of Cash Flows) - DE ISAK 35
     */
    public function getStatementOfCashFlows(?string $startDate = null, ?string $endDate = null, ?int $upzId = null): array
    {
        $orgId = $upzId ?? auth()->user()?->upz_profile_id ?? \App\Models\Upz\UpzProfile::first()?->id;
        $startDate = $startDate ? Carbon::parse($startDate)->startOfDay()->toDateString() : Carbon::now()->startOfYear()->toDateString();
        $endDate = $endDate ? Carbon::parse($endDate)->endOfDay()->toDateString() : now()->toDateString();

        $income = $this->getStatementOfComprehensiveIncome($startDate, $endDate, $orgId);
        $periodBalances = $this->getAccountBalancesBatch($startDate, $endDate, $orgId);
        $allPriorBalances = $this->getAccountBalancesBatch(null, Carbon::parse($startDate)->subDay()->toDateString(), $orgId);
        $allEndBalances = $this->getAccountBalancesBatch(null, $endDate, $orgId);

        // Kas dari Aktivitas Operasi
        $cashFromZisCollections = $income['total_restricted_revenue'];
        $cashFromAmilRevenue = $income['total_unrestricted_revenue'];
        $cashPaidToMustahiq = $income['total_program_expense'];
        $cashPaidToAmilExpenses = $income['total_unrestricted_expense'];

        $netCashFromOperating = ($cashFromZisCollections + $cashFromAmilRevenue) - ($cashPaidToMustahiq + $cashPaidToAmilExpenses);

        // Kas dari Aktivitas Investasi (Pembelian Aset Tetap 1-2101)
        $equipmentAccount = Account::where('code', '1-2101')->first();
        $netCashFromInvesting = 0;
        if ($equipmentAccount && isset($periodBalances[$equipmentAccount->id])) {
            $netCashFromInvesting = -($periodBalances[$equipmentAccount->id]['total_debit'] - $periodBalances[$equipmentAccount->id]['total_credit']);
        }

        // Kas dari Aktivitas Pendanaan (Penyetoran ke BAZNAS 2-1101)
        $remittancePayable = Account::where('code', '2-1101')->first();
        $netCashFromFinancing = 0;
        if ($remittancePayable && isset($periodBalances[$remittancePayable->id])) {
            $netCashFromFinancing = -($periodBalances[$remittancePayable->id]['total_debit'] - $periodBalances[$remittancePayable->id]['total_credit']);
        }

        $netCashChange = $netCashFromOperating + $netCashFromInvesting + $netCashFromFinancing;

        // Saldo Kas Awal & Akhir
        $cashAccounts = Account::active()->where('category', 'ASSET')->where('code', 'like', '1-11%')->get();
        $beginningCash = 0;
        $endingCash = 0;

        foreach ($cashAccounts as $cashAcc) {
            $begDebit = $allPriorBalances[$cashAcc->id]['total_debit'] ?? 0;
            $begCredit = $allPriorBalances[$cashAcc->id]['total_credit'] ?? 0;
            $beginningCash += ($begDebit - $begCredit);

            $endDebit = $allEndBalances[$cashAcc->id]['total_debit'] ?? 0;
            $endCredit = $allEndBalances[$cashAcc->id]['total_credit'] ?? 0;
            $endingCash += ($endDebit - $endCredit);
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'operating_activities' => [
                'cash_from_zis' => $cashFromZisCollections,
                'cash_from_amil' => $cashFromAmilRevenue,
                'cash_paid_mustahiq' => $cashPaidToMustahiq,
                'cash_paid_amil' => $cashPaidToAmilExpenses,
                'net_cash' => $netCashFromOperating,
            ],
            'investing_activities' => [
                'net_cash' => $netCashFromInvesting,
            ],
            'financing_activities' => [
                'net_cash' => $netCashFromFinancing,
            ],
            'net_cash_change' => $netCashChange,
            'beginning_cash' => $beginningCash,
            'ending_cash' => $endingCash,
        ];
    }
}
