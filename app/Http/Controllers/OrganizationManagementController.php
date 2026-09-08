<?php

namespace App\Http\Controllers;

use App\Models\Upz\UpzProfile;
use App\Services\OrganizationContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganizationManagementController extends Controller
{
    protected OrganizationContextService $orgContext;

    public function __construct(OrganizationContextService $orgContext)
    {
        $this->orgContext = $orgContext;
    }

    /**
     * Display list of all registered organizations / UPZ.
     */
    public function index()
    {
        $activeOrg = $this->orgContext->getActiveOrganization();
        $organizations = UpzProfile::withCount(['muzakkis', 'mustahiqs', 'collections', 'distributions', 'remittances', 'journalEntries'])
            ->orderBy('name')
            ->get();

        // Calculate summary for each organization
        $orgSummaries = [];
        foreach ($organizations as $org) {
            $orgSummaries[$org->id] = $this->orgContext->getStatistics($org->id);
        }

        return view('organizations.index', compact('activeOrg', 'organizations', 'orgSummaries'));
    }

    /**
     * Show form to register a new organization / UPZ.
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store newly created organization and set it as active workspace.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:upz_profiles,code',
            'institution_type' => 'required|string|max:100',
            'parent_baznas_level' => 'required|string|in:pusat,provinsi,kab_kota',
            'parent_baznas_name' => 'required|string|max:255',
            'sk_number' => 'nullable|string|max:100',
            'sk_date' => 'nullable|date',
            'sk_valid_until' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'chairman_name' => 'nullable|string|max:255',
            'secretary_name' => 'nullable|string|max:255',
            'treasurer_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:255',
            'amil_share_percentage' => 'required|numeric|min:0|max:12.50',
        ]);

        // Auto-generate code if empty
        if (empty($validated['code'])) {
            $baseCode = 'ORG-' . strtoupper(Str::slug(substr($validated['name'], 0, 8), ''));
            $candidate = $baseCode;
            $counter = 1;
            while (UpzProfile::where('code', $candidate)->exists()) {
                $candidate = $baseCode . '-' . $counter++;
            }
            $validated['code'] = $candidate;
        }

        $validated['is_active'] = true;

        $newOrg = UpzProfile::create($validated);

        // Immediately switch active session to the newly created organization
        $this->orgContext->setActiveOrganization($newOrg->id);

        return redirect()->route('portal')
            ->with('success', "Organisasi '{$newOrg->name}' berhasil didaftarkan! Ruang kerja saat ini telah dialihkan ke organisasi baru ini (0 transaksi / data bersih).");
    }

    /**
     * Show form to edit an existing organization / UPZ profile.
     */
    public function edit($id)
    {
        $organization = UpzProfile::findOrFail($id);

        return view('organizations.edit', compact('organization'));
    }

    /**
     * Update an organization / UPZ profile.
     */
    public function update(Request $request, $id)
    {
        $organization = UpzProfile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:upz_profiles,code,' . $organization->id,
            'institution_type' => 'required|string|max:100',
            'parent_baznas_level' => 'required|string|in:pusat,provinsi,kab_kota',
            'parent_baznas_name' => 'required|string|max:255',
            'sk_number' => 'nullable|string|max:100',
            'sk_date' => 'nullable|date',
            'sk_valid_until' => 'nullable|date',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'chairman_name' => 'nullable|string|max:255',
            'secretary_name' => 'nullable|string|max:255',
            'treasurer_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_account_name' => 'nullable|string|max:255',
            'amil_share_percentage' => 'required|numeric|min:0|max:12.50',
            'is_active' => 'required|boolean',
        ]);

        $organization->update($validated);

        return redirect()->route('organizations.index')
            ->with('success', "Profil organisasi '{$organization->name}' berhasil diperbarui.");
    }

    /**
     * Switch active organization in session.
     */
    public function switchOrganization($id)
    {
        $org = $this->orgContext->setActiveOrganization((int) $id);
        $name = $org ? $org->name : 'Organisasi';

        return redirect()->back(fallback: route('portal'))
            ->with('success', "Ruang kerja aktif beralih ke: {$name}");
    }

    /**
     * Reset / Clean demo data for specific organization.
     */
    public function resetData(Request $request, $id)
    {
        $org = UpzProfile::findOrFail($id);

        $request->validate([
            'confirm_name' => 'required|string|in:' . $org->name,
        ], [
            'confirm_name.in' => 'Konfirmasi nama organisasi tidak cocok. Data aman dan tidak dihapus.',
        ]);

        // Clean transactions belonging to this organization
        \App\Models\Accounting\JournalEntry::where('upz_profile_id', $org->id)->delete();
        \App\Models\Upz\ZisCollection::where('upz_profile_id', $org->id)->delete();
        \App\Models\Upz\ZisDistribution::where('upz_profile_id', $org->id)->delete();
        \App\Models\Upz\BaznasRemittance::where('upz_profile_id', $org->id)->delete();
        \App\Models\Upz\Muzakki::where('upz_profile_id', $org->id)->delete();
        \App\Models\Upz\Mustahiq::where('upz_profile_id', $org->id)->delete();

        return redirect()->route('organizations.index')
            ->with('success', "Semua data transaksi dan master untuk organisasi '{$org->name}' telah berhasil direset menjadi bersih (0 transaksi).");
    }
}
