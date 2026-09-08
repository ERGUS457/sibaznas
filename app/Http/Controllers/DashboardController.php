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
    public function index(Isak35ReportService $reportService)
    {
        $upz = UpzProfile::first() ?? new UpzProfile();

        // 1. Operational ZIS Metrics (Perbaznas No. 2/2016)
        $collectionsTotal = (float) ZisCollection::sum('amount');
        $receiptsTotal = (float) UpzReceipt::sum('amount');
        $totalZisCollected = $receiptsTotal > 0 ? ($receiptsTotal + $collectionsTotal) : $collectionsTotal;

        $totalAmilRetained = (float) ZisCollection::sum('amil_amount');

        $distTotalOld = (float) ZisDistribution::sum('amount');
        $distTotalNew = (float) NewUpzDistribution::sum('amount');
        $totalDistributed = $distTotalNew > 0 ? ($distTotalNew + $distTotalOld) : $distTotalOld;

        $totalRemittedToBaznas = (float) BaznasRemittance::where('status', 'verified_by_baznas')->sum('amount_remitted');

        // Kas ZIS Bersih yang Siap Disalurkan (Net Available ZIS Funds)
        $availableZisCash = max(0, $totalZisCollected - $totalDistributed - $totalRemittedToBaznas);

        $muzakkiCount = Muzakki::count() + Muzaki::count();
        $mustahiqCount = Mustahiq::count() + Mustahik::count();

        // Recent Activity for Feed
        $recentCollections = ZisCollection::with('muzakki')->latest('transaction_date')->take(5)->get();
        $recentDistributions = ZisDistribution::with('mustahiq')->latest('distribution_date')->take(5)->get();

        // 2. Accounting & DE ISAK 35 Overview
        $financialPosition = $reportService->getStatementOfFinancialPosition();

        return view('dashboard', compact(
            'upz',
            'totalZisCollected',
            'totalAmilRetained',
            'totalDistributed',
            'totalRemittedToBaznas',
            'availableZisCash',
            'muzakkiCount',
            'mustahiqCount',
            'recentCollections',
            'recentDistributions',
            'financialPosition'
        ));
    }
}
