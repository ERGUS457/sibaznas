@extends('layouts.app')

@section('title', 'Lampiran II - Penyaluran Berdasarkan Asnaf (Perbaznas No. 2/2016)')

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
            <h1 class="text-base font-bold text-slate-900 mt-1">Lampiran II: Rencana Pendistribusian Berdasarkan Asnaf</h1>
            <p class="text-xs text-slate-500">Peraturan Badan Amil Zakat Nasional No. 2 Tahun 2016 (Halaman 34).</p>
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

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 34) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Official Regulation Header (Top Left) -->
        <div class="text-left text-xs uppercase font-bold tracking-wider leading-snug mb-6 border-b border-black pb-3">
            <div>LAMPIRAN II</div>
            <div>PERATURAN BADAN AMIL ZAKAT NASIONAL</div>
            <div>NOMOR 2 TAHUN 2016</div>
            <div>TENTANG</div>
            <div>PEMBENTUKAN DAN TATA KERJA UNIT PENGUMPUL ZAKAT</div>
        </div>

        <!-- Center Entity Header -->
        <div class="text-center font-bold text-sm tracking-wide uppercase mb-6 space-y-0.5">
            <div>{{ $upz->parent_baznas_name ?? 'BAZNAS / BAZNAS PROVINSI / BAZNAS KABUPATEN/KOTA' }}</div>
            <div>UNIT PENGUMPUL ZAKAT {{ $upz->name ?? '...' }}</div>
            <div class="text-base font-extrabold mt-2 underline">RENCANA PENDISTRIBUSIAN DAN PENDAYAGUNAAN BERDASARKAN ASNAF</div>
            <div class="text-xs font-normal normal-case mt-1">Periode 1 Januari s/d 31 Desember Tahun {{ $year }}</div>
        </div>

        <!-- Official Table as in Page 34 -->
        <table class="w-full border-collapse border border-black text-black">
            <thead>
                <tr class="bg-gray-100 font-bold text-center border-b border-black">
                    <th class="border border-black p-2 w-16">No</th>
                    <th class="border border-black p-2 text-left">Keterangan</th>
                    <th class="border border-black p-2 w-48 text-right">Jumlah<br>(rupiah)</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1.4. Penyaluran dana zakat -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.4.</td>
                    <td class="border border-black p-2">Penyaluran dana zakat</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalZakat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.4.</td>
                    <td class="border border-black p-2 pl-6">Fakir</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fakir']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.5.</td>
                    <td class="border border-black p-2 pl-6">Miskin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['miskin']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.6.</td>
                    <td class="border border-black p-2 pl-6">Amil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['amil']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.7.</td>
                    <td class="border border-black p-2 pl-6">Mualaf</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['mualaf']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.8.</td>
                    <td class="border border-black p-2 pl-6">Riqab</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['riqab']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.9.</td>
                    <td class="border border-black p-2 pl-6">Gharimin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['gharimin']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.10.</td>
                    <td class="border border-black p-2 pl-6">Fii sabilillah</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fisabilillah']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.1.11.</td>
                    <td class="border border-black p-2 pl-6">Ibnu sabil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['ibnu_sabil']['zakat'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- 1.5. Penyaluran dana infak/sedekah -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.5.</td>
                    <td class="border border-black p-2">Penyaluran dana infak/sedekah</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalInfak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.2.</td>
                    <td class="border border-black p-2 pl-6">Fakir</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fakir']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.3.</td>
                    <td class="border border-black p-2 pl-6">Miskin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['miskin']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.4.</td>
                    <td class="border border-black p-2 pl-6">Amil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['amil']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.5.</td>
                    <td class="border border-black p-2 pl-6">Mualaf</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['mualaf']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.6.</td>
                    <td class="border border-black p-2 pl-6">Riqab</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['riqab']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.7.</td>
                    <td class="border border-black p-2 pl-6">Gharimin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['gharimin']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.8.</td>
                    <td class="border border-black p-2 pl-6">Fii sabilillah</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fisabilillah']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.2.9.</td>
                    <td class="border border-black p-2 pl-6">Ibnu sabil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['ibnu_sabil']['infak'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- 1.6. Penyaluran dana sosial keagamaan lainnya (DSKL) -->
                <tr class="font-bold">
                    <td class="border border-black p-2 text-center align-top">1.6.</td>
                    <td class="border border-black p-2">
                        Penyaluran dana sosial keagamaan lainnya (DSKL)<br>
                        <span class="text-xs italic font-normal">(hibah, nazar, pusaka yang tidak memiliki ahli waris, qurban, kafarat, fidyah, denda atau sitaan pengadilan agama, dan lain sebagainya)</span>
                    </td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($totalDskl, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.2.</td>
                    <td class="border border-black p-2 pl-6">Fakir</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fakir']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.3.</td>
                    <td class="border border-black p-2 pl-6">Miskin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['miskin']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.4.</td>
                    <td class="border border-black p-2 pl-6">Amil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['amil']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.5.</td>
                    <td class="border border-black p-2 pl-6">Mualaf</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['mualaf']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.6.</td>
                    <td class="border border-black p-2 pl-6">Riqab</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['riqab']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.7.</td>
                    <td class="border border-black p-2 pl-6">Gharimin</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['gharimin']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.8.</td>
                    <td class="border border-black p-2 pl-6">Fii sabilillah</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['fisabilillah']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center align-top text-xs">1.3.9.</td>
                    <td class="border border-black p-2 pl-6">Ibnu sabil</td>
                    <td class="border border-black p-2 text-right font-mono">{{ number_format($distData['ibnu_sabil']['dskl'] ?? 0, 0, ',', '.') }}</td>
                </tr>

                <!-- TOTAL PENYALURAN -->
                <tr class="font-bold bg-gray-50 border-t-2 border-black">
                    <td colspan="2" class="border border-black p-2 text-center uppercase tracking-wider">TOTAL PENYALURAN</td>
                    <td class="border border-black p-2 text-right font-mono text-sm font-extrabold">{{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section (Clean, no obstruction) -->
        <div class="mt-12 flex justify-end text-xs font-serif text-black">
            <div class="text-center w-72">
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ now()->isoFormat('D MMMM Y') }}</div>
                <div class="font-bold mt-1 uppercase">Pengurus UPZ {{ $upz->name ?? 'BAZNAS' }}</div>
                <div class="h-24"></div> <!-- Clean signature space -->
                <div class="font-bold underline">{{ $upz->chairman_name ?? '............................................' }}</div>
                <div>Ketua UPZ</div>
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
