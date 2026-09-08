@extends('layouts.app')

@section('title', 'Laporan Posisi Keuangan (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar (Hidden on Print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <h1 class="text-base font-bold text-slate-900">Laporan Posisi Keuangan (DE ISAK 35 Format A)</h1>
            <p class="text-xs text-slate-500">Format resmi entitas berorientasi nonlaba sesuai lampiran Draf Eksposur ISAK 35 (Hal. 21).</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2 text-xs">
                <label for="as_of_date" class="font-medium text-slate-600">Per Tanggal:</label>
                <input type="date" id="as_of_date" name="as_of_date" value="{{ $asOfDate }}" class="border border-slate-300 rounded px-2 py-1 focus:ring-1 focus:ring-black">
                <button type="submit" class="bg-slate-800 hover:bg-black text-white px-3 py-1 rounded font-medium">Tampilkan</button>
            </form>
            <button onclick="window.print()" class="bg-black hover:bg-slate-800 text-white font-medium text-xs px-3 py-1.5 rounded shadow flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Lembar Laporan</span>
            </button>
        </div>
    </div>

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 21) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Black Box Header as in DE ISAK 35 Page 21 -->
        <div class="bg-black text-white text-center py-3 px-4 mb-6">
            <div class="font-bold text-base tracking-wider uppercase">{{ $upz->name ?? 'ENTITAS XYZ' }}</div>
            <div class="font-semibold text-sm tracking-wide mt-0.5 uppercase">LAPORAN POSISI KEUANGAN</div>
            <div class="text-xs">per {{ \Carbon\Carbon::parse($asOfDate)->isoFormat('D MMMM Y') }}</div>
            <div class="text-xs italic font-normal">(dalam rupiah)</div>
        </div>

        <!-- Table Grid -->
        <table class="w-full border-collapse text-black">
            <thead>
                <tr class="font-bold text-right border-b border-black">
                    <th class="text-left py-1 font-bold"></th>
                    <th class="py-1 w-36 text-right">{{ \Carbon\Carbon::parse($asOfDate)->format('Y') }}</th>
                    <th class="py-1 w-36 text-right">{{ \Carbon\Carbon::parse($asOfDate)->subYear()->format('Y') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y-0">
                <!-- ASET -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">ASET</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-1 pb-1 font-bold pl-4">Aset Lancar</td>
                </tr>
                @php
                    $kasAccount = null;
                    $piutangAccount = null;
                    $otherCurrentAccounts = [];
                    foreach ($report['current_assets'] as $ca) {
                        if (str_contains(strtolower($ca['account']->name), 'kas') || str_contains(strtolower($ca['account']->name), 'bank')) {
                            $kasAccount = ($kasAccount ?? 0) + $ca['balance'];
                        } elseif (str_contains(strtolower($ca['account']->name), 'piutang')) {
                            $piutangAccount = ($piutangAccount ?? 0) + $ca['balance'];
                        } else {
                            $otherCurrentAccounts[] = $ca;
                        }
                    }
                @endphp
                <tr>
                    <td class="py-0.5 pl-8">Kas dan setara kas</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($kasAccount ?? 0, 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Piutang bunga</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($piutangAccount ?? 0, 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Investasi jangka pendek</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @foreach($otherCurrentAccounts as $oca)
                <tr>
                    <td class="py-0.5 pl-8">{{ $oca['account']->name }}</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($oca['balance'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @endforeach
                <tr>
                    <td class="py-0.5 pl-8">Aset lancar lain</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Aset Lancar</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_current_assets'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- Aset Tidak Lancar -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold pl-4">Aset Tidak Lancar</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Properti investasi</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Investasi jangka panjang</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @forelse($report['non_current_assets'] as $nca)
                <tr>
                    <td class="py-0.5 pl-8">{{ $nca['account']->name }}</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($nca['balance'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @empty
                <tr>
                    <td class="py-0.5 pl-8">Aset tetap</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_non_current_assets'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @endforelse
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Aset Tidak Lancar</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_non_current_assets'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- TOTAL ASET -->
                <tr class="font-bold text-base border-t border-black border-b-4 border-double border-black">
                    <td class="py-1.5 uppercase">TOTAL ASET</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['total_assets'], 0, ',', '.') }}</td>
                    <td class="py-1.5 text-right font-mono">0</td>
                </tr>

                <!-- LIABILITAS -->
                <tr>
                    <td colspan="3" class="pt-4 pb-1 font-bold tracking-wide">LIABILITAS</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-1 pb-1 font-bold pl-4">Liabilitas Jangka Pendek</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Pendapatan diterima di muka</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @forelse($report['current_liabilities'] as $cl)
                <tr>
                    <td class="py-0.5 pl-8">{{ $cl['account']->name }}</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($cl['balance'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @empty
                <tr>
                    <td class="py-0.5 pl-8">Utang jangka pendek</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_current_liabilities'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @endforelse
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Liabilitas Jangka Pendek</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_current_liabilities'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <tr>
                    <td colspan="3" class="pt-2 pb-1 font-bold pl-4">Liabilitas Jangka Panjang</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Utang jangka panjang</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Liabilitas imbalan kerja</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Liabilitas Jangka Panjang</td>
                    <td class="py-1 text-right font-mono">0</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1">Total Liabilitas</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_liabilities'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- ASET NETO -->
                <tr>
                    <td colspan="3" class="pt-4 pb-1 font-bold tracking-wide">ASET NETO</td>
                </tr>
                <tr>
                    <td colspan="3" class="py-0.5 pl-4 font-bold">Tanpa Pembatasan dari Pemberi Sumber Daya (without restrictions)</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Surplus akumulasian</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_unrestricted_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penghasilan komprehensif lain*)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-4 font-bold">Dengan Pembatasan dari Pemberi Sumber Daya (with restrictions - catatan B)</td>
                    <td class="py-0.5 text-right font-mono font-bold">{{ number_format($report['total_restricted_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Aset Neto</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- TOTAL LIABILITAS DAN ASET NETO -->
                <tr class="font-bold text-base border-t border-black border-b-4 border-double border-black">
                    <td class="py-1.5 uppercase">TOTAL LIABILITAS DAN ASET NETO</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['total_liabilities_and_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-1.5 text-right font-mono">0</td>
                </tr>
            </tbody>
        </table>

        <!-- Footnote as in DE ISAK 35 Page 21 -->
        <div class="mt-6 text-[11px] text-black space-y-1">
            <p>*) Entitas menyajikan informasi penghasilan komprehensif lain tersebut sesuai dengan kelas aset netonya (misalnya, jika penghasilan komprehensif lain berasal dari aset neto dengan pembatasan, maka disajikan dalam kelas aset neto dengan pembatasan).</p>
            <p class="font-bold">(A) Lihat Laporan Perubahan Aset Neto.</p>
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
                <div>{{ $upz->city ?? 'Jakarta' }}, {{ \Carbon\Carbon::parse($asOfDate)->isoFormat('D MMMM Y') }}</div>
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
