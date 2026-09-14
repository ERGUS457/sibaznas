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

class DashboardController extends Controller
{
    /**
     * Ambil UPZ milik user yang sedang login.
     * Superadmin mendapatkan UPZ pertama jika belum memiliki UPZ sendiri.
     */
    protected function getUpz(): UpzProfile
    {
        $user = auth()->user();

        if ($user->upzProfile) {
            return $user->upzProfile;
        }

        // Superadmin fallback ke UPZ pertama (untuk monitoring)
        return UpzProfile::firstOrFail();
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
        $upz = $this->getUpz();
        $financialPosition = $reportService->getStatementOfFinancialPosition(null, $upz->id);
        $recentJournals = JournalEntry::where('upz_profile_id', $upz->id)
            ->latest('entry_date')
            ->take(8)
            ->get();

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
        $upz = $this->getUpz();
        $id  = $upz->id;

        $totalZisCollected    = (float) ZisCollection::where('upz_profile_id', $id)->sum('amount');
        $totalAmilRetained    = (float) ZisCollection::where('upz_profile_id', $id)->sum('amil_amount');
        $totalDistributed     = (float) ZisDistribution::where('upz_profile_id', $id)->sum('amount');
        $totalRemittedToBaznas = (float) BaznasRemittance::where('upz_profile_id', $id)
            ->where('status', 'verified_by_baznas')
            ->sum('amount_remitted');
        $availableZisCash     = max(0, $totalZisCollected - $totalDistributed - $totalRemittedToBaznas);
        $effectiveAmilPercentage = $totalZisCollected > 0
            ? ($totalAmilRetained / $totalZisCollected) * 100
            : 0;
        $muzakkiCount  = Muzakki::where('upz_profile_id', $id)->count();
        $mustahiqCount = Mustahiq::where('upz_profile_id', $id)->count();

        $recentCollections   = ZisCollection::where('upz_profile_id', $id)
            ->with('muzakki')
            ->latest('transaction_date')
            ->take(5)
            ->get();
        $recentDistributions = ZisDistribution::where('upz_profile_id', $id)
            ->with('mustahiq')
            ->latest('distribution_date')
            ->take(5)
            ->get();

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
