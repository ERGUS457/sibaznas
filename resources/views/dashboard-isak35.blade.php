@extends('layouts.app')

@section('title', 'Dashboard Akuntansi Nonlaba (DE ISAK 35)')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner (Maximalist) -->
    <div class="maxi-card p-6 border-l-8 border-l-sky-500 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] font-black uppercase tracking-wider bg-sky-100 text-sky-950 px-3 py-1 maxi-badge">
                    MODUL AKUNTANSI INTERNAL ORGANISASI
                </span>
                <span class="text-xs text-slate-400 font-bold">&bull;</span>
                <span class="text-xs font-bold text-slate-600">DSAK Ikatan Akuntan Indonesia</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase">
                Pembukuan &amp; Laporan Keuangan DE ISAK 35
            </h1>
            <p class="text-xs text-slate-600 font-medium mt-0.5">
                Pengelolaan jurnal, buku besar, neraca saldo, serta 4 laporan pokok entitas nonlaba Format A.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('portal') }}" class="maxi-btn-white px-4 py-2.5 text-xs font-black flex items-center gap-2 text-slate-900">
                <i class="fa-solid fa-arrow-left text-sky-600"></i>
                <span>Ganti Modul (Portal)</span>
            </a>
            <a href="{{ route('reports.financial-position') }}" class="maxi-btn-sky px-4 py-2.5 text-xs font-black flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Laporan Posisi Keuangan</span>
            </a>
        </div>
    </div>

    <!-- Financial KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Aset -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-sky-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Total Aset</span>
                <div class="w-9 h-9 rounded-xl bg-sky-100 text-sky-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                Lancar: Rp {{ number_format($financialPosition['total_current_assets'] ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <!-- KPI 2: Total Liabilitas -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-amber-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Total Liabilitas</span>
                <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-handshake-angle"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_liabilities'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                Kewajiban jangka pendek &amp; panjang
            </div>
        </div>

        <!-- KPI 3: Total Aset Neto -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-teal-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Total Aset Neto</span>
                <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($financialPosition['total_net_assets'] ?? 0, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                Tanpa Pembatasan + Dengan Pembatasan
            </div>
        </div>

        <!-- KPI 4: Keseimbangan Neraca -->
        <div class="maxi-card p-5 bg-white border-t-4 {{ $financialPosition['is_balanced'] ? 'border-t-emerald-500' : 'border-t-rose-500' }}">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Status Neraca</span>
                <div class="w-9 h-9 rounded-xl {{ $financialPosition['is_balanced'] ? 'bg-emerald-100 text-emerald-900' : 'bg-rose-100 text-rose-900' }} border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid {{ $financialPosition['is_balanced'] ? 'fa-check-double' : 'fa-triangle-exclamation' }}"></i>
                </div>
            </div>
            <div class="text-base font-black {{ $financialPosition['is_balanced'] ? 'text-emerald-800' : 'text-rose-800' }} tracking-tight">
                {{ $financialPosition['is_balanced'] ? 'SEIMBANG (BALANCED)' : 'SELISIH / PERIKSA' }}
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                Aset = Liabilitas + Aset Neto
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to 4 DE ISAK 35 Statements (Format A) -->
    <div class="maxi-card p-6 bg-white">
        <div class="flex items-center justify-between mb-4 border-b-2 border-slate-900 pb-3">
            <div>
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">
                    4 Laporan Keuangan Pokok DE ISAK 35 Format A (Monokrom Standar Resmi)
                </h2>
                <p class="text-xs text-slate-600 font-medium">Format baku monokrom dapat langsung dicetak sesuai dokumen standar IAI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs">
            <a href="{{ route('reports.financial-position') }}" class="p-4 rounded-xl border-2 border-slate-900 bg-sky-50/50 hover:bg-sky-100/70 shadow-[3px_3px_0px_0px_#0f172a] transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500 text-white border-2 border-slate-900 flex items-center justify-center text-base flex-shrink-0 shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-black text-sm uppercase">Posisi Keuangan</strong>
                    <span class="text-slate-600 text-[11px] font-medium">Format A Hal. 21 PDF &bull; Neraca</span>
                </div>
            </a>

            <a href="{{ route('reports.comprehensive-income') }}" class="p-4 rounded-xl border-2 border-slate-900 bg-blue-50/50 hover:bg-blue-100/70 shadow-[3px_3px_0px_0px_#0f172a] transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-500 text-white border-2 border-slate-900 flex items-center justify-center text-base flex-shrink-0 shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-black text-sm uppercase">Penghasilan Komprehensif</strong>
                    <span class="text-slate-600 text-[11px] font-medium">Format A Hal. 24 PDF &bull; Surplus</span>
                </div>
            </a>

            <a href="{{ route('reports.net-assets') }}" class="p-4 rounded-xl border-2 border-slate-900 bg-indigo-50/50 hover:bg-indigo-100/70 shadow-[3px_3px_0px_0px_#0f172a] transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-500 text-white border-2 border-slate-900 flex items-center justify-center text-base flex-shrink-0 shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-black text-sm uppercase">Perubahan Aset Neto</strong>
                    <span class="text-slate-600 text-[11px] font-medium">Hal. 26 PDF &bull; Rekonsiliasi</span>
                </div>
            </a>

            <a href="{{ route('reports.cash-flow') }}" class="p-4 rounded-xl border-2 border-slate-900 bg-cyan-50/50 hover:bg-cyan-100/70 shadow-[3px_3px_0px_0px_#0f172a] transition flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-cyan-600 text-white border-2 border-slate-900 flex items-center justify-center text-base flex-shrink-0 shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </div>
                <div>
                    <strong class="text-slate-900 block font-black text-sm uppercase">Laporan Arus Kas</strong>
                    <span class="text-slate-600 text-[11px] font-medium">Hal. 27 PDF &bull; Metode Langsung</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Journal Entries Table -->
    <div class="maxi-card p-6 bg-white">
        <div class="flex items-center justify-between mb-4 border-b-2 border-slate-900 pb-3">
            <div>
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">
                    Jurnal Umum &amp; Transaksi Pembukuan Terakhir
                </h2>
                <p class="text-xs text-slate-600 font-medium">Daftar entri jurnal akuntansi yang tercatat di buku besar:</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('journals.index') }}" class="maxi-btn-white px-3 py-1.5 text-xs font-black flex items-center gap-1">
                    <span>Semua Jurnal</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <a href="{{ route('journals.ledger') }}" class="maxi-btn-sky px-3 py-1.5 text-xs font-black flex items-center gap-1">
                    <span>Buku Besar</span>
                    <i class="fa-solid fa-book text-[10px]"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-100 text-slate-900 font-black border-2 border-slate-900 uppercase text-[11px]">
                    <tr>
                        <th class="p-3 border-r border-slate-300">No. Jurnal</th>
                        <th class="p-3 border-r border-slate-300">Tanggal</th>
                        <th class="p-3 border-r border-slate-300">Keterangan Transaksi</th>
                        <th class="p-3 border-r border-slate-300">Referensi</th>
                        <th class="p-3 text-right border-r border-slate-300">Debit</th>
                        <th class="p-3 text-right">Kredit</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-slate-200 border-2 border-slate-900">
                    @forelse($recentJournals ?? [] as $journal)
                        <tr class="hover:bg-slate-50 transition font-medium">
                            <td class="p-3 font-mono font-bold text-sky-800 border-r border-slate-200">{{ $journal->entry_number }}</td>
                            <td class="p-3 text-slate-600 border-r border-slate-200">{{ \Carbon\Carbon::parse($journal->entry_date)->format('d/m/Y') }}</td>
                            <td class="p-3 font-bold text-slate-900 border-r border-slate-200">{{ $journal->description }}</td>
                            <td class="p-3 font-mono text-slate-500 border-r border-slate-200">{{ $journal->reference_number ?? '-' }}</td>
                            <td class="p-3 text-right font-mono font-bold text-slate-900 border-r border-slate-200">
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
