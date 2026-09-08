@extends('layouts.app')

@section('title', 'Database Muzakki & Munfiq')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Database Muzakki &amp; Munfiq</h1>
            <p class="text-xs text-slate-500">Daftar muzakki perorangan dan badan/korporasi yang terdaftar di UPZ BAZNAS.</p>
        </div>
        <div>
            <a href="{{ route('muzakkis.create') }}" class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-user-plus"></i>
                <span>Registrasi Muzakki Baru</span>
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-50/50">
            <form method="GET" action="{{ route('muzakkis.index') }}" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NPWZ / NIK..." class="text-xs border border-slate-300 rounded-lg px-3 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <button type="submit" class="bg-slate-800 text-white text-xs px-3 py-2 rounded-lg hover:bg-slate-900 transition">Cari</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Nama Muzakki</th>
                        <th class="p-3">Tipe</th>
                        <th class="p-3">NPWZ Resmi BAZNAS</th>
                        <th class="p-3">NIK / NPWP</th>
                        <th class="p-3">Instansi / Unit Kerja</th>
                        <th class="p-3">Kontak</th>
                        <th class="p-3 text-center">Jumlah Setoran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($muzakkis as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 font-bold text-slate-900">{{ $item->name }}</td>
                        <td class="p-3">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] uppercase font-bold {{ $item->type === 'badan' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $item->type }}
                            </span>
                        </td>
                        <td class="p-3 font-mono font-medium text-emerald-700">{{ $item->npwz ?? '-' }}</td>
                        <td class="p-3 font-mono text-slate-500">{{ $item->nik_or_npwp ?? '-' }}</td>
                        <td class="p-3 text-slate-700">{{ $item->workplace_or_agency ?? '-' }}</td>
                        <td class="p-3 text-slate-500">
                            <div>{{ $item->phone ?? '-' }}</div>
                            <div class="text-[11px] text-slate-400">{{ $item->email ?? '' }}</div>
                        </td>
                        <td class="p-3 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-slate-100 text-slate-700 font-semibold">
                                {{ $item->collections_count }} transaksi
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">Belum ada data muzakki terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($muzakkis->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $muzakkis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
