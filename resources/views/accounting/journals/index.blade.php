@extends('layouts.app')

@section('title', 'Jurnal Umum (General Journal)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Jurnal Umum (General Journal)</h1>
            <p class="text-xs text-slate-500">Pencatatan berpasangan (Double-Entry Bookkeeping) transaksi penerimaan, penyaluran, dan setoran BAZNAS.</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('journals.ledger') }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 text-xs font-semibold px-3 py-2 rounded-xl transition">
                <i class="fa-solid fa-table-list mr-1"></i> Buku Besar
            </a>
            <a href="{{ route('journals.trial-balance') }}" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 text-xs font-semibold px-3 py-2 rounded-xl transition">
                <i class="fa-solid fa-scale-balanced mr-1"></i> Neraca Saldo
            </a>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase">Total Akumulasi Debit</span>
            <div class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($totalDebit, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs font-semibold text-slate-500 uppercase">Total Akumulasi Kredit</span>
            <div class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($totalCredit, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Journal Table -->
    <div class="space-y-4">
        @forelse($entries as $entry)
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-3.5 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                <div class="flex items-center space-x-3">
                    <span class="font-mono font-bold text-slate-900 bg-white border border-slate-300 px-2 py-0.5 rounded shadow-2xs">
                        {{ $entry->entry_number }}
                    </span>
                    <span class="text-slate-500">{{ $entry->entry_date->format('d/m/Y') }}</span>
                    <span class="font-semibold text-slate-700">{{ $entry->memo }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    @if($entry->isBalanced())
                    <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">
                        <i class="fa-solid fa-check"></i> Balanced
                    </span>
                    @else
                    <span class="text-[10px] bg-rose-100 text-rose-800 font-bold px-2 py-0.5 rounded-full">
                        Unbalanced
                    </span>
                    @endif
                </div>
            </div>

            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100/50 text-slate-500 uppercase tracking-wider text-[10px] border-b border-slate-200">
                    <tr>
                        <th class="p-2.5">Kode</th>
                        <th class="p-2.5">Nama Akun</th>
                        <th class="p-2.5">Klasifikasi ISAK 35</th>
                        <th class="p-2.5">Keterangan Baris</th>
                        <th class="p-2.5 text-right">Debit (Rp)</th>
                        <th class="p-2.5 text-right">Kredit (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($entry->items as $item)
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-2.5 font-mono text-slate-900 font-medium">{{ $item->account->code }}</td>
                        <td class="p-2.5 font-semibold {{ $item->credit > 0 ? 'pl-6 text-slate-600' : 'text-slate-900' }}">
                            {{ $item->account->name }}
                        </td>
                        <td class="p-2.5">
                            <span class="text-[10px] px-2 py-0.5 rounded-full {{ $item->restriction_type === 'dengan_pembatasan' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }}">
                                {{ $item->account->classification_label }}
                            </span>
                        </td>
                        <td class="p-2.5 text-slate-500 text-[11px]">{{ $item->memo }}</td>
                        <td class="p-2.5 text-right font-mono font-medium">{{ $item->debit > 0 ? number_format($item->debit, 0, ',', '.') : '-' }}</td>
                        <td class="p-2.5 text-right font-mono font-medium">{{ $item->credit > 0 ? number_format($item->credit, 0, ',', '.') : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @empty
        <div class="bg-white p-8 rounded-xl border border-slate-200 text-center text-slate-400 text-xs">
            Belum ada entri jurnal akuntansi.
        </div>
        @endforelse
    </div>

    @if($entries->hasPages())
    <div class="p-4 bg-white rounded-xl border border-slate-200">
        {{ $entries->links() }}
    </div>
    @endif
</div>
@endsection
