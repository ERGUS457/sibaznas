<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\Upz\ZisDistribution;
use App\Services\Accounting\Isak35ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected Isak35ReportService $reportService;

    public function __construct(Isak35ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * 1. Laporan Posisi Keuangan - DE ISAK 35 Format A
     */
    public function financialPosition(Request $request)
    {
        $asOfDate = $request->input('as_of_date', now()->toDateString());
        $upz = UpzProfile::first() ?? new UpzProfile();
        $report = $this->reportService->getStatementOfFinancialPosition($asOfDate);

        return view('reports.financial-position', compact('report', 'upz', 'asOfDate'));
    }

    /**
     * 2. Laporan Penghasilan Komprehensif - DE ISAK 35 Format A
     */
    public function comprehensiveIncome(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = UpzProfile::first() ?? new UpzProfile();
        $report = $this->reportService->getStatementOfComprehensiveIncome($startDate, $endDate);

        return view('reports.comprehensive-income', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 3. Laporan Perubahan Aset Bersih - DE ISAK 35 Format A
     */
    public function netAssets(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = UpzProfile::first() ?? new UpzProfile();
        $report = $this->reportService->getStatementOfChangesInNetAssets($startDate, $endDate);

        return view('reports.net-assets', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 4. Laporan Arus Kas - DE ISAK 35
     */
    public function cashFlow(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfYear()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());
        $upz = UpzProfile::first() ?? new UpzProfile();
        $report = $this->reportService->getStatementOfCashFlows($startDate, $endDate);

        return view('reports.cash-flow', compact('report', 'upz', 'startDate', 'endDate'));
    }

    /**
     * 5. Laporan Kepatuhan Tata Kerja UPZ BAZNAS (Perbaznas No. 2/2016)
     */
    public function perbaznasCompliance(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $upz = UpzProfile::first() ?? new UpzProfile();

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
}
