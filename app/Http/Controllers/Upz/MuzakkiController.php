<?php

namespace App\Http\Controllers\Upz;

use App\Http\Controllers\Controller;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use Illuminate\Http\Request;

class MuzakkiController extends Controller
{
    protected function getUpz(): UpzProfile
    {
        $user = auth()->user();
        return $user->upzProfile ?? UpzProfile::firstOrFail();
    }

    public function index(Request $request)
    {
        $upz   = $this->getUpz();
        $query = Muzakki::where('upz_profile_id', $upz->id)
            ->withCount('collections')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('npwz', 'like', "%{$search}%")
                  ->orWhere('nik_or_npwp', 'like', "%{$search}%");
            });
        }

        $muzakkis = $query->paginate(15)->withQueryString();

        return view('upz.muzakkis.index', compact('muzakkis'));
    }

    public function create()
    {
        $upz = $this->getUpz();

        return view('upz.muzakkis.create', compact('upz'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upz_profile_id'        => 'required|exists:upz_profiles,id',
            'type'                  => 'required|in:individu,badan',
            'name'                  => 'required|string|max:255',
            'nik_or_npwp'           => 'nullable|string',
            'npwz'                  => 'nullable|string',
            'email'                 => 'nullable|email',
            'phone'                 => 'nullable|string',
            'workplace_or_agency'   => 'nullable|string',
            'address'               => 'nullable|string',
            'city'                  => 'nullable|string',
        ]);

        $muzakki = Muzakki::create($validated);

        return redirect()->route('muzakkis.index')
            ->with('success', "Muzakki '{$muzakki->name}' berhasil didaftarkan.");
    }
}
