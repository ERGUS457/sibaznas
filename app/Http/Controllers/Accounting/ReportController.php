<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\Upz\ZisDistribution;
use App\Services\Accounting\Isak35ReportService;
use App\Services\OrganizationContextService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected Isak35ReportService $reportService;
    protected OrganizationContextService $orgContext;

    public function __construct(Isak35ReportService $reportService, OrganizationContextService $orgContext)
    {
        $this->reportService = $reportService;
        $this->orgContext = $orgContext;
    }

    /**
     * 1. Laporan Posisi Keuangan - DE ISAK 35 Format A
     */
    public function financialPosition(Request $request)
    {
        $asOfDate = $request->input('as_of_date', now()->toDateString());
        $upz = $this->orgContext->getActiveOrganization();
        $report = $this->reportService->getStatementOfFinancialPosition($asOfDate, $upz->id);

        return view('reports.financial-position', compact('report', 'upz', 'asOfDate'));
    }

    /**
     * 2. Laporan Penghasilan Komprehensif - DE ISAK 35 Format A
     */
    public function comprehensiveIncome(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = $this->orgContext->getActiveOrganization();
        $report = $this->reportService->getStatementOfComprehensiveIncome($startDate, $endDate, $upz->id);

        return view('reports.comprehensive-income', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 3. Laporan Perubahan Aset Bersih - DE ISAK 35 Format A
     */
    public function netAssets(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = $this->orgContext->getActiveOrganization();
        $report = $this->reportService->getStatementOfChangesInNetAssets($startDate, $endDate, $upz->id);

        return view('reports.net-assets', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 4. Laporan Arus Kas - DE ISAK 35
     */
    public function cashFlow(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = $this->orgContext->getActiveOrganization();
        $report = $this->reportService->getStatementOfCashFlows($startDate, $endDate, $upz->id);

        return view('reports.cash-flow', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 5. Laporan Kepatuhan Tata Kerja UPZ BAZNAS (Perbaznas No. 2/2016)
     */
    public function perbaznasCompliance(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $collectionsByFund = ZisCollection::where('upz_profile_id', $upz->id)
            ->whereYear('transaction_date', $year)
            ->selectRaw('fund_type, COUNT(*) as total_tx, SUM(amount) as total_amount, SUM(amil_amount) as total_amil, SUM(net_fund_amount) as total_net')
            ->groupBy('fund_type')
            ->get();

        $distributionsByAsnaf = ZisDistribution::where('upz_profile_id', $upz->id)
            ->whereYear('distribution_date', $year)
            ->selectRaw('asnaf_category, COUNT(*) as total_tx, SUM(amount) as total_amount')
            ->groupBy('asnaf_category')
            ->get();

        $remittances = BaznasRemittance::where('upz_profile_id', $upz->id)
            ->where('period_year', $year)
            ->get();

        $grandTotalCollected = ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->sum('amount');
        $grandTotalAmil = ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->sum('amil_amount');
        $grandTotalDistributed = ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->sum('amount');
        $grandTotalRemitted = BaznasRemittance::where('upz_profile_id', $upz->id)->where('period_year', $year)->where('status', 'verified_by_baznas')->sum('amount_remitted');

        $effectiveAmilPercentage = $grandTotalCollected > 0 ? ($grandTotalAmil / $grandTotalCollected) * 100 : 0;
        $complianceStatus = ($effectiveAmilPercentage <= 12.50) ? 'PATUH (COMPLIANT) Sesuai Perbaznas No. 2/2016' : 'PERINGATAN: Melebihi Batas Maksimum Amil 12.5%';

        return view('reports.perbaznas-compliance', compact(
            'upz',
            'year',
            'collectionsByFund',
            'distributionsByAsnaf',
            'remittances',
            'grandTotalCollected',
            'grandTotalAmil',
            'grandTotalDistributed',
            'grandTotalRemitted',
            'effectiveAmilPercentage',
            'complianceStatus'
        ));
    }

    /**
     * Lampiran I Perbaznas 2/2016: Rencana Penerimaan
     */
    public function perbaznasLampiran1(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $zakatMalPerorangan = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->where('fund_type', 'zakat_mal_perorangan')->sum('amount');
        $zakatMalBadan = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->where('fund_type', 'zakat_mal_badan')->sum('amount');
        $zakatFitrah = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->where('fund_type', 'zakat_fitrah')->sum('amount');
        $totalZakat = $zakatMalPerorangan + $zakatMalBadan + $zakatFitrah;

        $infakSedekah = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->where('fund_type', 'infak_sedekah')->sum('amount');
        $dskl = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->where('fund_type', 'dskl')->sum('amount');
        $totalPenerimaan = $totalZakat + $infakSedekah + $dskl;

        return view('reports.perbaznas.lampiran1', compact(
            'upz', 'year', 'zakatMalPerorangan', 'zakatMalBadan', 'zakatFitrah', 'totalZakat', 'infakSedekah', 'dskl', 'totalPenerimaan'
        ));
    }

    /**
     * Lampiran II Perbaznas 2/2016: Pendistribusian Berdasarkan Asnaf
     */
    public function perbaznasLampiran2(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $asnafs = ['fakir', 'miskin', 'amil', 'mualaf', 'riqab', 'gharimin', 'fisabilillah', 'ibnu_sabil'];
        $distData = [];

        foreach ($asnafs as $asnaf) {
            $distData[$asnaf] = [
                'zakat' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('asnaf_category', $asnaf)->where('fund_type', 'LIKE', '%zakat%')->sum('amount'),
                'infak' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('asnaf_category', $asnaf)->where('fund_type', 'infak_sedekah')->sum('amount'),
                'dskl' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('asnaf_category', $asnaf)->where('fund_type', 'dskl')->sum('amount'),
            ];
            // If fund_type not specified strictly on legacy records, default to zakat
            $totalAsnaf = (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('asnaf_category', $asnaf)->sum('amount');
            if ($distData[$asnaf]['zakat'] == 0 && $distData[$asnaf]['infak'] == 0 && $distData[$asnaf]['dskl'] == 0 && $totalAsnaf > 0) {
                $distData[$asnaf]['zakat'] = $totalAsnaf;
            }
        }

        $totalZakat = array_sum(array_column($distData, 'zakat'));
        $totalInfak = array_sum(array_column($distData, 'infak'));
        $totalDskl = array_sum(array_column($distData, 'dskl'));
        $grandTotal = $totalZakat + $totalInfak + $totalDskl;

        return view('reports.perbaznas.lampiran2', compact('upz', 'year', 'distData', 'totalZakat', 'totalInfak', 'totalDskl', 'grandTotal'));
    }

    /**
     * Lampiran III Perbaznas 2/2016: Pendistribusian Berdasarkan Program
     */
    public function perbaznasLampiran3(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $programs = ['pendidikan', 'kesehatan', 'kemanusiaan', 'ekonomi', 'dakwah_advokasi'];
        $progData = [];

        foreach ($programs as $prog) {
            $progData[$prog] = [
                'zakat' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('program_name', 'LIKE', "%{$prog}%")->where('fund_type', 'LIKE', '%zakat%')->sum('amount'),
                'infak' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('program_name', 'LIKE', "%{$prog}%")->where('fund_type', 'infak_sedekah')->sum('amount'),
                'dskl' => (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('program_name', 'LIKE', "%{$prog}%")->where('fund_type', 'dskl')->sum('amount'),
            ];
            $totalProg = (float) ZisDistribution::where('upz_profile_id', $upz->id)->whereYear('distribution_date', $year)->where('program_name', 'LIKE', "%{$prog}%")->sum('amount');
            if ($progData[$prog]['zakat'] == 0 && $progData[$prog]['infak'] == 0 && $progData[$prog]['dskl'] == 0 && $totalProg > 0) {
                $progData[$prog]['zakat'] = $totalProg;
            }
        }

        $totalZakat = array_sum(array_column($progData, 'zakat'));
        $totalInfak = array_sum(array_column($progData, 'infak'));
        $totalDskl = array_sum(array_column($progData, 'dskl'));
        $grandTotal = $totalZakat + $totalInfak + $totalDskl;

        return view('reports.perbaznas.lampiran3', compact('upz', 'year', 'progData', 'totalZakat', 'totalInfak', 'totalDskl', 'grandTotal'));
    }

    /**
     * Lampiran V Perbaznas 2/2016: Penerimaan dan Penggunaan Dana Operasional
     */
    public function perbaznasLampiran5(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $amilFromZakat = (float) ZisCollection::where('upz_profile_id', $upz->id)->whereYear('transaction_date', $year)->sum('amil_amount');
        $institutionalGrant = 0.0;
        $totalPenerimaanOperasional = $amilFromZakat + $institutionalGrant;

        // Operating expenses from journal or estimate
        $employeeExpenses = (float) \App\Models\Accounting\JournalItem::whereHas('account', fn($q) => $q->where('code', 'LIKE', '5.1.01%'))
            ->whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id)->whereYear('entry_date', $year))
            ->sum('debit');
        $adminExpenses = (float) \App\Models\Accounting\JournalItem::whereHas('account', fn($q) => $q->where('code', 'LIKE', '5.1.02%'))
            ->whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id)->whereYear('entry_date', $year))
            ->sum('debit');
        $depreciationExpenses = (float) \App\Models\Accounting\JournalItem::whereHas('account', fn($q) => $q->where('code', 'LIKE', '5.1.03%'))
            ->whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id)->whereYear('entry_date', $year))
            ->sum('debit');

        $totalPenggunaanOperasional = $employeeExpenses + $adminExpenses + $depreciationExpenses;

        return view('reports.perbaznas.lampiran5', compact(
            'upz', 'year', 'amilFromZakat', 'institutionalGrant', 'totalPenerimaanOperasional',
            'employeeExpenses', 'adminExpenses', 'depreciationExpenses', 'totalPenggunaanOperasional'
        ));
    }

    /**
     * Lampiran VII Perbaznas 2/2016: Laporan Pendistribusian dan Pendayagunaan Dana
     */
    public function perbaznasLampiran7(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $upz = $this->orgContext->getActiveOrganization();

        $distributions = ZisDistribution::with('mustahiq')
            ->where('upz_profile_id', $upz->id)
            ->whereYear('distribution_date', $year)
            ->when($month, fn($q) => $q->whereMonth('distribution_date', $month))
            ->orderBy('distribution_date')
            ->get();

        $totalDana = $distributions->sum('amount');

        return view('reports.perbaznas.lampiran7', compact('upz', 'month', 'year', 'distributions', 'totalDana'));
    }
}
