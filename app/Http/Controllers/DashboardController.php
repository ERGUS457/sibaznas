<?php

namespace App\Http\Controllers;

use App\Models\Accounting\JournalEntry;
use App\Models\Mustahik;
use App\Models\Muzaki;
use App\Models\UpzDistribution as NewUpzDistribution;
use App\Models\UpzReceipt;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\Upz\ZisDistribution;
use App\Services\Accounting\Isak35ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Default dashboard route redirects to multi-module portal.
     */
    public function index()
    {
        return redirect()->route('portal');
    }

    /**
     * Dedicated Workspace: Akuntansi Keuangan Organisasi (DE ISAK 35)
     */
    public function indexIsak35(Isak35ReportService $reportService)
    {
        $upz = UpzProfile::first() ?? new UpzProfile();
        $financialPosition = $reportService->getStatementOfFinancialPosition();
        $recentJournals = JournalEntry::latest('entry_date')->take(8)->get();

        return view('dashboard-isak35', compact(
            'upz',
            'financialPosition',
            'recentJournals'
        ));
    }

    /**
     * Dedicated Workspace: Pengelolaan & Pelaporan Zakat (BAZNAS RI)
     */
    public function indexBaznas()
    {
        $upz = UpzProfile::first() ?? new UpzProfile();

        // Operational ZIS Metrics (Perbaznas No. 2/2016)
        $collectionsTotal = (float) ZisCollection::sum('amount');
        $receiptsTotal = (float) UpzReceipt::sum('amount');
        $totalZisCollected = $receiptsTotal > 0 ? ($receiptsTotal + $collectionsTotal) : $collectionsTotal;

        $totalAmilRetained = (float) ZisCollection::sum('amil_amount');

        $distTotalOld = (float) ZisDistribution::sum('amount');
        $distTotalNew = (float) NewUpzDistribution::sum('amount');
        $totalDistributed = $distTotalNew > 0 ? ($distTotalNew + $distTotalOld) : $distTotalOld;

        $totalRemittedToBaznas = (float) BaznasRemittance::where('status', 'verified_by_baznas')->sum('amount_remitted');

        // Net Available ZIS Funds
        $availableZisCash = max(0, $totalZisCollected - $totalDistributed - $totalRemittedToBaznas);

        $effectiveAmilPercentage = $totalZisCollected > 0 
            ? ($totalAmilRetained / $totalZisCollected) * 100 
            : 0;

        $muzakkiCount = Muzakki::count() + Muzaki::count();
        $mustahiqCount = Mustahiq::count() + Mustahik::count();

        // Recent Activity
        $recentCollections = ZisCollection::with('muzakki')->latest('transaction_date')->take(5)->get();
        $recentDistributions = ZisDistribution::with('mustahiq')->latest('distribution_date')->take(5)->get();

        return view('dashboard-baznas', compact(
            'upz',
            'totalZisCollected',
            'totalAmilRetained',
            'totalDistributed',
            'totalRemittedToBaznas',
            'availableZisCash',
            'effectiveAmilPercentage',
            'muzakkiCount',
            'mustahiqCount',
            'recentCollections',
            'recentDistributions'
        ));
    }
}
