@extends('layouts.app')

@section('title', 'Buku Besar (General Ledger)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Buku Besar (General Ledger)</h1>
            <p class="text-xs text-slate-500">Mutasi dan saldo historis per akun Bagan Akun Standar (COA) DE ISAK 35.</p>
        </div>
        <div>
            <a href="{{ route('journals.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
                &larr; Jurnal Umum
            </a>
        </div>
    </div>

    <!-- Account Selector Form -->
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm">
        <form method="GET" action="{{ route('journals.ledger') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end text-xs">
            <div class="md:col-span-2">
                <label class="block font-bold text-slate-700 uppercase mb-1">Pilih Akun Buku Besar</label>
                <select name="account_id" required class="w-full border border-slate-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none font-medium">
                    <option value="">-- Pilih Akun --</option>
                    @foreach($accounts as $acc)
                    <option value="{{ $acc->id }}" {{ request('account_id') == $acc->id ? 'selected' : '' }}>
                        {{ $acc->code }} - {{ $acc->name }} ({{ $acc->classification_label }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date', date('Y-m-d')) }}" class="w-full border border-slate-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-lg transition">
                    Tampilkan Buku Besar
                </button>
            </div>
        </form>
    </div>

    @if($selectedAccount)
    <!-- Ledger Detail Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <div class="text-xs font-mono text-indigo-700 font-bold">{{ $selectedAccount->code }}</div>
                <h2 class="text-base font-bold text-slate-900">{{ $selectedAccount->name }}</h2>
                <span class="inline-block mt-1 text-[11px] px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-800 border border-indigo-200">
                    {{ $selectedAccount->classification_label }} &bull; Saldo Normal: {{ strtoupper($selectedAccount->normal_balance) }}
                </span>
            </div>
            <div class="text-right">
                <span class="text-xs text-slate-500">Saldo Akhir Akun:</span>
                <div class="text-xl font-bold font-mono text-indigo-900">
                    Rp {{ number_format($selectedAccount->getBalanceBetween(null, request('end_date')), 2, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">No. Jurnal</th>
                        <th class="p-3">Keterangan Transaksi</th>
                        <th class="p-3 text-right">Debit (Rp)</th>
                        <th class="p-3 text-right">Kredit (Rp)</th>
                        <th class="p-3 text-right">Saldo Berjalan (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @php
                        $runningBalance = 0;
                    @endphp
                    @forelse($items as $row)
                    @php
                        $change = $selectedAccount->normal_balance === 'debit' ? ($row->debit - $row->credit) : ($row->credit - $row->debit);
                        $runningBalance += $change;
                    @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 text-slate-500 whitespace-nowrap">{{ $row->journalEntry->entry_date->format('d/m/Y') }}</td>
                        <td class="p-3 font-mono font-bold text-slate-800 whitespace-nowrap">{{ $row->journalEntry->entry_number }}</td>
                        <td class="p-3">
                            <div class="font-medium text-slate-900">{{ $row->journalEntry->memo }}</div>
                            @if($row->memo)
                            <div class="text-[11px] text-slate-400">{{ $row->memo }}</div>
                            @endif
                        </td>
                        <td class="p-3 text-right font-mono font-medium">{{ $row->debit > 0 ? number_format($row->debit, 0, ',', '.') : '-' }}</td>
                        <td class="p-3 text-right font-mono font-medium">{{ $row->credit > 0 ? number_format($row->credit, 0, ',', '.') : '-' }}</td>
                        <td class="p-3 text-right font-mono font-bold text-indigo-900">
                            Rp {{ number_format($runningBalance, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">Tidak ada mutasi transaksi pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-white p-12 rounded-xl border border-slate-200 text-center text-slate-400 text-xs">
        <i class="fa-solid fa-book-open text-4xl text-slate-300 mb-3 block"></i>
        Pilih salah satu akun di atas untuk melihat rincian mutasi buku besar.
    </div>
    @endif
</div>
@endsection
