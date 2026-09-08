@extends('layouts.app')

@section('title', 'Dashboard Akuntansi Nonlaba (DE ISAK 35)')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner (Formal Corporate) -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 border-l-4 border-l-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded border border-slate-200">
                    MODUL AKUNTANSI INTERNAL ORGANISASI
                </span>
                <span class="text-xs text-slate-300">&bull;</span>
                <span class="text-xs text-slate-500 font-medium">DSAK Ikatan Akuntan Indonesia</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Pembukuan &amp; Laporan Keuangan DE ISAK 35
            </h1>
            <p class="text-xs text-slate-600 font-normal mt-0.5">
                Pengelolaan jurnal, buku besar, neraca saldo, serta 4 laporan pokok entitas nonlaba Format A.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('portal') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2 text-slate-700">
                <i class="fa-solid fa-arrow-left text-slate-400"></i>
                <span>Ganti Modul</span>
            </a>
            <a href="{{ route('reports.financial-position') }}" class="clay-btn-sky px-3.5 py-2 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar text-[11px]"></i>
                <span>Posisi Keuangan</span>
            </a>
        </div>
    </div>

    <!-- Financial KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- KPI 1: Total Aset -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Total Aset</span>
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                Lancar: Rp {{ number_format($financialPosition['total_current_assets'] ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <!-- KPI 2: Total Liabilitas -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Total Liabilitas</span>
                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_liabilities'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                Kewajiban jangka pendek &amp; panjang
            </div>
        </div>

        <!-- KPI 3: Total Aset Neto -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Total Aset Neto</span>
                <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_net_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                Tanpa Pembatasan + Dengan Pembatasan
            </div>
        </div>

        <!-- KPI 4: Keseimbangan Neraca -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Status Neraca</span>
                <div class="w-8 h-8 rounded-lg {{ $financialPosition['is_balanced'] ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} flex items-center justify-center text-sm">
                    <i class="fa-solid {{ $financialPosition['is_balanced'] ? 'fa-check-double' : 'fa-triangle-exclamation' }}"></i>
                </div>
            </div>
            <div class="text-sm font-bold {{ $financialPosition['is_balanced'] ? 'text-emerald-700' : 'text-rose-700' }} tracking-tight">
                {{ $financialPosition['is_balanced'] ? 'SEIMBANG (BALANCED)' : 'SELISIH / PERIKSA' }}
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                Aset = Liabilitas + Aset Neto
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to 4 DE ISAK 35 Statements (Format A) -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    4 Laporan Keuangan Pokok DE ISAK 35 Format A (Monokrom Standar IAI)
                </h2>
                <p class="text-xs text-slate-500 font-normal">Format baku monokrom dapat langsung dicetak sesuai dokumen standar resmi IAI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 text-xs">
            <a href="{{ route('reports.financial-position') }}" class="p-4 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-semibold text-xs">Posisi Keuangan</strong>
                    <span class="text-slate-500 text-[11px] font-normal">Format A Hal. 21 PDF &bull; Neraca</span>
                </div>
            </a>

            <a href="{{ route('reports.comprehensive-income') }}" class="p-4 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-semibold text-xs">Penghasilan Komprehensif</strong>
                    <span class="text-slate-500 text-[11px] font-normal">Format A Hal. 24 PDF &bull; Surplus</span>
                </div>
            </a>

            <a href="{{ route('reports.net-assets') }}" class="p-4 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-semibold text-xs">Perubahan Aset Neto</strong>
                    <span class="text-slate-500 text-[11px] font-normal">Hal. 26 PDF &bull; Rekonsiliasi</span>
                </div>
            </a>

            <a href="{{ route('reports.cash-flow') }}" class="p-4 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-semibold text-xs">Laporan Arus Kas</strong>
                    <span class="text-slate-500 text-[11px] font-normal">Hal. 27 PDF &bull; Metode Langsung</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Journal Entries Table -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    Jurnal Umum &amp; Transaksi Pembukuan Terakhir
                </h2>
                <p class="text-xs text-slate-500 font-normal">Daftar entri jurnal akuntansi yang tercatat di buku besar:</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('journals.index') }}" class="clay-btn-white px-3 py-1.5 text-xs font-semibold flex items-center gap-1 text-slate-700">
                    <span>Semua Jurnal</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <a href="{{ route('journals.ledger') }}" class="clay-btn-sky px-3 py-1.5 text-xs font-semibold flex items-center gap-1">
                    <span>Buku Besar</span>
                    <i class="fa-solid fa-book text-[10px]"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-50 text-slate-700 font-semibold border-b border-slate-200 text-[11px]">
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
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="p-3 font-mono font-semibold text-slate-800">{{ $journal->entry_number }}</td>
                            <td class="p-3 text-slate-600">{{ \Carbon\Carbon::parse($journal->entry_date)->format('d/m/Y') }}</td>
                            <td class="p-3 font-medium text-slate-900">{{ $journal->description }}</td>
                            <td class="p-3 font-mono text-slate-500">{{ $journal->reference_number ?? '-' }}</td>
                            <td class="p-3 text-right font-mono font-semibold text-slate-900">
                                Rp {{ number_format($journal->total_debit, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-right font-mono font-semibold text-slate-900">
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
