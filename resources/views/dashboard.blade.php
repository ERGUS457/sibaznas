@extends('layouts.app')

@section('title', 'Dashboard Panel Kerja - SIM-ORGANISASI & ISAK 35')

@section('content')
<div x-data="{ activeTab: 'operasional' }" class="space-y-6">

    <!-- Top Header & Claymorphic Mode Switcher -->
    <div class="clay-card p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Panel Kerja Aplikasi</h1>
                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100/80 px-2.5 py-0.5 rounded-full border border-emerald-300/60">
                    DE ISAK 35 FORMAT A
                </span>
            </div>
            <p class="text-xs text-slate-500">Pilih modul kerja sesuai tugas operasional atau laporan keuangan</p>
        </div>

        <!-- Interactive Clay Segmented Tab Switcher -->
        <div class="inline-flex p-1.5 bg-slate-100/90 rounded-2xl border border-slate-200/80 self-start sm:self-auto shadow-inner">
            <button 
                @click="activeTab = 'operasional'"
                :class="activeTab === 'operasional' ? 'clay-btn-white font-extrabold text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-800 font-semibold'"
                class="flex items-center space-x-2 px-4 py-2 rounded-xl text-xs transition">
                <i class="fa-solid fa-hand-holding-heart text-emerald-600"></i>
                <span>Operasional Organisasi</span>
            </button>
            <button 
                @click="activeTab = 'akuntansi'"
                :class="activeTab === 'akuntansi' ? 'clay-btn-white font-extrabold text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-800 font-semibold'"
                class="flex items-center space-x-2 px-4 py-2 rounded-xl text-xs transition">
                <i class="fa-solid fa-scale-balanced text-emerald-600"></i>
                <span>Akuntansi &amp; ISAK 35</span>
            </button>
        </div>
    </div>

    <!-- ============================================================= -->
    <!-- TAB 1: OPERASIONAL ORGANISASI                                 -->
    <!-- ============================================================= -->
    <div x-show="activeTab === 'operasional'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

        <!-- Action Bar & Org Info -->
        <div class="clay-card p-5 flex flex-wrap items-center justify-between gap-4">
            <div class="text-xs text-slate-600 space-y-0.5">
                <div class="font-extrabold text-slate-900 text-sm flex items-center gap-1.5">
                    <i class="fa-solid fa-building text-amber-500"></i>
                    <span>{{ $upz->name ?? 'Organisasi' }}</span>
                </div>
                <div class="text-[11px] text-slate-500">
                    SK / Legalitas: <strong>{{ $upz->sk_number ?? 'Resmi' }}</strong> &bull; Hak Amil / Operasional: <strong class="text-emerald-700">{{ $upz->amil_share_percentage ?? 12.50 }}%</strong>
                </div>
            </div>

            <!-- Clay Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('collections.create') }}" class="clay-btn-emerald text-xs font-bold px-4 py-2.5 flex items-center space-x-2">
                    <i class="fa-solid fa-receipt text-xs"></i>
                    <span>Terima Dana / Buat BSZ</span>
                </a>
                <a href="{{ route('distributions.create') }}" class="clay-btn-white text-xs font-bold px-4 py-2.5 flex items-center space-x-2 text-slate-700">
                    <i class="fa-solid fa-parachute-box text-xs text-teal-600"></i>
                    <span>Salurkan ke Penerima</span>
                </a>
                <a href="{{ route('remittances.create') }}" class="clay-btn-white text-xs font-bold px-4 py-2.5 flex items-center space-x-2 text-slate-700">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-amber-600"></i>
                    <span>Setor Induk</span>
                </a>
            </div>
        </div>

        <!-- 3 Primary Clay KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- 1. Kas ZIS Siap Salur -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Kas ZIS Siap Salur</span>
                    <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-base font-bold shadow-xs">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="text-2xl font-black text-emerald-800 font-mono">
                    Rp {{ number_format($availableZisCash, 0, ',', '.') }}
                </div>
                <p class="text-xs text-slate-500 flex items-center gap-1.5 pt-1 border-t border-slate-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Saldo kas ZIS tersedia untuk 8 asnaf</span>
                </p>
            </div>

            <!-- 2. Total Pengumpulan ZIS -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Total Pengumpulan ZIS</span>
                    <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-base font-bold shadow-xs">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                </div>
                <div class="text-2xl font-black text-slate-900 font-mono">
                    Rp {{ number_format($totalZisCollected, 0, ',', '.') }}
                </div>
                <div class="text-xs text-slate-500 flex items-center justify-between pt-1 border-t border-slate-100">
                    <span>Dari {{ $muzakkiCount }} muzaki tercatat</span>
                    <a href="{{ route('collections.index') }}" class="text-emerald-700 hover:text-emerald-900 font-bold">Lihat Semua &rarr;</a>
                </div>
            </div>

            <!-- 3. Total Penyaluran -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Tersalurkan ke Mustahik</span>
                    <div class="w-10 h-10 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center text-base font-bold shadow-xs">
                        <i class="fa-solid fa-people-carry-box"></i>
                    </div>
                </div>
                <div class="text-2xl font-black text-slate-900 font-mono">
                    Rp {{ number_format($totalDistributed, 0, ',', '.') }}
                </div>
                <div class="text-xs text-slate-500 flex items-center justify-between pt-1 border-t border-slate-100">
                    <span>8 Asnaf &bull; 5 Bidang Program</span>
                    <a href="{{ route('distributions.index') }}" class="text-teal-700 hover:text-teal-900 font-bold">Lihat Semua &rarr;</a>
                </div>
            </div>
        </div>

        <!-- 2 Recent Activity Tables (Claymorphic) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Penerimaan ZIS Terkini -->
            <div class="clay-card p-5 space-y-4 overflow-hidden flex flex-col">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Penerimaan ZIS Terkini</h3>
                    </div>
                    <a href="{{ route('collections.index') }}" class="text-xs text-emerald-700 hover:text-emerald-900 font-bold">Semua Data &rarr;</a>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50/80 text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2.5 px-3 font-semibold">No. BSZ</th>
                                <th class="py-2.5 px-3 font-semibold">Muzaki</th>
                                <th class="py-2.5 px-3 font-semibold text-right">Nominal</th>
                                <th class="py-2.5 px-3 font-semibold text-center">Cetak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentCollections as $col)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-3 px-3 font-mono font-bold text-emerald-800">{{ $col->bsz_number }}</td>
                                <td class="py-3 px-3 font-semibold text-slate-900">{{ $col->muzakki->name }}</td>
                                <td class="py-3 px-3 text-right font-extrabold text-slate-900">Rp {{ number_format($col->amount, 0, ',', '.') }}</td>
                                <td class="py-3 px-3 text-center">
                                    <a href="{{ route('collections.print-bsz', $col->id) }}" target="_blank" class="clay-btn-white inline-flex items-center gap-1 text-[11px] px-2.5 py-1 text-emerald-800 font-bold" title="Cetak Lembar BSZ">
                                        <i class="fa-solid fa-print text-[10px]"></i>
                                        <span>BSZ</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada transaksi penerimaan tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Penyaluran Terkini -->
            <div class="clay-card p-5 space-y-4 overflow-hidden flex flex-col">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-teal-500"></div>
                        <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Penyaluran Terkini</h3>
                    </div>
                    <a href="{{ route('distributions.index') }}" class="text-xs text-teal-700 hover:text-teal-900 font-bold">Semua Data &rarr;</a>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-50/80 text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-2.5 px-3 font-semibold">No. Bukti</th>
                                <th class="py-2.5 px-3 font-semibold">Penerima</th>
                                <th class="py-2.5 px-3 font-semibold">Asnaf</th>
                                <th class="py-2.5 px-3 font-semibold text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentDistributions as $dst)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-3 px-3 font-mono text-slate-600">{{ $dst->distribution_number }}</td>
                                <td class="py-3 px-3 font-semibold text-slate-900">{{ $dst->recipient_identity_name ?? $dst->mustahiq?->name }}</td>
                                <td class="py-3 px-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] bg-teal-50 text-teal-800 border border-teal-200 font-bold capitalize">
                                        {{ $dst->asnaf_category }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-right font-extrabold text-slate-900">Rp {{ number_format($dst->amount, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-slate-400">Belum ada transaksi penyaluran tercatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ============================================================= -->
    <!-- TAB 2: AKUNTANSI & DE ISAK 35 (FORMAT A)                      -->
    <!-- ============================================================= -->
    <div x-show="activeTab === 'akuntansi'" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">

        <!-- Status Bar -->
        <div class="clay-card p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <h2 class="text-sm font-extrabold text-slate-900">Ikhtisar Laporan Keuangan DE ISAK 35</h2>
                <p class="text-xs text-slate-500">Format A Entitas Nonlaba &bull; Otomatis dari modul operasional UPZ</p>
            </div>
            <div>
                @if($financialPosition['is_balanced'] ?? true)
                <span class="clay-pill inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-800 text-xs font-extrabold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Neraca Seimbang (Aset = Liabilitas + Aset Neto)</span>
                </span>
                @else
                <span class="clay-pill inline-flex items-center gap-2 px-4 py-2 bg-rose-50 text-rose-800 text-xs font-extrabold border border-rose-200">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    <span>Perlu Penyesuaian Jurnal</span>
                </span>
                @endif
            </div>
        </div>

        <!-- 3 Financial Position Clay Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- 1. Total Aset -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Total Aset</div>
                <div class="text-2xl font-black text-slate-900 font-mono">
                    Rp {{ number_format($financialPosition['total_assets'], 0, ',', '.') }}
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                    <div class="flex justify-between">
                        <span>Aset Lancar (Kas &amp; Bank)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_current_assets'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Aset Tidak Lancar</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_non_current_assets'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. Total Liabilitas -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Total Liabilitas</div>
                <div class="text-2xl font-black text-slate-900 font-mono">
                    Rp {{ number_format($financialPosition['total_liabilities'], 0, ',', '.') }}
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                    <div class="flex justify-between">
                        <span>Utang Penyetoran BAZNAS</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_current_liabilities'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Liabilitas Jangka Panjang</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_non_current_liabilities'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- 3. Total Aset Neto -->
            <div class="clay-card clay-card-interactive p-6 space-y-3">
                <div class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Total Aset Neto</div>
                <div class="text-2xl font-black text-emerald-800 font-mono">
                    Rp {{ number_format($financialPosition['total_net_assets'], 0, ',', '.') }}
                </div>
                <div class="mt-3 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                    <div class="flex justify-between">
                        <span>Tanpa Pembatasan (Amil)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_unrestricted_net_assets'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Dengan Pembatasan (ZIS)</span>
                        <span class="font-bold text-slate-800">Rp {{ number_format($financialPosition['total_restricted_net_assets'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Laporan Keuangan DE ISAK 35 Format A (Direct Clay Access) -->
        <div class="clay-card p-6 space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">4 Laporan Keuangan Resmi (DE ISAK 35 Format A)</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Laporan standar akuntansi IAI untuk audit KAP dan pertanggungjawaban BAZNAS</p>
                </div>
                <div class="flex items-center space-x-2.5">
                    <a href="{{ route('journals.index') }}" class="clay-btn-white text-xs font-bold px-3 py-1.5 text-slate-700">
                        <i class="fa-solid fa-book text-slate-400 mr-1"></i>
                        <span>Buku Jurnal</span>
                    </a>
                    <a href="{{ route('journals.trial-balance') }}" class="clay-btn-white text-xs font-bold px-3 py-1.5 text-slate-700">
                        <i class="fa-solid fa-scale-balanced text-slate-400 mr-1"></i>
                        <span>Neraca Saldo</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- 1. Posisi Keuangan -->
                <a href="{{ route('reports.financial-position') }}" class="clay-card-soft p-5 hover:translate-y-[-2px] transition flex flex-col justify-between group">
                    <div>
                        <div class="text-emerald-600 text-xs font-extrabold">01</div>
                        <div class="font-extrabold text-slate-900 text-xs mt-1 group-hover:text-emerald-700 transition">Laporan Posisi Keuangan</div>
                        <p class="text-[11px] text-slate-500 mt-1">Neraca Aset, Liabilitas, dan Aset Neto</p>
                    </div>
                    <div class="mt-4 text-[11px] font-bold text-emerald-700 flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </div>
                </a>

                <!-- 2. Penghasilan Komprehensif -->
                <a href="{{ route('reports.comprehensive-income') }}" class="clay-card-soft p-5 hover:translate-y-[-2px] transition flex flex-col justify-between group">
                    <div>
                        <div class="text-emerald-600 text-xs font-extrabold">02</div>
                        <div class="font-extrabold text-slate-900 text-xs mt-1 group-hover:text-emerald-700 transition">Penghasilan Komprehensif</div>
                        <p class="text-[11px] text-slate-500 mt-1">Pendapatan, Beban, dan Surplus/Defisit</p>
                    </div>
                    <div class="mt-4 text-[11px] font-bold text-emerald-700 flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </div>
                </a>

                <!-- 3. Perubahan Aset Neto -->
                <a href="{{ route('reports.net-assets') }}" class="clay-card-soft p-5 hover:translate-y-[-2px] transition flex flex-col justify-between group">
                    <div>
                        <div class="text-emerald-600 text-xs font-extrabold">03</div>
                        <div class="font-extrabold text-slate-900 text-xs mt-1 group-hover:text-emerald-700 transition">Perubahan Aset Neto</div>
                        <p class="text-[11px] text-slate-500 mt-1">Mutasi Dana Amil dan Dana ZIS</p>
                    </div>
                    <div class="mt-4 text-[11px] font-bold text-emerald-700 flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </div>
                </a>

                <!-- 4. Arus Kas -->
                <a href="{{ route('reports.cash-flow') }}" class="clay-card-soft p-5 hover:translate-y-[-2px] transition flex flex-col justify-between group">
                    <div>
                        <div class="text-emerald-600 text-xs font-extrabold">04</div>
                        <div class="font-extrabold text-slate-900 text-xs mt-1 group-hover:text-emerald-700 transition">Laporan Arus Kas</div>
                        <p class="text-[11px] text-slate-500 mt-1">Metode Langsung Aktivitas Operasi</p>
                    </div>
                    <div class="mt-4 text-[11px] font-bold text-emerald-700 flex items-center gap-1">
                        <span>Buka Laporan</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
