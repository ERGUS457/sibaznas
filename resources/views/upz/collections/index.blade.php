@extends('layouts.app')

@section('title', 'Penerimaan ZIS & Bukti Setor Zakat (BSZ)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Penerimaan ZIS &amp; DSKL</h1>
            <p class="text-xs text-slate-500">Pencatatan pengumpulan Zakat, Infak, Sedekah, dan DSKL serta penerbitan Bukti Setor Zakat (BSZ).</p>
        </div>
        <div>
            <a href="{{ route('collections.create') }}" class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>Input Penerimaan ZIS</span>
            </a>
        </div>
    </div>

    <!-- Summary Badges -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs font-semibold text-slate-500">Total Pengumpulan ZIS</span>
            <div class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($totalAmount, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs font-semibold text-slate-500">Alokasi Hak Amil (Maks 12.5%)</span>
            <div class="text-xl font-bold text-amber-600 mt-1">Rp {{ number_format($totalAmil, 0, ',', '.') }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs font-semibold text-slate-500">Dana Terikat Mustahiq (Netto)</span>
            <div class="text-xl font-bold text-emerald-600 mt-1">Rp {{ number_format($totalAmount - $totalAmil, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
            <form method="GET" action="{{ route('collections.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. BSZ / Nama Muzakki / NPWZ..." class="text-xs border border-slate-300 rounded-lg px-3 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <select name="fund_type" class="text-xs border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">-- Semua Jenis Dana --</option>
                    <option value="zakat_maal" {{ request('fund_type') === 'zakat_maal' ? 'selected' : '' }}>Zakat Maal</option>
                    <option value="zakat_fitrah" {{ request('fund_type') === 'zakat_fitrah' ? 'selected' : '' }}>Zakat Fitrah</option>
                    <option value="infak_terikat" {{ request('fund_type') === 'infak_terikat' ? 'selected' : '' }}>Infak Terikat</option>
                    <option value="dskl" {{ request('fund_type') === 'dskl' ? 'selected' : '' }}>DSKL</option>
                </select>
                <button type="submit" class="bg-slate-800 text-white text-xs px-3 py-2 rounded-lg hover:bg-slate-900 transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">No. BSZ</th>
                        <th class="p-3">Muzakki</th>
                        <th class="p-3">Jenis Dana &amp; Metode</th>
                        <th class="p-3 text-right">Nominal</th>
                        <th class="p-3 text-right">Hak Amil</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($collections as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 text-slate-500 whitespace-nowrap">{{ $item->transaction_date->format('d/m/Y') }}</td>
                        <td class="p-3 font-mono font-bold text-emerald-700 whitespace-nowrap">{{ $item->bsz_number }}</td>
                        <td class="p-3">
                            <div class="font-bold text-slate-900">{{ $item->muzakki->name }}</div>
                            <div class="text-[11px] text-slate-500 font-mono">NPWZ: {{ $item->muzakki->npwz ?? '-' }}</div>
                        </td>
                        <td class="p-3">
                            <span class="inline-block px-2 py-0.5 rounded text-[11px] bg-emerald-50 text-emerald-800 border border-emerald-200 font-medium">
                                {{ $item->fund_type_label }}
                            </span>
                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $item->payment_method_label }}</div>
                        </td>
                        <td class="p-3 text-right font-bold text-slate-900 whitespace-nowrap">
                            Rp {{ number_format($item->amount, 0, ',', '.') }}
                        </td>
                        <td class="p-3 text-right text-amber-700 font-medium whitespace-nowrap">
                            Rp {{ number_format($item->amil_amount, 0, ',', '.') }} ({{ $item->amil_percentage }}%)
                        </td>
                        <td class="p-3 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 font-semibold uppercase tracking-wider">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="p-3 text-center whitespace-nowrap space-x-2">
                            <a href="{{ route('collections.show', $item->id) }}" class="inline-flex items-center space-x-1 text-slate-600 hover:text-emerald-700 font-semibold p-1" title="Rincian & Jurnal">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('collections.print-bsz', $item->id) }}" target="_blank" class="inline-flex items-center space-x-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 rounded px-2 py-1 text-[11px] font-medium" title="Cetak BSZ">
                                <i class="fa-solid fa-print"></i>
                                <span>BSZ</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Tidak ada data penerimaan ZIS ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($collections->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $collections->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
