<?php

namespace App\Http\Controllers\Upz;

use App\Http\Controllers\Controller;
use App\Models\Upz\Muzakki;
use App\Models\Upz\UpzProfile;
use App\Models\Upz\ZisCollection;
use App\Services\Upz\ZisCollectionService;
use Illuminate\Http\Request;

class ZisCollectionController extends Controller
{
    protected ZisCollectionService $service;

    public function __construct(ZisCollectionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = ZisCollection::with(['muzakki', 'upzProfile'])->latest('transaction_date');

        if ($request->filled('fund_type')) {
            $query->where('fund_type', $request->fund_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('bsz_number', 'like', "%{$search}%")
                  ->orWhereHas('muzakki', function ($mq) use ($search) {
                      $mq->where('name', 'like', "%{$search}%")
                        ->orWhere('npwz', 'like', "%{$search}%");
                  });
            });
        }

        $collections = $query->paginate(15)->withQueryString();
        $totalAmount = ZisCollection::sum('amount');
        $totalAmil = ZisCollection::sum('amil_amount');

        return view('upz.collections.index', compact('collections', 'totalAmount', 'totalAmil'));
    }

    public function create()
    {
        $upz = UpzProfile::firstOrFail();
        $muzakkis = Muzakki::active()->orderBy('name')->get();

        return view('upz.collections.create', compact('upz', 'muzakkis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'upz_profile_id' => 'required|exists:upz_profiles,id',
            'muzakki_id' => 'required|exists:muzakkis,id',
            'transaction_date' => 'required|date',
            'fund_type' => 'required|string',
            'fund_subtype' => 'nullable|string',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'amil_percentage' => 'nullable|numeric|min:0|max:12.50',
            'description' => 'nullable|string',
            'reference_number' => 'nullable|string',
        ]);

        $collection = $this->service->recordCollection($validated, auth()->user());

        return redirect()->route('collections.show', $collection->id)
            ->with('success', "Penerimaan ZIS No. {$collection->bsz_number} berhasil dicatat dan dijurnal.");
    }

    public function show(ZisCollection $collection)
    {
        $collection->load(['muzakki', 'upzProfile']);

        return view('upz.collections.show', compact('collection'));
    }

    public function printBsz(ZisCollection $collection)
    {
        $collection->load(['muzakki', 'upzProfile']);

        return view('upz.collections.print-bsz', compact('collection'));
    }
}
