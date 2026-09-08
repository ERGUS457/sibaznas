@extends('layouts.app')

@section('title', 'Dashboard Operasional UPZ BAZNAS')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner (Maximalist) -->
    <div class="maxi-card p-6 border-l-8 border-l-emerald-500 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-950 px-3 py-1 maxi-badge">
                    MODUL UNIT PENGUMPUL ZAKAT (UPZ)
                </span>
                <span class="text-xs text-slate-400 font-bold">&bull;</span>
                <span class="text-xs font-bold text-slate-600">Peraturan BAZNAS RI No. 2 Tahun 2016</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase">
                Pengelolaan &amp; Pelaporan Zakat UPZ {{ $upz->name ?? 'BAZNAS' }}
            </h1>
            <p class="text-xs text-slate-600 font-medium mt-0.5">
                Penerimaan ZIS, penerbitan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, dan kepatuhan hak amil maks 12,5%.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('portal') }}" class="maxi-btn-white px-4 py-2.5 text-xs font-black flex items-center gap-2 text-slate-900">
                <i class="fa-solid fa-arrow-left text-emerald-600"></i>
                <span>Ganti Modul (Portal)</span>
            </a>
            <a href="{{ route('collections.create') }}" class="maxi-btn-emerald px-4 py-2.5 text-xs font-black flex items-center gap-2">
                <i class="fa-solid fa-receipt"></i>
                <span>Input Setoran (BSZ)</span>
            </a>
        </div>
    </div>

    <!-- ZIS KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- KPI 1: Total Penghimpunan ZIS -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-emerald-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Total ZIS Dihimpun</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalZisCollected, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-emerald-800 font-bold mt-1">
                Dari {{ $muzakkiCount }} Muzakki Terdaftar
            </div>
        </div>

        <!-- KPI 2: Penyaluran Mustahik -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-teal-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Penyaluran (8 Asnaf)</span>
                <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-parachute-box"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalDistributed, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-teal-800 font-bold mt-1">
                Kepada {{ $mustahiqCount }} Mustahik Berhak
            </div>
        </div>

        <!-- KPI 3: Setoran ke BAZNAS -->
        <div class="maxi-card p-5 bg-white border-t-4 border-t-sky-500">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Disetor ke BAZNAS</span>
                <div class="w-9 h-9 rounded-xl bg-sky-100 text-sky-900 border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalRemittedToBaznas, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                Rekening resmi BAZNAS Pembina
            </div>
        </div>

        <!-- KPI 4: Kepatuhan Batas Amil (12.5%) -->
        <div class="maxi-card p-5 bg-white border-t-4 {{ $effectiveAmilPercentage <= 12.5 ? 'border-t-emerald-500' : 'border-t-rose-500' }}">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-black uppercase tracking-wider text-slate-800">Batas Hak Amil</span>
                <div class="w-9 h-9 rounded-xl {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-100 text-emerald-900' : 'bg-rose-100 text-rose-900' }} border-2 border-slate-900 flex items-center justify-center text-sm font-black shadow-[2px_2px_0px_0px_#0f172a]">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>
            <div class="text-2xl font-black {{ $effectiveAmilPercentage <= 12.5 ? 'text-emerald-800' : 'text-rose-800' }} tracking-tight">
                {{ number_format($effectiveAmilPercentage, 2) }}%
            </div>
            <div class="text-[11px] text-slate-600 font-semibold mt-1">
                {{ $effectiveAmilPercentage <= 12.5 ? '✓ Sesuai Regulasi (Maks 12,5%)' : '! Melebihi Batas' }}
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to Perbaznas Lampiran Sheets -->
    <div class="maxi-card p-6 bg-white">
        <div class="flex items-center justify-between mb-4 border-b-2 border-slate-900 pb-3">
            <div>
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">
                    Lembar Lampiran Resmi Peraturan BAZNAS No. 2 Tahun 2016 (Monokrom 100%)
                </h2>
                <p class="text-xs text-slate-600 font-medium">Pilih lampiran resmi untuk dicetak sesuai format asli standar BAZNAS RI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="p-3.5 rounded-xl border-2 border-slate-900 bg-emerald-50/50 hover:bg-emerald-100 shadow-[3px_3px_0px_0px_#0f172a] transition block">
                <span class="text-[10px] font-black uppercase text-emerald-900 block">Lampiran I</span>
                <strong class="text-slate-900 text-xs font-black block mt-0.5">Rencana Penerimaan</strong>
                <span class="text-[10px] text-slate-600 font-medium">Hal. 33 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="p-3.5 rounded-xl border-2 border-slate-900 bg-emerald-50/50 hover:bg-emerald-100 shadow-[3px_3px_0px_0px_#0f172a] transition block">
                <span class="text-[10px] font-black uppercase text-emerald-900 block">Lampiran II</span>
                <strong class="text-slate-900 text-xs font-black block mt-0.5">Distribusi Asnaf</strong>
                <span class="text-[10px] text-slate-600 font-medium">Hal. 34 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="p-3.5 rounded-xl border-2 border-slate-900 bg-emerald-50/50 hover:bg-emerald-100 shadow-[3px_3px_0px_0px_#0f172a] transition block">
                <span class="text-[10px] font-black uppercase text-emerald-900 block">Lampiran III</span>
                <strong class="text-slate-900 text-xs font-black block mt-0.5">Distribusi Program</strong>
                <span class="text-[10px] text-slate-600 font-medium">Hal. 35 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="p-3.5 rounded-xl border-2 border-slate-900 bg-emerald-50/50 hover:bg-emerald-100 shadow-[3px_3px_0px_0px_#0f172a] transition block">
                <span class="text-[10px] font-black uppercase text-emerald-900 block">Lampiran V</span>
                <strong class="text-slate-900 text-xs font-black block mt-0.5">Dana Operasional</strong>
                <span class="text-[10px] text-slate-600 font-medium">Hal. 37 PDF (12,5%)</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="p-3.5 rounded-xl border-2 border-slate-900 bg-emerald-50/50 hover:bg-emerald-100 shadow-[3px_3px_0px_0px_#0f172a] transition block">
                <span class="text-[10px] font-black uppercase text-emerald-900 block">Lampiran VII</span>
                <strong class="text-slate-900 text-xs font-black block mt-0.5">Laporan Penyaluran</strong>
                <span class="text-[10px] text-slate-600 font-medium">Hal. 39 PDF (Verifikasi)</span>
            </a>
        </div>
    </div>

    <!-- Recent Collections (BSZ) & Recent Distributions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Recent Collections -->
        <div class="maxi-card p-6 bg-white">
            <div class="flex items-center justify-between mb-4 border-b-2 border-slate-900 pb-3">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">
                    Penerimaan ZIS Terakhir (BSZ)
                </h2>
                <a href="{{ route('collections.index') }}" class="text-xs font-black text-emerald-700 hover:text-emerald-900 uppercase">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3 text-xs">
                @forelse($recentCollections as $col)
                    <div class="p-3.5 rounded-xl border-2 border-slate-900 bg-slate-50/60 hover:bg-slate-100 flex items-center justify-between transition shadow-[2px_2px_0px_0px_#0f172a]">
                        <div>
                            <div class="font-mono font-black text-emerald-800 text-xs">{{ $col->bsz_number }}</div>
                            <div class="font-black text-slate-900 mt-0.5">{{ $col->muzakki->name ?? 'Muzakki Umum' }}</div>
                            <div class="text-[10px] text-slate-500 font-semibold capitalize">{{ str_replace('_', ' ', $col->fund_type) }} &bull; {{ $col->transaction_date->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-mono font-black text-slate-900 text-sm">
                                Rp {{ number_format($col->amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('collections.print-bsz', $col->id) }}" target="_blank" class="inline-block mt-1 text-[10px] font-black text-slate-700 hover:text-black underline">
                                <i class="fa-solid fa-print mr-0.5"></i> Cetak BSZ
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400 italic">
                        Belum ada penerimaan ZIS yang tercatat.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Distributions -->
        <div class="maxi-card p-6 bg-white">
            <div class="flex items-center justify-between mb-4 border-b-2 border-slate-900 pb-3">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">
                    Penyaluran Terakhir (8 Asnaf)
                </h2>
                <a href="{{ route('distributions.index') }}" class="text-xs font-black text-teal-700 hover:text-teal-900 uppercase">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3 text-xs">
                @forelse($recentDistributions as $dist)
                    <div class="p-3.5 rounded-xl border-2 border-slate-900 bg-slate-50/60 hover:bg-slate-100 flex items-center justify-between transition shadow-[2px_2px_0px_0px_#0f172a]">
                        <div>
                            <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-full bg-teal-100 text-teal-950 border border-teal-800">
                                Asnaf {{ str_replace('_', ' ', $dist->asnaf_category) }}
                            </span>
                            <div class="font-black text-slate-900 mt-1">{{ $dist->mustahiq->name ?? ($dist->recipient_name ?? 'Mustahik') }}</div>
                            <div class="text-[10px] text-slate-500 font-semibold">{{ $dist->program_name ?? 'Program Sosial' }} &bull; {{ \Carbon\Carbon::parse($dist->distribution_date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right font-mono font-black text-teal-800 text-sm">
                            Rp {{ number_format($dist->amount, 0, ',', '.') }}
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-400 italic">
                        Belum ada data penyaluran kepada mustahik.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
