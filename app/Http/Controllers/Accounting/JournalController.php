<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Account;
use App\Models\Accounting\JournalEntry;
use App\Models\Accounting\JournalItem;
use App\Models\Upz\UpzProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    protected function getUpz(): UpzProfile
    {
        $user = auth()->user();
        return $user->upzProfile ?? UpzProfile::firstOrFail();
    }

    public function index(Request $request)
    {
        $upz   = $this->getUpz();
        $query = JournalEntry::where('upz_profile_id', $upz->id)
            ->with('items.account')
            ->latest('entry_date');

        if ($request->filled('start_date')) {
            $query->where('entry_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('entry_date', '<=', $request->end_date);
        }

        $entries     = $query->paginate(15)->withQueryString();
        $totalDebit  = JournalItem::whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id))->sum('debit');
        $totalCredit = JournalItem::whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id))->sum('credit');

        return view('accounting.journals.index', compact('entries', 'totalDebit', 'totalCredit'));
    }

    public function create()
    {
        $upz = $this->getUpz();
        $accounts = Account::active()->orderBy('code')->get();
        return view('accounting.journals.create', compact('accounts', 'upz'));
    }

    public function store(Request $request)
    {
        $upz = $this->getUpz();

        $request->validate([
            'entry_date' => 'required|date',
            'voucher_number' => 'nullable|string|max:50|unique:journal_entries,voucher_number',
            'description' => 'required|string|max:500',
            'items' => 'required|array|min:2',
            'items.*.account_id' => 'required|exists:accounts,id',
            'items.*.debit' => 'nullable|numeric|min:0',
            'items.*.credit' => 'nullable|numeric|min:0',
            'items.*.restriction_type' => 'nullable|string',
        ], [
            'entry_date.required' => 'Tanggal transaksi wajib diisi.',
            'description.required' => 'Deskripsi / Keterangan transaksi wajib diisi.',
            'items.required' => 'Minimal 2 baris akun transaksi jurnal.',
            'items.min' => 'Entri jurnal akuntansi harus memiliki minimal 2 baris transaksi.',
            'items.*.account_id.required' => 'Setiap baris wajib memilih akun.',
        ]);

        $validItems = collect($request->items)->filter(function ($item) {
            $debit = (float) ($item['debit'] ?? 0);
            $credit = (float) ($item['credit'] ?? 0);
            return ($debit > 0 || $credit > 0) && !empty($item['account_id']);
        });

        if ($validItems->count() < 2) {
            return back()->withInput()->withErrors([
                'items' => 'Minimal harus ada 2 baris akun dengan nilai nominal (Debit atau Kredit) yang valid.'
            ]);
        }

        $totalDebit = $validItems->sum(fn($i) => (float)($i['debit'] ?? 0));
        $totalCredit = $validItems->sum(fn($i) => (float)($i['credit'] ?? 0));

        if ($totalDebit <= 0) {
            return back()->withInput()->withErrors([
                'items' => 'Total nilai transaksi harus lebih besar dari Rp 0.'
            ]);
        }

        if (abs($totalDebit - $totalCredit) > 0.01) {
            return back()->withInput()->withErrors([
                'items' => 'Jurnal tidak seimbang (Unbalanced)! Total Debit (Rp ' . number_format($totalDebit, 0, ',', '.') . ') harus sama dengan Total Kredit (Rp ' . number_format($totalCredit, 0, ',', '.') . ').'
            ]);
        }

        $voucherNumber = $request->filled('voucher_number')
            ? trim($request->voucher_number)
            : $this->generateVoucherNumber($request->entry_date);

        DB::transaction(function () use ($upz, $request, $voucherNumber, $validItems) {
            $entry = JournalEntry::create([
                'upz_profile_id' => $upz->id,
                'entry_date' => $request->entry_date,
                'voucher_number' => $voucherNumber,
                'description' => $request->description,
                'source_module' => 'GENERAL',
            ]);

            foreach ($validItems as $item) {
                $debit = (float) ($item['debit'] ?? 0);
                $credit = (float) ($item['credit'] ?? 0);
                $restriction = $item['restriction_type'] ?? 'WITHOUT_RESTRICTION';
                if (in_array(strtolower($restriction), ['dengan_pembatasan', 'with_restriction'])) {
                    $restriction = 'WITH_RESTRICTION';
                } else {
                    $restriction = 'WITHOUT_RESTRICTION';
                }

                JournalItem::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $item['account_id'],
                    'debit' => $debit,
                    'credit' => $credit,
                    'restriction_type' => $restriction,
                ]);
            }
        });

        return redirect()->route('journals.index')->with('success', 'Entri transaksi keuangan / jurnal umum berhasil disimpan.');
    }

    protected function generateVoucherNumber(string $entryDate): string
    {
        $date = Carbon::parse($entryDate);
        $yearMonth = $date->format('Ym');
        $count = JournalEntry::whereYear('entry_date', $date->year)
            ->whereMonth('entry_date', $date->month)
            ->count() + 1;

        return sprintf('JV/%s/%04d', $yearMonth, $count);
    }

    public function ledger(Request $request)
    {
        $upz             = $this->getUpz();
        $accounts        = Account::active()->orderBy('code')->get();
        $selectedAccount = null;
        $items           = collect();

        if ($request->filled('account_id')) {
            $selectedAccount = Account::findOrFail($request->account_id);
            $items = JournalItem::with('journalEntry')
                ->where('account_id', $selectedAccount->id)
                ->whereHas('journalEntry', function ($q) use ($request, $upz) {
                    $q->where('upz_profile_id', $upz->id);
                    if ($request->filled('start_date')) {
                        $q->where('entry_date', '>=', $request->start_date);
                    }
                    if ($request->filled('end_date')) {
                        $q->where('entry_date', '<=', $request->end_date);
                    }
                })
                ->get()
                ->sortBy('journalEntry.entry_date');
        }

        return view('accounting.journals.ledger', compact('accounts', 'selectedAccount', 'items'));
    }

    public function trialBalance(Request $request)
    {
        $upz      = $this->getUpz();
        $asOfDate = $request->input('as_of_date', now()->toDateString());
        $accounts = Account::active()->orderBy('code')->get();

        $rows        = [];
        $grandDebit  = 0;
        $grandCredit = 0;

        foreach ($accounts as $account) {
            $balance = $account->getBalanceBetween(null, $asOfDate, $upz->id);
            if ($balance == 0) {
                continue;
            }

            $debit  = strtoupper($account->normal_balance ?? '') === 'DEBIT'  ? $balance : 0;
            $credit = strtoupper($account->normal_balance ?? '') === 'CREDIT' ? $balance : 0;

            $grandDebit  += $debit;
            $grandCredit += $credit;

            $rows[] = [
                'account' => $account,
                'debit'   => $debit,
                'credit'  => $credit,
            ];
        }

        return view('accounting.journals.trial-balance', compact('rows', 'grandDebit', 'grandCredit', 'asOfDate'));
    }
}
