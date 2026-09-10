@extends('layouts.app')

@section('title', 'Setoran Keuangan ke Organisasi Induk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Setoran Keuangan ke Organisasi Induk</h1>
            <p class="text-xs text-slate-500">Penyetoran hasil pengumpulan dana oleh Organisasi ke rekening resmi Organisasi Induk / Pembina.</p>
        </div>
        <div>
            <a href="{{ route('remittances.create') }}" class="inline-flex items-center space-x-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-building-columns"></i>
                <span>Rekam Setoran Induk</span>
            </a>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-semibold text-slate-500 uppercase">Total Setoran Tervalidasi Organisasi Induk</span>
            <div class="text-2xl font-bold text-amber-600 mt-1">Rp {{ number_format($totalRemitted, 0, ',', '.') }}</div>
        </div>
        <div class="text-xs text-slate-500 text-right">
            <span>Kewajiban Pelaporan:</span>
            <div class="font-bold text-slate-700">Periodik Bulanan / Triwulan</div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">No. Setoran</th>
                        <th class="p-3">Periode</th>
                        <th class="p-3">Bank Tujuan BAZNAS</th>
                        <th class="p-3 text-right">Total Terkumpul</th>
                        <th class="p-3 text-right">Hak Amil UPZ</th>
                        <th class="p-3 text-right">Nominal Disetor</th>
                        <th class="p-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($remittances as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 text-slate-500 whitespace-nowrap">{{ $item->remittance_date->format('d/m/Y') }}</td>
                        <td class="p-3 font-mono font-bold text-amber-700 whitespace-nowrap">{{ $item->remittance_number }}</td>
                        <td class="p-3 font-semibold text-slate-800">{{ $item->period_label }}</td>
                        <td class="p-3">
                            <div class="font-medium text-slate-900">{{ $item->target_baznas_bank }}</div>
                            <div class="text-[11px] font-mono text-slate-400">Rek: {{ $item->target_baznas_account_number }}</div>
                        </td>
                        <td class="p-3 text-right text-slate-700">Rp {{ number_format($item->total_collected, 0, ',', '.') }}</td>
                        <td class="p-3 text-right text-amber-700 font-medium">Rp {{ number_format($item->amil_retained, 0, ',', '.') }}</td>
                        <td class="p-3 text-right font-extrabold text-slate-900 whitespace-nowrap">
                            Rp {{ number_format($item->amount_remitted, 0, ',', '.') }}
                        </td>
                        <td class="p-3 text-center">
                            @if($item->status === 'verified_by_baznas')
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-emerald-100 text-emerald-800 font-semibold">
                                Tervalidasi BAZNAS
                            </span>
                            @else
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-amber-100 text-amber-800 font-semibold capitalize">
                                {{ str_replace('_', ' ', $item->status) }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Belum ada data setoran ke BAZNAS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($remittances->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $remittances->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
