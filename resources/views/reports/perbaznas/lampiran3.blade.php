@extends('layouts.app')

@section('title', 'Lampiran III - Rencana Pendistribusian Berdasarkan Program (Perbaznas No. 2/2016)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar (Hidden on Print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('reports.perbaznas-compliance') }}" class="text-slate-500 hover:text-black font-semibold text-xs flex items-center gap-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu Perbaznas
                </a>
            </div>
            <h1 class="text-base font-bold text-slate-900 mt-1">Lampiran III: Rencana Pendistribusian & Pendayagunaan Berdasarkan Program</h1>
            <p class="text-xs text-slate-500">Peraturan Badan Amil Zakat Nasional No. 2 Tahun 2016 (Halaman 35).</p>
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

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 35) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Official Regulation Header (Top Left) -->
        <div class="text-left text-xs uppercase font-bold tracking-wider leading-snug mb-6 border-b border-black pb-3">
            <div>LAMPIRAN III</div>
            <div>PERATURAN BADAN AMIL ZAKAT NASIONAL</div>
            <div>NOMOR 2 TAHUN 2016</div>
            <div>TENTANG</div>
            <div>PEMBENTUKAN DAN TATA KERJA UNIT PENGUMPUL ZAKAT</div>
        </div>

        <!-- Center Entity Header -->
        <div class="text-center font-bold text-sm tracking-wide uppercase mb-6 space-y-0.5">
            <div>{{ $upz->parent_baznas_name ?? 'BAZNAS / BAZNAS PROVINSI / BAZNAS KABUPATEN/KOTA' }}</div>
            <div>UNIT PENGUMPUL ZAKAT {{ $upz->name ?? '...' }}</div>
            <div class="text-base font-extrabold mt-2 underline">RENCANA PENDISTRIBUSIAN DAN PENDAYAGUNAAN BERDASARKAN PROGRAM</div>
            <div class="text-xs font-normal normal-case mt-1">Periode 1 Januari s/d 31 Desember Tahun {{ $year }}</div>
        </div>

        <!-- Official Table as in Page 35 -->
        <table class="w-full border-collapse border border-black text-black">
            <thead>
                <tr class="bg-gray-100 font-bold text-center border-b border-black">
                    <th class="border border-black p-2 w-16">No</th>
                    <th class="border border-black p-2 text-left">Keterangan</th>
                    <th class="border border-black p-2 w-48 text-right">Jumlah<br>(Rupiah)</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1.7. Penyaluran dana zakat -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.7.</td>
                    <td class="border border-black p-2">Penyaluran dana zakat</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalZakat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.12.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana zakat bidang pendidikan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['pendidikan']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.13.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana zakat bidang kesehatan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kesehatan']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.14.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana zakat bidang kemanusiaan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kemanusiaan']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.15.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana zakat bidang ekonomi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['ekonomi']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.16.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana zakat bidang dakwah-advokasi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['dakwah_advokasi']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- 1.8. Penyaluran dana infak/sedekah -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.8.</td>
                    <td class="border border-black p-2">Penyaluran dana infak/sedekah</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalInfak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.10.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana infak/sedekah bidang pendidikan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['pendidikan']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.11.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana infak/sedekah bidang kesehatan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kesehatan']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.12.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana infak/sedekah bidang kemanusiaan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kemanusiaan']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.13.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana infak/sedekah bidang ekonomi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['ekonomi']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.14.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran dana infak/sedekah bidang dakwah-advokasi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['dakwah_advokasi']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- 1.9. Penyaluran dana sosial keagamaan lainnya -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.9.</td>
                    <td class="border border-black p-2">Penyaluran dana sosial keagamaan lainnya</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalDskl, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.10.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran DSKL bidang pendidikan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['pendidikan']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.11.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran DSKL bidang kesehatan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kesehatan']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.12.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran DSKL bidang kemanusiaan</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['kemanusiaan']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.13.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran DSKL bidang ekonomi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['ekonomi']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.14.</td>
                    <td class="border border-black p-2 pl-6">Penyaluran DSKL bidang dakwah-advokasi</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($progData['dakwah_advokasi']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- TOTAL PENYALURAN -->
                <tr class="font-bold bg-gray-50 border-t-2 border-black">
                    <td colspan="2" class="border border-black p-2 text-center uppercase tracking-wider">TOTAL PENYALURAN</td>
                    <td class="border border-black p-2 text-right font-mono text-sm font-extrabold">{{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section (Clean, no obstruction) -->
        <div class="signature-block mt-10 flex justify-end text-xs font-serif text-black">
            <div class="text-center w-72">
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ now()->isoFormat('D MMMM Y') }}</div>
                <div class="font-bold mt-1 uppercase">Pengurus UPZ {{ $upz->name ?? 'BAZNAS' }}</div>
                <div class="h-16"></div> <!-- Clean signature space -->
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
        margin: 10mm 12mm 12mm 12mm;
    }
    .signature-block {
        page-break-inside: avoid !important;
    }
}
</style>
@endsection
