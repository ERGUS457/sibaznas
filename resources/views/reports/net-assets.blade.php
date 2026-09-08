@extends('layouts.app')

@section('title', 'Laporan Perubahan Aset Neto (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar (Hidden on Print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <h1 class="text-base font-bold text-slate-900">Laporan Perubahan Aset Neto (DE ISAK 35)</h1>
            <p class="text-xs text-slate-500">Format resmi entitas berorientasi nonlaba sesuai lampiran Draf Eksposur ISAK 35 (Hal. 26).</p>
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

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 26) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Black Box Header as in DE ISAK 35 Page 26 -->
        <div class="bg-black text-white text-center py-3 px-4 mb-6">
            <div class="font-bold text-base tracking-wider uppercase">{{ $upz->name ?? 'ENTITAS XYZ' }}</div>
            <div class="font-semibold text-sm tracking-wide mt-0.5 uppercase">LAPORAN PERUBAHAN ASET BERSIH / NETO</div>
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
                <!-- ASET NETO TANPA PEMBATASAN -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">ASET NETO TANPA PEMBATASAN DARI PEMBERI SUMBER DAYA</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Saldo awal</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['beginning_unrestricted'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Surplus tahun berjalan</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['change_unrestricted'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Aset neto yang dibebaskan dari pembatasan (catatan C)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Saldo akhir</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['ending_unrestricted'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- Penghasilan Komprehensif Lain -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold pl-4">Penghasilan Komprehensif Lain</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Saldo awal</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penghasilan komprehensif tahun berjalan***)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Saldo akhir</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['ending_unrestricted'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- ASET NETO DENGAN PEMBATASAN -->
                <tr>
                    <td colspan="3" class="pt-4 pb-1 font-bold tracking-wide">ASET NETO DENGAN PEMBATASAN DARI PEMBERI SUMBER DAYA</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Saldo awal</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['beginning_restricted'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Surplus tahun berjalan</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['change_restricted'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Aset neto yang dibebaskan dari pembatasan (catatan C)</td>
                    <td class="py-0.5 text-right font-mono">(0)</td>
                    <td class="py-0.5 text-right font-mono">(0)</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Saldo akhir</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['ending_restricted'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- TOTAL ASET NETO -->
                <tr class="font-bold text-base border-t border-black border-b-4 border-double border-black">
                    <td class="py-1.5 uppercase">TOTAL ASET NETO</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['ending_total'], 0, ',', '.') }}</td>
                    <td class="py-1.5 text-right font-mono">0</td>
                </tr>
            </tbody>
        </table>

        <!-- Footnote as in DE ISAK 35 Page 26 -->
        <div class="mt-6 text-[11px] text-black space-y-1">
            <p>***) Entitas menyajikan informasi penghasilan komprehensif lain tersebut sesuai dengan kelas aset netonya (misalnya, jika penghasilan komprehensif lain berasal dari aset neto dengan pembatasan, maka disajikan dalam kelas aset neto dengan pembatasan).</p>
            <p class="font-bold">(A) Lihat Laporan Posisi Keuangan (Format A).</p>
        </div>

        <!-- Official Signatures (Clean, no text obstructing signature area) -->
        <div class="signature-block grid grid-cols-2 gap-12 mt-8 pt-4 text-xs text-center border-t border-black">
            <div>
                <div>Mengetahui,</div>
                <div class="font-bold uppercase mt-0.5">Ketua Pengurus UPZ</div>
                <div class="h-16"></div> <!-- Clean open signature space -->
                <div class="font-bold underline">{{ $upz->chairman_name ?? '............................................' }}</div>
                <div>NIP/ID: {{ $upz->sk_number ?? '....................................' }}</div>
            </div>
            <div>
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y') }}</div>
                <div class="font-bold uppercase mt-0.5">Bagian Keuangan / Akuntan</div>
                <div class="h-16"></div> <!-- Clean open signature space -->
                <div class="font-bold underline">{{ $upz->treasurer_name ?? '............................................' }}</div>
                <div>Akuntan UPZ BAZNAS</div>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 10mm 12mm 12mm 12mm;
    }
    .signature-block {
        page-break-inside: avoid !important;
    }
}
</style>
@endsection

