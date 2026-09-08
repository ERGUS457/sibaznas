<?php

namespace App\Http\Controllers\Upz;

use App\Http\Controllers\Controller;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\UpzProfile;
use App\Services\OrganizationContextService;
use Illuminate\Http\Request;

class MustahiqController extends Controller
{
    protected OrganizationContextService $orgContext;

    public function __construct(OrganizationContextService $orgContext)
    {
        $this->orgContext = $orgContext;
    }

    public function index(Request $request)
    {
        $upz = $this->orgContext->getActiveOrganization();
        $query = Mustahiq::where('upz_profile_id', $upz->id)->withCount('distributions')->latest();

        if ($request->filled('asnaf')) {
            $query->where('asnaf_category', $request->asnaf);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $mustahiqs = $query->paginate(15)->withQueryString();

        return view('upz.mustahiqs.index', compact('mustahiqs'));
    }

    public function create()
    {
        $upz = $this->orgContext->getActiveOrganization();

        return view('upz.mustahiqs.create', compact('upz'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upz_profile_id' => 'required|exists:upz_profiles,id',
            'nik' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'asnaf_category' => 'required|string',
            'gender' => 'nullable|in:L,P',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'family_dependents_count' => 'nullable|integer|min:0',
            'monthly_income' => 'nullable|numeric|min:0',
            'eligibility_notes' => 'nullable|string',
            'survey_date' => 'nullable|date',
            'surveyor_name' => 'nullable|string',
        ]);

        $mustahiq = Mustahiq::create($validated);

        return redirect()->route('mustahiqs.index')
            ->with('success', "Mustahiq '{$mustahiq->name}' (Asnaf {$mustahiq->asnaf_label}) berhasil didaftarkan.");
    }
}
