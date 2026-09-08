<?php

namespace App\Services;

use App\Models\Accounting\JournalEntry;
use App\Models\Upz\BaznasRemittance;
use App\Models\Upz\Mustahiq;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Models\Upz\ZisDistribution;
use Illuminate\Database\Eloquent\Collection;

class OrganizationContextService
{
    protected ?UpzProfile $activeOrganization = null;

    /**
     * Get the currently active Organization / UPZ Profile.
     */
    public function getActiveOrganization(): UpzProfile
    {
        if ($this->activeOrganization !== null) {
            return $this->activeOrganization;
        }

        $sessionUpzId = session('active_upz_id');

        if ($sessionUpzId) {
            $org = UpzProfile::find($sessionUpzId);
            if ($org) {
                $this->activeOrganization = $org;
                return $org;
            }
        }

        // Fallback to authenticated user's UPZ
        $userUpz = auth()->user()?->upzProfile;
        if ($userUpz) {
            $this->activeOrganization = $userUpz;
            session(['active_upz_id' => $userUpz->id]);
            return $userUpz;
        }

        // Fallback to first available UPZ in database
        $firstOrg = UpzProfile::first();
        if ($firstOrg) {
            $this->activeOrganization = $firstOrg;
            session(['active_upz_id' => $firstOrg->id]);
            return $firstOrg;
        }

        // Fallback empty object if table is completely empty
        $defaultOrg = new UpzProfile([
            'name' => 'Organisasi Baru',
            'code' => 'ORG-001',
            'institution_type' => 'Lembaga Nonlaba / Yayasan',
            'parent_baznas_level' => 'BAZNAS RI',
            'parent_baznas_name' => 'BAZNAS',
            'amil_share_percentage' => 12.50,
            'is_active' => true,
        ]);

        $this->activeOrganization = $defaultOrg;
        return $defaultOrg;
    }

    /**
     * Set the currently active Organization / UPZ by ID.
     */
    public function setActiveOrganization(int $id): ?UpzProfile
    {
        $org = UpzProfile::find($id);
        if (!$org) {
            return null;
        }

        $this->activeOrganization = $org;
        session(['active_upz_id' => $org->id]);

        return $org;
    }

    /**
     * Get all registered organizations / UPZs.
     *
     * @return Collection<int, UpzProfile>
     */
    public function getAllOrganizations(): Collection
    {
        return UpzProfile::orderBy('name')->get();
    }

    /**
     * Get operational statistics for a specific organization or active one.
     */
    public function getStatistics(?int $upzId = null): array
    {
        $id = $upzId ?? $this->getActiveOrganization()->id;

        if (!$id) {
            return [
                'total_zis_collected' => 0,
                'total_distributed' => 0,
                'total_amil_retained' => 0,
                'total_remitted' => 0,
                'total_remitted_to_baznas' => 0,
                'available_zis_cash' => 0,
                'muzakki_count' => 0,
                'mustahiq_count' => 0,
                'journal_count' => 0,
                'journal_entries_count' => 0,
                'effective_amil_percentage' => 0,
            ];
        }

        $totalZisCollected = (float) ZisCollection::where('upz_profile_id', $id)->sum('amount');
        $totalDistributed = (float) ZisDistribution::where('upz_profile_id', $id)->sum('amount');
        $totalAmilRetained = (float) ZisCollection::where('upz_profile_id', $id)->sum('amil_amount');
        $totalRemitted = (float) BaznasRemittance::where('upz_profile_id', $id)
            ->where('status', 'verified_by_baznas')
            ->sum('amount_remitted');

        $muzakkiCount = Muzakki::where('upz_profile_id', $id)->count();
        $mustahiqCount = Mustahiq::where('upz_profile_id', $id)->count();
        $journalCount = JournalEntry::where('upz_profile_id', $id)->count();

        $effectiveAmilPercentage = $totalZisCollected > 0
            ? ($totalAmilRetained / $totalZisCollected) * 100
            : 0;

        return [
            'total_zis_collected' => $totalZisCollected,
            'total_distributed' => $totalDistributed,
            'total_amil_retained' => $totalAmilRetained,
            'total_remitted' => $totalRemitted,
            'total_remitted_to_baznas' => $totalRemitted,
            'available_zis_cash' => max(0, $totalZisCollected - $totalDistributed - $totalRemitted),
            'muzakki_count' => $muzakkiCount,
            'mustahiq_count' => $mustahiqCount,
            'journal_count' => $journalCount,
            'journal_entries_count' => $journalCount,
            'effective_amil_percentage' => $effectiveAmilPercentage,
        ];
    }
}
