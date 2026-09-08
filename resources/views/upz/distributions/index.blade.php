@extends('layouts.app')

@section('title', 'Penyaluran ZIS (Mustahiq 8 Asnaf)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Penyaluran ZIS (Mustahiq 8 Asnaf)</h1>
            <p class="text-xs text-slate-500">Realisasi pendistribusian dan pendayagunaan dana zakat sesuai ketentuan syariah dan Perbaznas No. 2/2016.</p>
        </div>
        <div>
            <a href="{{ route('distributions.create') }}" class="inline-flex items-center space-x-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>Input Penyaluran ZIS</span>
            </a>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-semibold text-slate-500 uppercase">Total Dana ZIS Tersalurkan</span>
            <div class="text-2xl font-bold text-teal-700 mt-1">Rp {{ number_format($totalDistributed, 0, ',', '.') }}</div>
        </div>
        <div class="text-xs text-slate-500 text-right">
            <span>Prioritas Program:</span>
            <div class="font-bold text-slate-700">Fakir, Miskin, Fisabilillah &amp; Gharimin</div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">No. Distribusi</th>
                        <th class="p-3">Penerima Manfaat / Mustahiq</th>
                        <th class="p-3">Asnaf</th>
                        <th class="p-3">Program</th>
                        <th class="p-3">Sifat</th>
                        <th class="p-3 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($distributions as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 text-slate-500 whitespace-nowrap">{{ $item->distribution_date->format('d/m/Y') }}</td>
                        <td class="p-3 font-mono font-bold text-teal-700 whitespace-nowrap">{{ $item->distribution_number }}</td>
                        <td class="p-3">
                            <div class="font-bold text-slate-900">{{ $item->recipient_identity_name ?? $item->mustahiq?->name }}</div>
                            @if($item->mustahiq)
                            <div class="text-[11px] text-slate-500">NIK: {{ $item->mustahiq->nik ?? '-' }}</div>
                            @endif
                        </td>
                        <td class="p-3">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-teal-50 text-teal-800 border border-teal-200 font-semibold uppercase tracking-wider">
                                {{ $item->asnaf_category }}
                            </span>
                        </td>
                        <td class="p-3 font-medium text-slate-800">{{ $item->program_name }}</td>
                        <td class="p-3">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] {{ $item->distribution_type === 'produktif' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-slate-100 text-slate-700' }} capitalize">
                                {{ $item->distribution_type }}
                            </span>
                        </td>
                        <td class="p-3 text-right font-bold text-slate-900 whitespace-nowrap">
                            Rp {{ number_format($item->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">Belum ada data penyaluran ZIS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($distributions->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $distributions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
