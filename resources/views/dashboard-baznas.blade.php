@extends('layouts.app')

@section('title', 'Dashboard Operasional UPZ BAZNAS')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner (Formal Corporate) -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 border-l-4 border-l-emerald-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-1.5">
                <span class="text-[10px] font-semibold uppercase tracking-wider bg-emerald-50 text-emerald-800 px-2.5 py-0.5 rounded border border-emerald-200">
                    MODUL UNIT PENGUMPUL ZAKAT (UPZ)
                </span>
                <span class="text-xs text-slate-300">&bull;</span>
                <span class="text-xs text-slate-500 font-medium">Peraturan BAZNAS RI No. 2 Tahun 2016</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Pengelolaan &amp; Pelaporan Zakat UPZ {{ $upz->name ?? 'BAZNAS' }}
            </h1>
            <p class="text-xs text-slate-600 font-normal mt-0.5">
                Penerimaan ZIS, penerbitan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, dan kepatuhan hak amil maks 12,5%.
            </p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('portal') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2 text-slate-700">
                <i class="fa-solid fa-arrow-left text-slate-400"></i>
                <span>Ganti Modul</span>
            </a>
            <a href="{{ route('collections.create') }}" class="clay-btn-emerald px-3.5 py-2 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-receipt text-[11px]"></i>
                <span>Input Setoran (BSZ)</span>
            </a>
        </div>
    </div>

    <!-- ZIS KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- KPI 1: Total Penghimpunan ZIS -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Total ZIS Dihimpun</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($totalZisCollected, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-emerald-700 font-medium mt-1">
                Dari {{ $muzakkiCount }} Muzakki Terdaftar
            </div>
        </div>

        <!-- KPI 2: Penyaluran Mustahik -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Penyaluran (8 Asnaf)</span>
                <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-parachute-box"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($totalDistributed, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-teal-700 font-medium mt-1">
                Kepada {{ $mustahiqCount }} Mustahik Berhak
            </div>
        </div>

        <!-- KPI 3: Setoran ke BAZNAS -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Disetor ke BAZNAS</span>
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-sm">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
            <div class="text-xl font-bold text-slate-900 tracking-tight">
                Rp {{ number_format($totalRemittedToBaznas, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                Rekening resmi BAZNAS Pembina
            </div>
        </div>

        <!-- KPI 4: Kepatuhan Batas Amil (12.5%) -->
        <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-700">Batas Hak Amil</span>
                <div class="w-8 h-8 rounded-lg {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }} flex items-center justify-center text-sm">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>
            <div class="text-xl font-bold {{ $effectiveAmilPercentage <= 12.5 ? 'text-emerald-700' : 'text-rose-700' }} tracking-tight">
                {{ number_format($effectiveAmilPercentage, 2) }}%
            </div>
            <div class="text-[11px] text-slate-500 font-medium mt-1">
                {{ $effectiveAmilPercentage <= 12.5 ? '✓ Sesuai Regulasi (Maks 12,5%)' : '! Melebihi Batas' }}
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to Perbaznas Lampiran Sheets -->
    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    Lembar Lampiran Resmi Peraturan BAZNAS No. 2 Tahun 2016 (Monokrom Standar Resmi)
                </h2>
                <p class="text-xs text-slate-500 font-normal">Pilih lampiran resmi untuk dicetak sesuai format asli standar BAZNAS RI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Lampiran I</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Rencana Penerimaan</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 33 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Lampiran II</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Distribusi Asnaf</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 34 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Lampiran III</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Distribusi Program</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 35 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Lampiran V</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Dana Operasional</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 37 PDF (12,5%)</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="p-3.5 rounded-lg border border-slate-200 bg-slate-50/50 hover:bg-slate-50 hover:border-slate-300 transition block">
                <span class="text-[10px] font-semibold uppercase text-emerald-700 block">Lampiran VII</span>
                <strong class="text-slate-900 text-xs font-semibold block mt-0.5">Laporan Penyaluran</strong>
                <span class="text-[10px] text-slate-500 font-normal">Hal. 39 PDF (Verifikasi)</span>
            </a>
        </div>
    </div>

    <!-- Recent Collections (BSZ) & Recent Distributions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Recent Collections -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    Penerimaan ZIS Terakhir (BSZ)
                </h2>
                <a href="{{ route('collections.index') }}" class="text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-2.5 text-xs">
                @forelse($recentCollections as $col)
                    <div class="p-3 rounded-lg border border-slate-200 bg-slate-50/40 hover:bg-slate-50 flex items-center justify-between transition">
                        <div>
                            <div class="font-mono font-semibold text-emerald-800 text-xs">{{ $col->bsz_number }}</div>
                            <div class="font-semibold text-slate-900 mt-0.5">{{ $col->muzakki->name ?? 'Muzakki Umum' }}</div>
                            <div class="text-[10px] text-slate-500 capitalize">{{ str_replace('_', ' ', $col->fund_type) }} &bull; {{ $col->transaction_date->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-mono font-bold text-slate-900 text-sm">
                                Rp {{ number_format($col->amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('collections.print-bsz', $col->id) }}" target="_blank" class="inline-block mt-0.5 text-[10px] font-medium text-slate-600 hover:text-emerald-700 underline">
                                <i class="fa-solid fa-print mr-0.5 text-[9px]"></i> Cetak BSZ
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
        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-xs">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h2 class="text-sm font-bold text-slate-900 tracking-tight">
                    Penyaluran Terakhir (8 Asnaf)
                </h2>
                <a href="{{ route('distributions.index') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-2.5 text-xs">
                @forelse($recentDistributions as $dist)
                    <div class="p-3 rounded-lg border border-slate-200 bg-slate-50/40 hover:bg-slate-50 flex items-center justify-between transition">
                        <div>
                            <span class="text-[10px] font-semibold uppercase px-2 py-0.5 rounded bg-teal-50 text-teal-800 border border-teal-200">
                                Asnaf {{ str_replace('_', ' ', $dist->asnaf_category) }}
                            </span>
                            <div class="font-semibold text-slate-900 mt-1">{{ $dist->mustahiq->name ?? ($dist->recipient_name ?? 'Mustahik') }}</div>
                            <div class="text-[10px] text-slate-500">{{ $dist->program_name ?? 'Program Sosial' }} &bull; {{ \Carbon\Carbon::parse($dist->distribution_date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right font-mono font-bold text-teal-800 text-sm">
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
