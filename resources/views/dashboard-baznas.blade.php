@extends('layouts.app')

@section('title', 'Dashboard Operasional UPZ BAZNAS')

@section('content')
<div class="space-y-6">

    <!-- Top Workspace Banner -->
    <div class="clay-card p-6 border-l-4 border-l-emerald-500 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] font-extrabold uppercase tracking-wider bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-full border border-emerald-200">
                    Modul Unit Pengumpul Zakat (UPZ)
                </span>
                <span class="text-xs text-slate-400">&bull;</span>
                <span class="text-xs font-semibold text-slate-600">Peraturan BAZNAS RI No. 2 Tahun 2016</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                Pengelolaan &amp; Pelaporan Zakat UPZ {{ $upz->name ?? 'BAZNAS' }}
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Penerimaan ZIS, pencetakan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, dan kepatuhan hak amil maks 12,5%.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('portal') }}" class="clay-btn-white px-4 py-2.5 text-xs font-bold flex items-center gap-2 text-slate-700 hover:text-slate-900 shadow-sm">
                <i class="fa-solid fa-arrow-left text-emerald-600"></i>
                <span>Ganti Modul (Portal)</span>
            </a>
            <a href="{{ route('collections.create') }}" class="clay-btn-emerald px-4 py-2.5 text-xs font-extrabold flex items-center gap-2 shadow-md">
                <i class="fa-solid fa-receipt"></i>
                <span>Input Setoran (BSZ)</span>
            </a>
        </div>
    </div>

    <!-- ZIS KPI Metrics (4 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- KPI 1: Total Penghimpunan ZIS -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total ZIS Dihimpun</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalZisCollected, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-emerald-700 font-semibold mt-1">
                Dari {{ $muzakkiCount }} Muzakki Terdaftar
            </div>
        </div>

        <!-- KPI 2: Penyaluran Mustahik -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Penyaluran (8 Asnaf)</span>
                <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-parachute-box"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalDistributed, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-teal-700 font-semibold mt-1">
                Kepada {{ $mustahiqCount }} Mustahik Berhak
            </div>
        </div>

        <!-- KPI 3: Setoran ke BAZNAS -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Disetor ke BAZNAS</span>
                <div class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
            </div>
            <div class="text-xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalRemittedToBaznas, 0, ',', '.') }}
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                Rekening resmi BAZNAS Pembina
            </div>
        </div>

        <!-- KPI 4: Kepatuhan Batas Amil (12.5%) -->
        <div class="clay-card p-5">
            <div class="flex items-center justify-between text-slate-400 mb-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Batas Hak Amil</span>
                <div class="w-8 h-8 rounded-xl {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>
            <div class="text-xl font-black {{ $effectiveAmilPercentage <= 12.5 ? 'text-emerald-700' : 'text-rose-700' }} tracking-tight">
                {{ number_format($effectiveAmilPercentage, 2) }}%
            </div>
            <div class="text-[11px] text-slate-500 mt-1">
                {{ $effectiveAmilPercentage <= 12.5 ? '✓ Sesuai Aturan (Maks 12,5%)' : '! Melebihi Batas Regulasi' }}
            </div>
        </div>
    </div>

    <!-- Quick Access Navigation to Perbaznas Lampiran Sheets -->
    <div class="clay-card p-6">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <div>
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Lembar Lampiran Resmi Peraturan BAZNAS No. 2 Tahun 2016 (Monokrom 100%)
                </h2>
                <p class="text-xs text-slate-500">Pilih lampiran resmi untuk dicetak sesuai format asli standar BAZNAS RI:</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 text-xs">
            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="clay-card-soft p-3 hover:border-emerald-300 transition block">
                <span class="text-[10px] font-bold text-emerald-700 block">Lampiran I</span>
                <strong class="text-slate-900 text-xs block mt-0.5">Rencana Penerimaan</strong>
                <span class="text-[10px] text-slate-500">Hal. 33 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="clay-card-soft p-3 hover:border-emerald-300 transition block">
                <span class="text-[10px] font-bold text-emerald-700 block">Lampiran II</span>
                <strong class="text-slate-900 text-xs block mt-0.5">Distribusi Asnaf</strong>
                <span class="text-[10px] text-slate-500">Hal. 34 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="clay-card-soft p-3 hover:border-emerald-300 transition block">
                <span class="text-[10px] font-bold text-emerald-700 block">Lampiran III</span>
                <strong class="text-slate-900 text-xs block mt-0.5">Distribusi Program</strong>
                <span class="text-[10px] text-slate-500">Hal. 35 PDF</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="clay-card-soft p-3 hover:border-emerald-300 transition block">
                <span class="text-[10px] font-bold text-emerald-700 block">Lampiran V</span>
                <strong class="text-slate-900 text-xs block mt-0.5">Dana Operasional</strong>
                <span class="text-[10px] text-slate-500">Hal. 37 PDF (Maks 12,5%)</span>
            </a>

            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="clay-card-soft p-3 hover:border-emerald-300 transition block">
                <span class="text-[10px] font-bold text-emerald-700 block">Lampiran VII</span>
                <strong class="text-slate-900 text-xs block mt-0.5">Laporan Penyaluran</strong>
                <span class="text-[10px] text-slate-500">Hal. 39 PDF (Verifikasi)</span>
            </a>
        </div>
    </div>

    <!-- Recent Collections (BSZ) & Recent Distributions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Recent Collections -->
        <div class="clay-card p-6">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Penerimaan ZIS Terakhir (BSZ)
                </h2>
                <a href="{{ route('collections.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3 text-xs">
                @forelse($recentCollections as $col)
                    <div class="p-3 rounded-xl border border-slate-100 hover:bg-slate-50 flex items-center justify-between transition">
                        <div>
                            <div class="font-mono font-bold text-emerald-800 text-[11px]">{{ $col->bsz_number }}</div>
                            <div class="font-bold text-slate-800 mt-0.5">{{ $col->muzakki->name ?? 'Muzakki Umum' }}</div>
                            <div class="text-[10px] text-slate-400 capitalize">{{ str_replace('_', ' ', $col->fund_type) }} &bull; {{ $col->transaction_date->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-mono font-extrabold text-slate-900 text-sm">
                                Rp {{ number_format($col->amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('collections.print-bsz', $col->id) }}" target="_blank" class="inline-block mt-1 text-[10px] font-bold text-slate-600 hover:text-black underline">
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
        <div class="clay-card p-6">
            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                <h2 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                    Penyaluran Terakhir (8 Asnaf)
                </h2>
                <a href="{{ route('distributions.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-900">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3 text-xs">
                @forelse($recentDistributions as $dist)
                    <div class="p-3 rounded-xl border border-slate-100 hover:bg-slate-50 flex items-center justify-between transition">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                                Asnaf {{ str_replace('_', ' ', $dist->asnaf_category) }}
                            </span>
                            <div class="font-bold text-slate-800 mt-1">{{ $dist->mustahiq->name ?? ($dist->recipient_name ?? 'Mustahik') }}</div>
                            <div class="text-[10px] text-slate-400">{{ $dist->program_name ?? 'Program Sosial' }} &bull; {{ \Carbon\Carbon::parse($dist->distribution_date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="text-right font-mono font-extrabold text-teal-800 text-sm">
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
