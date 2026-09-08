@extends('layouts.app')

@section('title', 'Dashboard Akuntansi Nonlaba (DE ISAK 35)')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner -->
    <div class="clay-card p-6 border-l-4 border-l-sky-500 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] font-extrabold uppercase tracking-wider bg-sky-100 text-sky-800 px-2.5 py-0.5 rounded-full border border-sky-200">
                    Modul Akuntansi Internal Organisasi
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs font-semibold text-slate-600">Standar Dewan Standar Akuntansi Keuangan (DSAK IAI)</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                Pembukuan &amp; Laporan Keuangan DE ISAK 35
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Pengelolaan jurnal, buku besar, neraca saldo, serta 4 laporan pokok entitas nonlaba Format A.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('portal') }}" class="clay-btn-white px-4 py-2.5 text-xs font-bold flex items-center gap-2 text-slate-700 hover:text-slate-900 shadow-sm">
                <i class="fa-solid fa-arrow-left text-sky-600"></i>
                <span>Ganti Modul (Portal)</span>
            </a>
            <a href="{{ route('reports.financial-position') }}" class="clay-btn-sky px-4 py-2.5 text-xs font-extrabold flex items-center gap-2 shadow-md">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Laporan Posisi Keuangan</span>
            </a>
        </div>
    </div>

    <!-- Financial KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- KPI 1: Total Aset -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Aset</span>
                <div class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                Lancar: Rp {{ number_format($financialPosition['total_current_assets'] ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <!-- KPI 2: Total Liabilitas -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Liabilitas</span>
                <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_liabilities'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                Kewajiban jangka pendek &amp; panjang
            </div>
        </div>

        <!-- KPI 3: Total Aset Neto -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Aset Neto</span>
                <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_net_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                Tanpa Pembatasan + Dengan Pembatasan
            </div>
        </div>

        <!-- KPI 4: Keseimbangan Neraca -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Status Neraca</span>
                <div class="w-8 h-8 rounded-xl {{ $financialPosition['is_balanced'] ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid {{ $financialPosition['is_balanced'] ? 'fa-check-double' : 'fa-triangle-exclamation' }}"></i>
                </div>
            </div>
            <div class="text-base font-black {{ $financialPosition['is_balanced'] ? 'text-emerald-700' : 'text-rose-700' }} tracking-tight">
                {{ $financialPosition['is_balanced'] ? 'SEIMBANG (BALANCED)' : 'SELISIH / PERIKSA JURNAL' }}
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                Aset = Liabilitas + Aset Neto
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to 4 DE ISAK 35 Statements (Format A) -->
    <div class="clay-card p-6">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    4 Laporan Keuangan Pokok DE ISAK 35 Format A (Monokrom Standar Resmi)
                </h2>
                <p class="text-xs text-slate-500">Dapat langsung dilihat atau dicetak sesuai standar resmi lampiran IAI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <a href="{{ route('reports.financial-position') }}" class="clay-card-soft p-4 hover:border-sky-300 transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-800 flex items-center justify-center text-base flex-shrink-0">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-bold text-sm">Posisi Keuangan</strong>
                    <span class="text-slate-500 text-[11px]">Format A Hal. 21 PDF &bull; Neraca komparatif</span>
                </div>
            </a>

            <a href="{{ route('reports.comprehensive-income') }}" class="clay-card-soft p-4 hover:border-sky-300 transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-base flex-shrink-0">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-bold text-sm">Penghasilan Komprehensif</strong>
                    <span class="text-slate-500 text-[11px]">Format A Hal. 24 PDF &bull; Surplus/Defisit</span>
                </div>
            </a>

            <a href="{{ route('reports.net-assets') }}" class="clay-card-soft p-4 hover:border-sky-300 transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-800 flex items-center justify-center text-base flex-shrink-0">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-bold text-sm">Perubahan Aset Neto</strong>
                    <span class="text-slate-500 text-[11px]">Hal. 26 PDF &bull; Rekonsiliasi saldo</span>
                </div>
            </a>

            <a href="{{ route('reports.cash-flow') }}" class="clay-card-soft p-4 hover:border-sky-300 transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-800 flex items-center justify-center text-base flex-shrink-0">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-bold text-sm">Laporan Arus Kas</strong>
                    <span class="text-slate-500 text-[11px]">Hal. 27 PDF &bull; Metode Langsung</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Journal Entries Table -->
    <div class="clay-card p-6">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Jurnal Umum &amp; Transaksi Pembukuan Terakhir
                </h2>
                <p class="text-xs text-slate-500">Daftar entri jurnal akuntansi yang tercatat di buku besar:</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('journals.index') }}" class="clay-btn-white px-3 py-1.5 text-xs font-bold flex items-center gap-1 text-slate-700">
                    <span>Semua Jurnal</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <a href="{{ route('journals.ledger') }}" class="clay-btn-sky px-3 py-1.5 text-xs font-bold flex items-center gap-1">
                    <span>Buku Besar</span>
                    <i class="fa-solid fa-book text-[10px]"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-200">
                    <tr>
                        <th class="p-3">No. Jurnal</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Keterangan Transaksi</th>
                        <th class="p-3">Referensi</th>
                        <th class="p-3 text-right">Debit</th>
                        <th class="p-3 text-right">Kredit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentJournals ?? [] as $journal)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="p-3 font-mono font-bold text-sky-700">{{ $journal->entry_number }}</td>
                            <td class="p-3 text-slate-600">{{ \Carbon\Carbon::parse($journal->entry_date)->format('d/m/Y') }}</td>
                            <td class="p-3 font-medium text-slate-800">{{ $journal->description }}</td>
                            <td class="p-3 font-mono text-slate-500">{{ $journal->reference_number ?? '-' }}</td>
                            <td class="p-3 text-right font-mono font-bold text-slate-900">
                                Rp {{ number_format($journal->total_debit, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-right font-mono font-bold text-slate-900">
                                Rp {{ number_format($journal->total_credit, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-slate-400 italic">
                                Belum ada transaksi jurnal akuntansi yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
