@extends('layouts.app')

@section('title', 'Laporan Penghasilan Komprehensif (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar (Hidden on Print) -->
    <div class="flex items-center justify-between no-print bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
        <div>
            <h1 class="text-base font-bold text-slate-900">Laporan Penghasilan Komprehensif (DE ISAK 35 Format A)</h1>
            <p class="text-xs text-slate-500">Format resmi entitas berorientasi nonlaba sesuai lampiran Draf Eksposur ISAK 35 (Hal. 24).</p>
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

    <!-- PURE OFFICIAL STATEMENT SHEET (100% Monokrom Sesuai PDF Hal. 24) -->
    <div class="report-sheet bg-white p-8 sm:p-12 border border-slate-300 shadow-sm text-black font-serif text-[13px] leading-relaxed">
        
        <!-- Black Box Header as in DE ISAK 35 Page 24 -->
        <div class="bg-black text-white text-center py-3 px-4 mb-6">
            <div class="font-bold text-base tracking-wider uppercase">{{ $upz->name ?? 'ENTITAS XYZ' }}</div>
            <div class="font-semibold text-sm tracking-wide mt-0.5 uppercase">LAPORAN PENGHASILAN KOMPREHENSIF</div>
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
                <!-- I. TANPA PEMBATASAN DARI PEMBERI SUMBER DAYA -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold tracking-wide">TANPA PEMBATASAN DARI PEMBERI SUMBER DAYA</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-1 pb-1 font-bold pl-4">Pendapatan</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Sumbangan (Hak Amil Pengelolaan ZIS)</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_unrestricted_revenue'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Jasa layanan</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penghasilan investasi jangka pendek (catatan D)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penghasilan investasi jangka panjang (catatan D)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Lain-lain</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Pendapatan</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_unrestricted_revenue'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- Beban Tanpa Pembatasan -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold pl-4">Beban</td>
                </tr>
                @php
                    $gaji = 0; $admin = 0; $depr = 0; $otherExp = [];
                    foreach ($report['unrestricted_expenses'] as $ue) {
                        $name = strtolower($ue['account']->name);
                        if (str_contains($name, 'gaji') || str_contains($name, 'upah') || str_contains($name, 'pegawai')) {
                            $gaji += $ue['balance'];
                        } elseif (str_contains($name, 'administrasi') || str_contains($name, 'umum') || str_contains($name, 'operasional')) {
                            $admin += $ue['balance'];
                        } elseif (str_contains($name, 'penyusutan') || str_contains($name, 'depresiasi')) {
                            $depr += $ue['balance'];
                        } else {
                            $otherExp[] = $ue;
                        }
                    }
                @endphp
                <tr>
                    <td class="py-0.5 pl-8">Gaji, upah</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($gaji, 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Jasa dan profesional</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Administratif</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($admin, 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Depresiasi</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($depr, 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Bunga</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @foreach($otherExp as $oe)
                <tr>
                    <td class="py-0.5 pl-8">{{ $oe['account']->name }}</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($oe['balance'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                @endforeach
                <tr>
                    <td class="py-0.5 pl-8">Lain-lain</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Beban (catatan E)</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_unrestricted_expense'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kerugian akibat kebakaran</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Beban</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_unrestricted_expense'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Surplus (Defisit)</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['change_unrestricted_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- II. DENGAN PEMBATASAN DARI PEMBERI SUMBER DAYA -->
                <tr>
                    <td colspan="3" class="pt-4 pb-1 font-bold tracking-wide">DENGAN PEMBATASAN DARI PEMBERI SUMBER DAYA</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-1 pb-1 font-bold pl-4">Pendapatan</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Sumbangan (Penerimaan Dana ZIS &amp; DSKL)</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_restricted_revenue'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penghasilan investasi jangka panjang (catatan D)</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Total Pendapatan</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['total_restricted_revenue'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- Beban Dengan Pembatasan -->
                <tr>
                    <td colspan="3" class="pt-3 pb-1 font-bold pl-4">Beban</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Penyaluran Program &amp; Hak Mustahik 8 Asnaf</td>
                    <td class="py-0.5 text-right font-mono">{{ number_format($report['total_program_expense'], 0, ',', '.') }}</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr>
                    <td class="py-0.5 pl-8">Kerugian akibat kebakaran</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                    <td class="py-0.5 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold border-t border-b border-black">
                    <td class="py-1 pl-4">Surplus (Defisit)</td>
                    <td class="py-1 text-right font-mono">{{ number_format($report['change_restricted_net_assets'], 0, ',', '.') }}</td>
                    <td class="py-1 text-right font-mono">0</td>
                </tr>

                <!-- III. PENGHASILAN KOMPREHENSIF LAIN & TOTAL -->
                <tr>
                    <td class="pt-3 pb-1 font-bold">PENGHASILAN KOMPREHENSIF LAIN</td>
                    <td class="pt-3 pb-1 text-right font-mono">0</td>
                    <td class="pt-3 pb-1 text-right font-mono">0</td>
                </tr>
                <tr class="font-bold text-base border-t border-black border-b-4 border-double border-black">
                    <td class="py-1.5 uppercase">TOTAL PENGHASILAN KOMPREHENSIF</td>
                    <td class="py-1.5 text-right font-mono">{{ number_format($report['total_change_in_net_assets'], 0, ',', '.') }}</td>
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

