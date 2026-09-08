<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Account;
use App\Models\Accounting\JournalEntry;
use App\Models\Accounting\JournalItem;
use App\Services\OrganizationContextService;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    protected OrganizationContextService $orgContext;

    public function __construct(OrganizationContextService $orgContext)
    {
        $this->orgContext = $orgContext;
    }

    public function index(Request $request)
    {
        $upz = $this->orgContext->getActiveOrganization();
        $query = JournalEntry::where('upz_profile_id', $upz->id)->with('items.account')->latest('entry_date');

        if ($request->filled('start_date')) {
            $query->where('entry_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('entry_date', '<=', $request->end_date);
        }

        $entries = $query->paginate(15)->withQueryString();
        $totalDebit = JournalItem::whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id))->sum('debit');
        $totalCredit = JournalItem::whereHas('journalEntry', fn($q) => $q->where('upz_profile_id', $upz->id))->sum('credit');

        return view('accounting.journals.index', compact('entries', 'totalDebit', 'totalCredit'));
    }

    public function ledger(Request $request)
    {
        $upz = $this->orgContext->getActiveOrganization();
        $accounts = Account::active()->orderBy('code')->get();
        $selectedAccount = null;
        $items = collect();

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
        $upz = $this->orgContext->getActiveOrganization();
        $asOfDate = $request->input('as_of_date', now()->toDateString());
        $accounts = Account::active()->orderBy('code')->get();

        $rows = [];
        $grandDebit = 0;
        $grandCredit = 0;

        foreach ($accounts as $account) {
            $balance = $account->getBalanceBetween(null, $asOfDate, $upz->id);
            if ($balance == 0) {
                continue;
            }

            $debit = strtoupper($account->normal_balance ?? '') === 'DEBIT' ? $balance : 0;
            $credit = strtoupper($account->normal_balance ?? '') === 'CREDIT' ? $balance : 0;

            $grandDebit += $debit;
            $grandCredit += $credit;

            $rows[] = [
                'account' => $account,
                'debit' => $debit,
                'credit' => $credit,
            ];
        }

        return view('accounting.journals.trial-balance', compact('rows', 'grandDebit', 'grandCredit', 'asOfDate'));
    }
}
