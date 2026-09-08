<?php

namespace App\Http\Controllers;

use App\Models\Accounting\JournalEntry;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\Upz\ZisDistribution;
use App\Services\Accounting\Isak35ReportService;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display the workspace portal with modular cards (ISAK 35 & BAZNAS).
     */
    public function index(Isak35ReportService $reportService)
    {
        $upz = UpzProfile::first() ?? new UpzProfile();

        // 1. High-level Metrics for Card 1: Akuntansi DE ISAK 35
        $financialPosition = $reportService->getStatementOfFinancialPosition();
        $totalAssets = $financialPosition['total_assets'] ?? 0;
        $totalNetAssets = $financialPosition['total_net_assets'] ?? 0;
        $isBalanced = $financialPosition['is_balanced'] ?? true;
        $totalJournals = JournalEntry::count();

        // 2. High-level Metrics for Card 2: Pengelolaan ZIS BAZNAS (Perbaznas No. 2/2016)
        $totalZisCollected = (float) ZisCollection::sum('amount');
        $totalDistributed = (float) ZisDistribution::sum('amount');
        $totalAmilRetained = (float) ZisCollection::sum('amil_amount');
        $totalRemitted = (float) BaznasRemittance::where('status', 'verified_by_baznas')->sum('amount_remitted');
        $muzakkiCount = Muzakki::count();
        $mustahiqCount = Mustahiq::count();

        $effectiveAmilPercentage = $totalZisCollected > 0 
            ? ($totalAmilRetained / $totalZisCollected) * 100 
            : 0;

        return view('portal', compact(
            'upz',
            'totalAssets',
            'totalNetAssets',
            'isBalanced',
            'totalJournals',
            'totalZisCollected',
            'totalDistributed',
            'totalAmilRetained',
            'totalRemitted',
            'effectiveAmilPercentage',
            'muzakkiCount',
            'mustahiqCount'
        ));
    }
}
