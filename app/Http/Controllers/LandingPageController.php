<?php

namespace App\Http\Controllers;

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

class LandingPageController extends Controller
{
    public function index(Isak35ReportService $reportService)
    {
        $upz = UpzProfile::first() ?? new UpzProfile();

        // 1. Operational ZIS Metrics
        $collectionsTotal = (float) ZisCollection::sum('amount');
        $receiptsTotal = (float) UpzReceipt::sum('amount');
        $totalZisCollected = $receiptsTotal > 0 ? ($receiptsTotal + $collectionsTotal) : $collectionsTotal;

        $distTotalOld = (float) ZisDistribution::sum('amount');
        $distTotalNew = (float) NewUpzDistribution::sum('amount');
        $totalDistributed = $distTotalNew > 0 ? ($distTotalNew + $distTotalOld) : $distTotalOld;

        $totalRemittedToBaznas = (float) BaznasRemittance::where('status', 'verified_by_baznas')->sum('amount_remitted');
        $availableZisCash = max(0, $totalZisCollected - $totalDistributed - $totalRemittedToBaznas);

        $muzakkiCount = Muzakki::count() + Muzaki::count();
        $mustahiqCount = Mustahiq::count() + Mustahik::count();

        // 2. Financial Position Overview
        $financialPosition = $reportService->getStatementOfFinancialPosition();

        return view('landing', compact(
            'upz',
            'totalZisCollected',
            'totalDistributed',
            'totalRemittedToBaznas',
            'availableZisCash',
            'muzakkiCount',
            'mustahiqCount',
            'financialPosition'
        ));
    }
}
