@extends('layouts.app')

@section('title', 'Laporan Arus Kas (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar (Hidden on Print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <h1 class="text-base font-bold text-slate-900">Laporan Arus Kas (Metode Langsung - DE ISAK 35)</h1>
            <p class="text-xs text-slate-500">Format resmi entitas berorientasi nonlaba sesuai lampiran Draf Eksposur ISAK 35 (Hal. 27).</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2 text-xs">
                <label for="start_date" class="font-medium text-slate-600">Periode:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" class="border border-slate-300 rounded px-2 py-1 focus:ring-1 focus:ring-black">
                <span class="text-slate-400">s/d</span>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" class="border border-slate-300 rounded px-2 py-1 focus:ring-1 focus:ring-black">
                <button type="submit" class="bg-slate-800 hover:bg-black text-white px-3 py-1 rounded font-medium">Tampilkan</button>
            </form>
            <button onclick="window.print()" class="bg-black hover:bg-slate-800 text-white font-medium text-xs px-3 py-1.5 rounded shadow flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Lembar Laporan</span>
            </button>
        </div>
    </div>

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 27) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Black Box Header as in DE ISAK 35 Page 27 -->
        <div class="bg-black text-white text-center py-3 px-4 mb-6">
            <div class="font-bold text-base tracking-wider uppercase">{{ $upz->name ?? 'ENTITAS XYZ' }}</div>
            <div class="font-semibold text-sm tracking-wide mt-0.5 uppercase">LAPORAN ARUS KAS (METODE LANGSUNG)</div>
            <div class="text-xs">untuk periode yang berakhir pada tanggal {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y') }}</div>
            <div class="text-xs italic font-normal">(dalam rupiah)</div>
        </div>

        <!-- Table Grid -->
        <table class="w-full border-collapse text-black">
            <thead>
                <tr class="font-bold text-right border-b border-black">
                    <th class="text-left py-1 font-bold"></th>
                    <th class="py-1 w-36 text-right">{{ \Carbon\Carbon::parse($endDate)->format('Y') }}</th>
                    <th class="py-1 w-36 text-right">{{ \Carbon\Carbon::parse($endDate)->subYear()->format('Y') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y-0">
                <!-- I. AKTIVITAS OPERASI -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">AKTIVITAS OPERASI</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kas dari sumbangan (ZIS &amp; Hak Amil)</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['operating_activities']['cash_from_zis'] + $report['operating_activities']['cash_from_amil'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kas dari pendapatan jasa</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Bunga yang diterima</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penerimaan lain-lain</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Bunga yang dibayarkan</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kas yang dibayarkan kepada karyawan &amp; operasional amil</td>
                    <td class="py-0.5 text-right font-mono">({{ number_format($report['operating_activities']['cash_paid_amil'], 0, ',', '.') }})</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kas yang dibayarkan untuk penyaluran mustahik (8 Asnaf)</td>
                    <td class="py-0.5 text-right font-mono">({{ number_format($report['operating_activities']['cash_paid_mustahiq'], 0, ',', '.') }})</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Kas neto dari aktivitas operasi</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['operating_activities']['net_cash'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- II. AKTIVITAS INVESTASI -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">AKTIVITAS INVESTASI</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Ganti rugi dari asuransi kebakaran</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Pembelian peralatan / inventaris UPZ</td>
                    <td class="py-0.5 text-right font-mono">({{ number_format(abs($report['investing_activities']['net_cash']), 0, ',', '.') }})</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penerimaan dari penjualan investasi</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Pembelian investasi</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Kas neto yang digunakan untuk aktivitas investasi</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['investing_activities']['net_cash'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- III. AKTIVITAS PENDANAAN -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">AKTIVITAS PENDANAAN</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penerimaan dari sumbangan yang dibatasi untuk investasi</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penyetoran dana zakat ke kas BAZNAS Pusat/Daerah</td>
                    <td class="py-0.5 text-right font-mono">({{ number_format(abs($report['financing_activities']['net_cash']), 0, ',', '.') }})</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Kas neto yang digunakan untuk aktivitas pendanaan</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['financing_activities']['net_cash'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- KENAIKAN (PENURUNAN) NETO KAS -->
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1.5 uppercase">KENAIKAN (PENURUNAN) NETO KAS DAN SETARA KAS</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['net_cash_change'], 0, ',', '.') }}</td>
                    <td class="py-1.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-1 font-bold uppercase">KAS DAN SETARA KAS PADA AWAL PERIODE</td>
                    <td class="py-1 text-right font-mono font-bold">{{ number_format($report['beginning_cash'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold text-base border-t border-black border-b-4 border-double border-black">
                    <td class="py-1.5 uppercase">KAS DAN SETARA KAS PADA AKHIR PERIODE</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['ending_cash'], 0, ',', '.') }}</td>
                    <td class="py-1.5 text-right font-mono">0</td>
                </tr>
            </tbody>
        </table>

        <!-- Official Signatures (Clean, no text obstructing signature area) -->
        <div class="grid grid-cols-2 gap-12 mt-12 pt-6 text-xs text-center border-t border-slate-400">
            <div>
                <div>Mengetahui,</div>
                <div class="font-bold uppercase mt-0.5">Ketua Pengurus UPZ</div>
                <div class="h-24"></div> <!-- Clean open signature space -->
                <div class="font-bold underline">{{ $upz->chairman_name ?? '............................................' }}</div>
                <div>NIP/ID: {{ $upz->sk_number ?? '....................................' }}</div>
            </div>
            <div>
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y') }}</div>
                <div class="font-bold uppercase mt-0.5">Bagian Keuangan / Akuntan</div>
                <div class="h-24"></div> <!-- Clean open signature space -->
                <div class="font-bold underline">{{ $upz->treasurer_name ?? '............................................' }}</div>
                <div>Akuntan UPZ BAZNAS</div>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    body {
        background: #ffffff !important;
        color: #000000 !important;
        font-family: 'Times New Roman', Times, Georgia, serif !important;
    }
    .no-print, aside, header, nav {
        display: none !important;
    }
    .report-sheet {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
    }
}
</style>
@endsection

