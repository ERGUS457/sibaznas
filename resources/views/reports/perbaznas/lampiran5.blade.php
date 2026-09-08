@extends('layouts.app')

@section('title', 'Lampiran V - Rencana Penerimaan dan Penggunaan Dana Operasional (Perbaznas No. 2/2016)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 print:max-w-none print:space-y-0 print:m-0 print:p-0">
    <!-- Action Bar (Strictly Hidden on Print) -->
    <div class="no-print print:hidden flex items-center justify-between bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('reports.perbaznas-compliance') }}" class="text-slate-500 hover:text-black font-semibold text-xs flex items-center gap-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu Perbaznas
                </a>
            </div>
            <h1 class="text-base font-bold text-slate-900 mt-1">Lampiran V: Rencana Penerimaan & Penggunaan Dana Operasional</h1>
            <p class="text-xs text-slate-500">Peraturan Badan Amil Zakat Nasional No. 2 Tahun 2016 (Halaman 37) - Alokasi Hak Amil Maks. 12,5%.</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2 text-xs">
                <label for="year" class="font-medium text-slate-600">Tahun:</label>
                <input type="number" id="year" name="year" value="{{ $year }}" min="2020" max="2035" class="w-20 border border-slate-300 rounded px-2 py-1 focus:ring-1 focus:ring-black">
                <button type="submit" class="bg-slate-800 hover:bg-black text-white px-3 py-1 rounded font-medium">Tampilkan</button>
            </form>
            <button onclick="window.print()" class="bg-black hover:bg-slate-800 text-white font-medium text-xs px-3 py-1.5 rounded shadow flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Lembar Laporan</span>
            </button>
        </div>
    </div>

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 37) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed print:p-0 print:border-none print:shadow-none">
        
        <!-- Official Regulation Header (Top Left, no underline as in PDF) -->
        <div class="text-left text-xs uppercase font-bold tracking-wider leading-snug mb-5">
            <div>LAMPIRAN V</div>
            <div>PERATURAN BADAN AMIL ZAKAT NASIONAL</div>
            <div>NOMOR 2 TAHUN 2016</div>
            <div>TENTANG</div>
            <div>PEMBENTUKAN DAN TATA KERJA UNIT PENGUMPUL ZAKAT</div>
        </div>

        <!-- Center Entity Header (no underline as in PDF) -->
        <div class="text-center font-bold text-sm tracking-wide uppercase mb-6 space-y-0.5">
            <div>{{ $upz->parent_baznas_name ?? 'BAZNAS / BAZNAS PROVINSI / BAZNAS KABUPATEN/KOTA' }}</div>
            <div>UNIT PENGUMPUL ZAKAT {{ $upz->name ?? '...' }}</div>
            <div class="text-base font-extrabold mt-1">RENCANA PENERIMAAN DAN PENGGUNAAN DANA OPERASIONAL</div>
            <div class="text-xs font-normal normal-case">Periode 1 Januari s/d 31 Desember Tahun {{ $year }}</div>
        </div>

        <!-- Official Table as in Page 37 (Two-level Header with % and Rupiah under Jumlah) -->
        <table class="w-full border-collapse border border-black text-black">
            <thead>
                <tr class="bg-gray-100 font-bold text-center border-b border-black text-[11px]">
                    <th rowspan="2" class="border border-black p-1.5 w-14 align-middle">No</th>
                    <th rowspan="2" class="border border-black p-1.5 text-center align-middle">Keterangan</th>
                    <th colspan="2" class="border border-black p-1.5 text-center">Jumlah</th>
                </tr>
                <tr class="bg-gray-100 font-bold text-center border-b border-black text-[11px]">
                    <th class="border border-black p-1 w-16 text-center">%</th>
                    <th class="border border-black p-1 w-44 text-center">Rupiah</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1.12. Penerimaan dana operasional -->
                <tr class="font-bold">
                    <td class="border border-black p-1.5 text-center align-top">1.12.</td>
                    <td class="border border-black p-1.5">Penerimaan dana operasional</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono"></td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.1.18.</td>
                    <td class="border border-black p-1.5 pl-6">Penerimaan dana operasional dari alokasi penyaluran BAZNAS/BAZNAS Provinsi/BAZNAS Kabupaten/Kota melalui UPZ (maksimal. 12,5%)</td>
                    <td class="border border-black p-1 text-center text-xs">12,5%</td>
                    <td class="border border-black p-1 text-right font-mono">{{ number_format($amilFromZakat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.1.19.</td>
                    <td class="border border-black p-1.5 pl-6">Bantuan dari institusi yang bersangkutan</td>
                    <td class="border border-black p-1 text-center text-xs">-</td>
                    <td class="border border-black p-1 text-right font-mono">{{ number_format($institutionalGrant, 0, ',', '.') }}</td>
                </tr>
                <tr class="font-bold">
                    <td class="border border-black p-1.5"></td>
                    <td class="border border-black p-1.5 uppercase font-bold">TOTAL PENERIMAAN</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono font-bold">{{ number_format($totalPenerimaanOperasional, 0, ',', '.') }}</td>
                </tr>

                <!-- 2.5. Penggunaan dana operasional -->
                <tr class="font-bold">
                    <td class="border border-black p-1.5 text-center align-top">2.5.</td>
                    <td class="border border-black p-1.5">Penggunaan dana operasional</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono"></td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.15.</td>
                    <td class="border border-black p-1.5 pl-6">Belanja pegawai</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">{{ number_format($employeeExpenses, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.16.</td>
                    <td class="border border-black p-1.5 pl-6">Biaya publikasi dan dokumentasi</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.17.</td>
                    <td class="border border-black p-1.5 pl-6">Biaya perjalanan dinas</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.18.</td>
                    <td class="border border-black p-1.5 pl-6">Beban administrasi umum</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">{{ number_format($adminExpenses, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.19.</td>
                    <td class="border border-black p-1.5 pl-6">Beban penyusutan</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">{{ number_format($depreciationExpenses, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.20.</td>
                    <td class="border border-black p-1.5 pl-6">Pengadaan aset tetap</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.21.</td>
                    <td class="border border-black p-1.5 pl-6">Biaya jasa pihak ketiga</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="border border-black p-1.5 text-center align-top text-xs">1.2.22.</td>
                    <td class="border border-black p-1.5 pl-6">Penggunaan lain dana operasional</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold">
                    <td class="border border-black p-1.5"></td>
                    <td class="border border-black p-1.5 uppercase font-bold">TOTAL PENGGUNAAN</td>
                    <td class="border border-black p-1 text-center"></td>
                    <td class="border border-black p-1 text-right font-mono font-bold">{{ number_format($totalPenggunaanOperasional, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section as in Page 37 -->
        <div class="signature-block mt-8 flex justify-end text-xs font-serif text-black">
            <div class="text-center w-72">
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ now()->isoFormat('D MMMM Y') }}</div>
                <div class="font-bold mt-1 uppercase">Pengurus UPZ {{ $upz->name ?? 'BAZNAS' }}</div>
                <div class="h-16"></div>
                <div class="font-bold underline">{{ $upz->chairman_name ?? '............................................' }}</div>
                <div>Ketua UPZ</div>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 12mm 15mm 12mm 15mm;
    }
    .no-print,
    .no-print *,
    [class*="no-print"] {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        width: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        position: absolute !important;
        left: -99999px !important;
    }
    .report-sheet {
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        font-size: 10pt !important;
        line-height: 1.25 !important;
    }
    table {
        font-size: 9pt !important;
    }
    td, th {
        padding: 2px 4px !important;
    }
    .signature-block {
        page-break-inside: avoid !important;
        margin-top: 20px !important;
    }
}
</style>
@endsection
