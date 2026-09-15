@extends('layouts.app')

@section('title', 'Dashboard Operasional Organisasi')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner (Formal Corporate) -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 border-l-4 border-l-emerald-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-[10px] font-semibold uppercase tracking-wider bg-emerald-50 text-emerald-800 px-2.5 py-0.5 rounded border border-emerald-200">
                    Laporan Operasional Organisasi
                </span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Pengelolaan Penerimaan &amp; Penyaluran {{ $upz->name ?? 'Organisasi' }}
            </h1>
            <p class="text-xs text-slate-600 font-normal mt-0.5">
                Penerimaan donasi/ZIS, penerbitan Bukti Tanda Terima Setor (BSZ), penyaluran program bantuan, dan alokasi operasional.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('portal') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2 text-slate-700">
                <i class="fa-solid fa-arrow-left text-slate-400"></i>
                <span>Ganti Laporan</span>
            </a>
            <a href="{{ route('collections.create') }}" class="clay-btn-emerald px-3.5 py-2 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-receipt text-[11px]"></i>
                <span>Input Setoran (BSZ)</span>
            </a>
        </div>
    </div>
    <!-- Quick Access Navigation to Perbaznas laporan Sheets -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    Lembar Laporan Resmi Peraturan BAZNAS No. 2 Tahun 2016 (Monokrom Standar Resmi)
                </h2>
                <p class="text-xs text-slate-500 font-normal">Pilih laporan resmi untuk dicetak sesuai format asli standar BAZNAS RI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Laporan</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Penerimaan</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 33 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Laporan</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Asnaf</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 34 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Laporan</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Program</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 35 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Laporan</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Operasional</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 37 PDF (12,5%)</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Laporan</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Penyaluran</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 39 PDF (Verifikasi)</span>
            </a>
        </div>
    </div>
</div>
@endsection
