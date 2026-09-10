<?php

namespace App\Http\Controllers\Upz;

use App\Http\Controllers\Controller;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisDistribution;
use App\Services\Upz\ZisDistributionService;
use Illuminate\Http\Request;

class ZisDistributionController extends Controller
{
    protected ZisDistributionService $service;

    public function __construct(ZisDistributionService $service)
    {
        $this->service = $service;
    }

    protected function getUpz(): UpzProfile
    {
        $user = auth()->user();
        return $user->upzProfile ?? UpzProfile::firstOrFail();
    }

    public function index(Request $request)
    {
        $upz   = $this->getUpz();
        $query = ZisDistribution::where('upz_profile_id', $upz->id)
            ->with(['mustahiq', 'upzProfile'])
            ->latest('distribution_date');

        if ($request->filled('asnaf_category')) {
            $query->where('asnaf_category', $request->asnaf_category);
        }

        $distributions    = $query->paginate(15)->withQueryString();
        $totalDistributed = ZisDistribution::where('upz_profile_id', $upz->id)->sum('amount');

        return view('upz.distributions.index', compact('distributions', 'totalDistributed'));
    }

    public function create()
    {
        $upz       = $this->getUpz();
        $mustahiqs = Mustahiq::where('upz_profile_id', $upz->id)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('upz.distributions.create', compact('upz', 'mustahiqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upz_profile_id'         => 'required|exists:upz_profiles,id',
            'mustahiq_id'            => 'nullable|exists:mustahiqs,id',
            'distribution_date'      => 'required|date',
            'fund_type'              => 'required|string',
            'asnaf_category'         => 'required|string',
            'program_name'           => 'required|string',
            'distribution_type'      => 'required|string',
            'amount'                 => 'required|numeric|min:1',
            'description'            => 'nullable|string',
            'recipient_identity_name'=> 'nullable|string',
        ]);

        $distribution = $this->service->recordDistribution($validated, auth()->user());

        return redirect()->route('distributions.index')
            ->with('success', "Penyaluran No. {$distribution->distribution_number} berhasil dicatat dan diposting ke jurnal.");
    }
}
