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

class DashboardController extends Controller
{
    protected OrganizationContextService $orgContext;

    public function __construct(OrganizationContextService $orgContext)
    {
        $this->orgContext = $orgContext;
    }

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
        $upz = $this->orgContext->getActiveOrganization();
        $financialPosition = $reportService->getStatementOfFinancialPosition(null, $upz->id);
        $recentJournals = JournalEntry::where('upz_profile_id', $upz->id)->latest('entry_date')->take(8)->get();

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
        $upz = $this->orgContext->getActiveOrganization();
        $stats = $this->orgContext->getStatistics($upz->id);

        $totalZisCollected = $stats['total_zis_collected'];
        $totalAmilRetained = $stats['total_amil_retained'];
        $totalDistributed = $stats['total_distributed'];
        $totalRemittedToBaznas = $stats['total_remitted_to_baznas'];
        $availableZisCash = $stats['available_zis_cash'];
        $effectiveAmilPercentage = $stats['effective_amil_percentage'];
        $muzakkiCount = $stats['muzakki_count'];
        $mustahiqCount = $stats['mustahiq_count'];

        // Recent Activity for this active organization
        $recentCollections = ZisCollection::where('upz_profile_id', $upz->id)->with('muzakki')->latest('transaction_date')->take(5)->get();
        $recentDistributions = ZisDistribution::where('upz_profile_id', $upz->id)->with('mustahiq')->latest('distribution_date')->take(5)->get();

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
