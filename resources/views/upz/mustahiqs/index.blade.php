@extends('layouts.app')

@section('title', 'Database Mustahiq (8 Asnaf)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Database Mustahiq (8 Asnaf)</h1>
            <p class="text-xs text-slate-500">Penerima manfaat zakat yang telah melalui proses asesmen dan verifikasi kelayakan syariah.</p>
        </div>
        <div>
            <a href="{{ route('mustahiqs.create') }}" class="inline-flex items-center space-x-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-user-plus"></i>
                <span>Daftarkan Mustahiq Baru</span>
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-50/50 flex flex-wrap items-center gap-3">
            <form method="GET" action="{{ route('mustahiqs.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIK Mustahiq..." class="text-xs border border-slate-300 rounded-lg px-3 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <select name="asnaf" class="text-xs border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Semua Asnaf --</option>
                    @foreach(\App\Models\Upz\Mustahiq::ASNAF_LABELS as $key => $label)
                    <option value="{{ $key }}" {{ request('asnaf') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-slate-800 text-white text-xs px-3 py-2 rounded-lg hover:bg-slate-900 transition">Filter</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Nama Mustahiq</th>
                        <th class="p-3">Asnaf</th>
                        <th class="p-3">NIK</th>
                        <th class="p-3">Tanggungan</th>
                        <th class="p-3">Pendapatan / Bulan</th>
                        <th class="p-3">Alamat</th>
                        <th class="p-3 text-center">Bantuan Diterima</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($mustahiqs as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 font-bold text-slate-900">
                            {{ $item->name }}
                            <span class="text-slate-400 font-normal ml-1">({{ $item->gender ?? '-' }})</span>
                        </td>
                        <td class="p-3">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] bg-indigo-50 text-indigo-800 border border-indigo-200 font-bold uppercase tracking-wider">
                                {{ $item->asnaf_label }}
                            </span>
                        </td>
                        <td class="p-3 font-mono text-slate-500">{{ $item->nik ?? '-' }}</td>
                        <td class="p-3 text-slate-700">{{ $item->family_dependents_count }} jiwa</td>
                        <td class="p-3 text-slate-700">Rp {{ number_format($item->monthly_income, 0, ',', '.') }}</td>
                        <td class="p-3 text-slate-500">{{ $item->address ?? '-' }}, {{ $item->city ?? '' }}</td>
                        <td class="p-3 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-teal-100 text-teal-800 font-semibold">
                                {{ $item->distributions_count }} kali
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">Belum ada data mustahiq terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($mustahiqs->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $mustahiqs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
