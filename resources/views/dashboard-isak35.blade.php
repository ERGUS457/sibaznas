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
            <a href="{{ route('journals.create') }}" class="clay-btn-sky px-3.5 py-2 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-plus text-[11px]"></i>
                <span>Input Data Keuangan</span>
            </a>
            <a href="{{ route('portal') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2 text-slate-700">
                <i class="fa-solid fa-arrow-left text-slate-400"></i>
                <span>Ganti Laporan</span>
            </a>
            <a href="{{ route('reports.financial-position') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2 text-slate-700">
                <i class="fa-solid fa-file-invoice-dollar text-[11px]"></i>
                <span>Posisi Keuangan</span>
            </a>
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
</div>
@endsection
