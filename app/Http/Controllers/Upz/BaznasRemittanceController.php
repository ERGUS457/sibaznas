<?php

namespace App\Http\Controllers\Upz;

use App\Http\Controllers\Controller;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Services\OrganizationContextService;
use App\Services\Upz\BaznasRemittanceService;
use Illuminate\Http\Request;

class BaznasRemittanceController extends Controller
{
    protected BaznasRemittanceService $service;
    protected OrganizationContextService $orgContext;

    public function __construct(BaznasRemittanceService $service, OrganizationContextService $orgContext)
    {
        $this->service = $service;
        $this->orgContext = $orgContext;
    }

    public function index()
    {
        $upz = $this->orgContext->getActiveOrganization();
        $remittances = BaznasRemittance::where('upz_profile_id', $upz->id)
            ->with(['upzProfile', 'submittedBy'])
            ->latest('remittance_date')
            ->paginate(15);

        $totalRemitted = BaznasRemittance::where('upz_profile_id', $upz->id)->where('status', 'verified_by_baznas')->sum('amount_remitted');

        return view('upz.remittances.index', compact('remittances', 'totalRemitted'));
    }

    public function create()
    {
        $upz = $this->orgContext->getActiveOrganization();
        $totalCollected = ZisCollection::where('upz_profile_id', $upz->id)->sum('amount');
        $totalAmil = ZisCollection::where('upz_profile_id', $upz->id)->sum('amil_amount');
        $totalAlreadyRemitted = BaznasRemittance::where('upz_profile_id', $upz->id)->sum('amount_remitted');
        $suggestedRemittance = max(0, ($totalCollected - $totalAmil) - $totalAlreadyRemitted);

        return view('upz.remittances.create', compact('upz', 'totalCollected', 'totalAmil', 'suggestedRemittance'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upz_profile_id' => 'required|exists:upz_profiles,id',
            'remittance_date' => 'required|date',
            'period_month' => 'required|integer|between:1,12',
            'period_year' => 'required|integer|min:2020',
            'amount_remitted' => 'required|numeric|min:1',
            'total_collected' => 'nullable|numeric',
            'amil_retained' => 'nullable|numeric',
            'target_baznas_bank' => 'required|string',
            'target_baznas_account_number' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $remittance = $this->service->recordRemittance($validated, auth()->user());

        return redirect()->route('remittances.index')
            ->with('success', "Setoran ke BAZNAS No. {$remittance->remittance_number} berhasil direkam.");
    }
}
