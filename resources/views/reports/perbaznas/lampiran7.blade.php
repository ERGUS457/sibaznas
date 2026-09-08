@extends('layouts.app')

@section('title', 'Lampiran VII - Laporan Pendistribusian dan Pendayagunaan Dana (Perbaznas No. 2/2016)')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 print:max-w-none print:space-y-0 print:m-0 print:p-0">
    <!-- Action Bar (Strictly Hidden on Print) -->
    <div class="no-print print:hidden flex items-center justify-between bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('reports.perbaznas-compliance') }}" class="text-slate-500 hover:text-black font-semibold text-xs flex items-center gap-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu Perbaznas
                </a>
            </div>
            <h1 class="text-base font-bold text-slate-900 mt-1">Lampiran VII: Laporan Pendistribusian & Pendayagunaan Dana</h1>
            <p class="text-xs text-slate-500">Peraturan Badan Amil Zakat Nasional No. 2 Tahun 2016 (Halaman 39).</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2 text-xs">
                <label for="month" class="font-medium text-slate-600">Bulan:</label>
                <select id="month" name="month" class="border border-slate-300 rounded px-2 py-1 focus:ring-1 focus:ring-black">
                    <option value="">Semua Bulan</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create(null, $m, 1)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>

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

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 39) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[12px] leading-relaxed print:p-0 print:border-none print:shadow-none">
        
        <!-- Official Regulation Header (Top Left, no underline as in PDF) -->
        <div class="text-left text-xs uppercase font-bold tracking-wider leading-snug mb-5">
            <div>LAMPIRAN VII</div>
            <div>PERATURAN BADAN AMIL ZAKAT NASIONAL</div>
            <div>NOMOR 2 TAHUN 2016</div>
            <div>TENTANG</div>
            <div>PEMBENTUKAN DAN TATA KERJA UNIT PENGUMPUL ZAKAT</div>
        </div>

        <!-- Center Entity Header (no underline as in PDF) -->
        <div class="text-center font-bold text-sm tracking-wide uppercase mb-6 space-y-0.5">
            <div>{{ $upz->parent_baznas_name ?? 'BAZNAS / BAZNAS PROVINSI / BAZNAS KABUPATEN/KOTA' }}</div>
            <div>UNIT PENGUMPUL ZAKAT {{ $upz->name ?? '...' }}</div>
            <div class="text-base font-extrabold mt-1">LAPORAN PENDISTRIBUSIAN DAN PENDAYAGUNAAN DANA</div>
            <div class="text-xs font-normal normal-case mt-1">
                @if($month)
                    Bulan {{ \Carbon\Carbon::create(null, (int)$month, 1)->translatedFormat('F') }} Tahun {{ $year }}
                @else
                    Tahun {{ $year }}
                @endif
            </div>
        </div>

        <!-- Official Table as in Page 39 -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-black text-black">
                <thead>
                    <tr class="bg-gray-100 font-bold text-center border-b border-black text-[11px]">
                        <th class="border border-black p-2 w-10">No</th>
                        <th class="border border-black p-2 w-32">Nomor Bukti<br>Penyaluran</th>
                        <th class="border border-black p-2 w-24">Tanggal<br>Transaksi</th>
                        <th class="border border-black p-2 w-28">No. KTP /<br>ID Lain</th>
                        <th class="border border-black p-2 text-left">Nama Mustahik</th>
                        <th class="border border-black p-2 text-left">Alamat</th>
                        <th class="border border-black p-2 w-24">Asnaf</th>
                        <th class="border border-black p-2 w-28">Kategori Program</th>
                        <th class="border border-black p-2 w-32 text-right">Jumlah Dana<br>(Rupiah)</th>
                </thead>
                <tbody>
                    @forelse($distributions as $index => $dist)
                        <tr>
                            <td class="border border-black p-2 text-center align-top">{{ $index + 1 }}</td>
                            <td class="border border-black p-2 font-mono text-center align-top text-xs">{{ $dist->distribution_number ?? '-' }}</td>
                            <td class="border border-black p-2 text-center align-top whitespace-nowrap">{{ \Carbon\Carbon::parse($dist->distribution_date)->format('d/m/Y') }}</td>
                            <td class="border border-black p-2 font-mono text-center align-top text-xs">{{ $dist->mustahiq->nik ?? '-' }}</td>
                            <td class="border border-black p-2 align-top font-medium">{{ $dist->mustahiq->name ?? ($dist->recipient_name ?? '-') }}</td>
                            <td class="border border-black p-2 align-top text-xs">{{ $dist->mustahiq->address ?? ($dist->recipient_address ?? '-') }}</td>
                            <td class="border border-black p-2 text-center align-top uppercase text-xs">{{ str_replace('_', ' ', $dist->asnaf_category) }}</td>
                            <td class="border border-black p-2 text-center align-top capitalize text-xs">{{ $dist->program_name ?? '-' }}</td>
                            <td class="border border-black p-2 text-right font-mono align-top">{{ number_format($dist->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="border border-black p-6 text-center italic text-gray-500">
                                Tidak ada data transaksi pendistribusian untuk periode ini.
                            </td>
                        </tr>
                    @endforelse

                    <!-- TOTAL PENYALURAN -->
                    <tr class="font-bold bg-gray-50 border-t-2 border-black">
                        <td colspan="8" class="border border-black p-2 text-center uppercase tracking-wider">TOTAL JUMLAH PENYALURAN DANA</td>
                        <td class="border border-black p-2 text-right font-mono text-sm font-extrabold">{{ number_format($totalDana, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 3-Column Official Verification Section (Sesuai Hal. 39 PDF) -->
        <div class="signature-block mt-8 pt-4">
            <div class="grid grid-cols-3 gap-6 text-center text-xs font-serif text-black">
                <!-- Kolom 1: Dibuat Oleh -->
                <div class="border border-black p-4 flex flex-col justify-between">
                    <div>
                        <div class="font-bold uppercase tracking-wider mb-1">DIBUAT OLEH</div>
                        <div class="text-xs text-gray-600">Pelaksana / Staf Pendistribusian UPZ</div>
                    </div>
                    <div>
                        <div class="text-left text-[11px] mb-1">Tanggal: ..............................</div>
                        <div class="h-16"></div> <!-- Clean signature space -->
                        <div class="border-t border-black pt-1 font-bold">
                            ................................................
                        </div>
                        <div class="text-[11px]">Staf Administrasi UPZ</div>
                    </div>
                </div>

                <!-- Kolom 2: Diperiksa Oleh -->
                <div class="border border-black p-4 flex flex-col justify-between">
                    <div>
                        <div class="font-bold uppercase tracking-wider mb-1">DIPERIKSA OLEH</div>
                        <div class="text-xs text-gray-600">Sekretaris / Bendahara UPZ</div>
                    </div>
                    <div>
                        <div class="text-left text-[11px] mb-1">Tanggal: ..............................</div>
                        <div class="h-16"></div> <!-- Clean signature space -->
                        <div class="border-t border-black pt-1 font-bold">
                            {{ $upz->treasurer_name ?? '................................................' }}
                        </div>
                        <div class="text-[11px]">Bendahara UPZ</div>
                    </div>
                </div>

                <!-- Kolom 3: Disahkan Oleh -->
                <div class="border border-black p-4 flex flex-col justify-between">
                    <div>
                        <div class="font-bold uppercase tracking-wider mb-1">DISAHKAN OLEH</div>
                        <div class="text-xs text-gray-600">Ketua UPZ</div>
                    </div>
                    <div>
                        <div class="text-left text-[11px] mb-1">Tanggal: ..............................</div>
                        <div class="h-16"></div> <!-- Clean signature space -->
                        <div class="border-t border-black pt-1 font-bold underline">
                            {{ $upz->chairman_name ?? '................................................' }}
                        </div>
                        <div class="text-[11px]">Ketua UPZ</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
@media print {
    @page {
        size: A4 landscape;
        margin: 8mm 10mm 8mm 10mm;
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
        line-height: 1.2 !important;
    }
    table {
        font-size: 9pt !important;
    }
    td, th {
        padding: 2px 4px !important;
    }
    .signature-block {
        page-break-inside: avoid !important;
        margin-top: 16px !important;
    }
}
</style>
@endsection
