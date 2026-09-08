@extends('layouts.app')

@section('title', 'Laporan Kepatuhan Tata Kerja UPZ (Perbaznas No. 2/2016)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Laporan Kepatuhan Tata Kerja UPZ BAZNAS</h1>
            <p class="text-xs text-slate-500">Evaluasi tata kelola operasional dan batasan hak amil sesuai Perbaznas No. 2 Tahun 2016.</p>
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="window.print()" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Laporan</span>
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-6">
        <!-- Official Header -->
        <div class="text-center border-b-2 border-slate-800 pb-4">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide">{{ $upz->name }}</h2>
            <p class="text-xs text-slate-500">SK Penetapan: {{ $upz->sk_number }} &bull; Induk: {{ $upz->parent_baznas_name }}</p>
            <h1 class="text-lg font-black text-emerald-950 uppercase tracking-wider mt-2">
                LAPORAN PERTANGGUNGJAWABAN DAN TATA KERJA UPZ
            </h1>
            <p class="text-xs font-semibold text-slate-700">Tahun Anggaran {{ $year }}</p>
            <p class="text-[11px] text-slate-400 italic">Berdasarkan Format Lampiran Peraturan BAZNAS No. 2 Tahun 2016</p>
        </div>

        <!-- Compliance Evaluation Card -->
        <div class="p-4 rounded-xl border {{ $effectiveAmilPercentage <= 12.50 ? 'bg-emerald-50 border-emerald-300 text-emerald-900' : 'bg-rose-50 border-rose-300 text-rose-900' }} text-xs">
            <div class="flex items-center justify-between font-bold text-sm mb-2">
                <span class="flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                    <span>Status Kepatuhan Regulasi BAZNAS:</span>
                </span>
                <span class="px-2.5 py-0.5 rounded-full {{ $effectiveAmilPercentage <= 12.50 ? 'bg-emerald-200 text-emerald-900' : 'bg-rose-200 text-rose-900' }}">
                    {{ $complianceStatus }}
                </span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-2 text-center">
                <div class="bg-white/80 p-2.5 rounded-lg border border-slate-200">
                    <span class="text-slate-500 text-[11px]">Total Penghimpunan ZIS</span>
                    <div class="font-bold text-slate-900 mt-0.5">Rp {{ number_format($grandTotalCollected, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white/80 p-2.5 rounded-lg border border-slate-200">
                    <span class="text-slate-500 text-[11px]">Bagian Hak Amil UPZ</span>
                    <div class="font-bold text-amber-700 mt-0.5">Rp {{ number_format($grandTotalAmil, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white/80 p-2.5 rounded-lg border border-slate-200">
                    <span class="text-slate-500 text-[11px]">Rasio Amil Efektif</span>
                    <div class="font-bold text-slate-900 mt-0.5">{{ number_format($effectiveAmilPercentage, 2) }}% (Maks 12.5%)</div>
                </div>
                <div class="bg-white/80 p-2.5 rounded-lg border border-slate-200">
                    <span class="text-slate-500 text-[11px]">Telah Disetor ke BAZNAS</span>
                    <div class="font-bold text-emerald-700 mt-0.5">Rp {{ number_format($grandTotalRemitted, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Section 1: Rekapitulasi Pengumpulan per Jenis Dana -->
        <div class="text-xs space-y-2">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1">
                I. Rekapitulasi Pengumpulan ZIS &amp; DSKL (Pasal 9 Perbaznas 2/2016)
            </h3>
            <table class="w-full text-left">
                <thead class="bg-slate-100 text-slate-700 font-bold">
                    <tr>
                        <th class="p-2.5">Jenis Dana ZIS</th>
                        <th class="p-2.5 text-center">Jumlah Transaksi (BSZ)</th>
                        <th class="p-2.5 text-right">Total Dihimpun (Rp)</th>
                        <th class="p-2.5 text-right">Alokasi Hak Amil (Rp)</th>
                        <th class="p-2.5 text-right">Netto Mustahiq (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($collectionsByFund as $c)
                    <tr>
                        <td class="p-2.5 font-semibold text-slate-900 capitalize">{{ str_replace('_', ' ', $c->fund_type) }}</td>
                        <td class="p-2.5 text-center text-slate-600">{{ $c->total_tx }} BSZ</td>
                        <td class="p-2.5 text-right font-mono font-bold text-slate-800">Rp {{ number_format($c->total_amount, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono text-amber-700">Rp {{ number_format($c->total_amil, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono font-bold text-emerald-800">Rp {{ number_format($c->total_net, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-slate-400">Belum ada transaksi pengumpulan pada tahun ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-slate-50 font-bold border-t border-slate-300">
                    <tr>
                        <td colspan="2" class="p-2.5 text-right uppercase">Total:</td>
                        <td class="p-2.5 text-right font-mono text-slate-900">Rp {{ number_format($grandTotalCollected, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono text-amber-700">Rp {{ number_format($grandTotalAmil, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono text-emerald-800">Rp {{ number_format($grandTotalCollected - $grandTotalAmil, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Section 2: Rekapitulasi Penyaluran per 8 Asnaf -->
        <div class="text-xs space-y-2">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1">
                II. Rekapitulasi Penyaluran Zakat Berdasarkan 8 Asnaf (Pasal 16 Perbaznas 2/2016)
            </h3>
            <table class="w-full text-left">
                <thead class="bg-slate-100 text-slate-700 font-bold">
                    <tr>
                        <th class="p-2.5">Kategori Asnaf (QS. At-Taubah: 60)</th>
                        <th class="p-2.5 text-center">Frekuensi Bantuan</th>
                        <th class="p-2.5 text-right">Total Bantuan (Rp)</th>
                        <th class="p-2.5 text-right">Persentase (%)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($distributionsByAsnaf as $d)
                    @php
                        $pct = $grandTotalDistributed > 0 ? ($d->total_amount / $grandTotalDistributed) * 100 : 0;
                    @endphp
                    <tr>
                        <td class="p-2.5 font-semibold text-slate-900 capitalize">{{ $d->asnaf_category }}</td>
                        <td class="p-2.5 text-center text-slate-600">{{ $d->total_tx }} kali</td>
                        <td class="p-2.5 text-right font-mono font-bold text-slate-800">Rp {{ number_format($d->total_amount, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono font-medium">{{ number_format($pct, 1) }}%</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-slate-400">Belum ada penyaluran langsung pada tahun ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-slate-50 font-bold border-t border-slate-300">
                    <tr>
                        <td colspan="2" class="p-2.5 text-right uppercase">Total Penyaluran:</td>
                        <td class="p-2.5 text-right font-mono text-teal-800 font-extrabold">Rp {{ number_format($grandTotalDistributed, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-right font-mono">100.0%</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Section 3: Rekapitulasi Setoran ke BAZNAS -->
        <div class="text-xs space-y-2">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1">
                III. Penyetoran ke Rekening BAZNAS Pembina (Pasal 14 Perbaznas 2/2016)
            </h3>
            <table class="w-full text-left">
                <thead class="bg-slate-100 text-slate-700 font-bold">
                    <tr>
                        <th class="p-2.5">No. Setoran</th>
                        <th class="p-2.5">Tanggal</th>
                        <th class="p-2.5">Periode</th>
                        <th class="p-2.5">Bank Rekening BAZNAS</th>
                        <th class="p-2.5 text-right">Nominal (Rp)</th>
                        <th class="p-2.5 text-center">Status Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($remittances as $r)
                    <tr>
                        <td class="p-2.5 font-mono font-bold text-amber-800">{{ $r->remittance_number }}</td>
                        <td class="p-2.5 text-slate-500">{{ $r->remittance_date->format('d/m/Y') }}</td>
                        <td class="p-2.5 font-medium">{{ $r->period_label }}</td>
                        <td class="p-2.5 text-slate-700">{{ $r->target_baznas_bank }} ({{ $r->target_baznas_account_number }})</td>
                        <td class="p-2.5 text-right font-mono font-bold text-slate-900">Rp {{ number_format($r->amount_remitted, 0, ',', '.') }}</td>
                        <td class="p-2.5 text-center font-semibold text-emerald-700">{{ strtoupper(str_replace('_', ' ', $r->status)) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-slate-400">Belum ada data penyetoran ke BAZNAS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Official Signatures -->
        <div class="grid grid-cols-2 gap-8 pt-8 text-xs text-center">
            <div class="space-y-1">
                <div class="text-slate-500">Ketua Pengurus UPZ BAZNAS,</div>
                <div class="h-20"></div>
                <div class="font-bold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">{{ $upz->chairman_name ?? 'Ketua UPZ' }}</div>
            </div>
            <div class="space-y-1">
                <div class="text-slate-500">Sekretaris UPZ BAZNAS,</div>
                <div class="h-20"></div>
                <div class="font-bold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">{{ $upz->secretary_name ?? 'Sekretaris UPZ' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
