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
use App\Services\OrganizationContextService;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display the workspace portal with modular cards (ISAK 35 & BAZNAS).
     */
    public function index(Isak35ReportService $reportService, OrganizationContextService $orgContext)
    {
        $upz = $orgContext->getActiveOrganization();
        $allOrganizations = $orgContext->getAllOrganizations();

        // 1. High-level Metrics for Card 1: Akuntansi DE ISAK 35
        $financialPosition = $reportService->getStatementOfFinancialPosition(null, $upz->id);
        $totalAssets = $financialPosition['total_assets'] ?? 0;
        $totalNetAssets = $financialPosition['total_net_assets'] ?? 0;
        $isBalanced = $financialPosition['is_balanced'] ?? true;
        $totalJournals = JournalEntry::where('upz_profile_id', $upz->id)->count();

        // 2. High-level Metrics for Card 2: Pengelolaan ZIS BAZNAS (Perbaznas No. 2/2016)
        $stats = $orgContext->getStatistics($upz->id);
        $totalZisCollected = $stats['total_zis_collected'];
        $totalDistributed = $stats['total_distributed'];
        $totalAmilRetained = $stats['total_amil_retained'];
        $totalRemitted = $stats['total_remitted'];
        $muzakkiCount = $stats['muzakki_count'];
        $mustahiqCount = $stats['mustahiq_count'];
        $effectiveAmilPercentage = $stats['effective_amil_percentage'];

        return view('portal', compact(
            'upz',
            'allOrganizations',
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
