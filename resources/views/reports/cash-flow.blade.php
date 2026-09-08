@extends('layouts.app')

@section('title', 'Laporan Arus Kas (DE ISAK 35)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Laporan Arus Kas</h1>
            <p class="text-xs text-slate-500">Penyajian arus kas masuk dan keluar dari aktivitas operasi, investasi, dan penyetoran BAZNAS.</p>
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="window.print()" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak</span>
            </button>
        </div>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-6">
        <div class="text-center border-b-2 border-slate-800 pb-4">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide">{{ $upz->name }}</h2>
            <p class="text-xs text-slate-500">Unit Pengumpul Zakat Pembantu {{ $upz->parent_baznas_name }}</p>
            <h1 class="text-lg font-black text-emerald-950 uppercase tracking-wider mt-2">LAPORAN ARUS KAS</h1>
            <p class="text-xs font-semibold text-slate-700">
                Periode {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
            </p>
            <p class="text-[11px] text-slate-400 italic">(Metode Langsung, sesuai Standar DE ISAK 35)</p>
        </div>

        <div class="text-xs space-y-4">
            <!-- I. AKTIVITAS OPERASI -->
            <div>
                <div class="font-bold text-slate-900 uppercase mb-2">ARUS KAS DARI AKTIVITAS OPERASI</div>
                <table class="w-full">
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Penerimaan dari Pengumpulan Zakat, Infak &amp; DSKL</td>
                            <td class="py-1 text-right font-mono text-slate-900 w-44">
                                Rp {{ number_format($report['operating_activities']['cash_from_zis'], 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Penerimaan Alokasi Hak Amil</td>
                            <td class="py-1 text-right font-mono text-slate-900 w-44">
                                Rp {{ number_format($report['operating_activities']['cash_from_amil'], 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Pembayaran Penyaluran kepada Mustahiq (8 Asnaf)</td>
                            <td class="py-1 text-right font-mono text-rose-800 w-44">
                                (Rp {{ number_format($report['operating_activities']['cash_paid_mustahiq'], 2, ',', '.') }})
                            </td>
                        </tr>
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Pembayaran Beban Operasional Amil UPZ</td>
                            <td class="py-1 text-right font-mono text-rose-800 w-44">
                                (Rp {{ number_format($report['operating_activities']['cash_paid_amil'], 2, ',', '.') }})
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t border-slate-300 font-bold text-slate-900">
                        <tr>
                            <td class="py-2 pl-2">Arus Kas Bersih dari Aktivitas Operasi</td>
                            <td class="py-2 text-right font-mono text-emerald-800">
                                Rp {{ number_format($report['operating_activities']['net_cash'], 2, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- II. AKTIVITAS INVESTASI -->
            <div>
                <div class="font-bold text-slate-900 uppercase mb-2">ARUS KAS DARI AKTIVITAS INVESTASI</div>
                <table class="w-full">
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Pengadaan Peralatan dan Inventaris Kantor UPZ</td>
                            <td class="py-1 text-right font-mono text-slate-900 w-44">
                                Rp {{ number_format($report['investing_activities']['net_cash'], 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t border-slate-300 font-bold text-slate-900">
                        <tr>
                            <td class="py-2 pl-2">Arus Kas Bersih dari Aktivitas Investasi</td>
                            <td class="py-2 text-right font-mono text-slate-800">
                                Rp {{ number_format($report['investing_activities']['net_cash'], 2, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- III. AKTIVITAS PENDANAAN / PENYETORAN -->
            <div>
                <div class="font-bold text-slate-900 uppercase mb-2">ARUS KAS DARI AKTIVITAS PENYETORAN (PENDANAAN)</div>
                <table class="w-full">
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="py-1 pl-4 text-slate-700">Penyetoran Hasil Pengumpulan ke Rekening BAZNAS RI</td>
                            <td class="py-1 text-right font-mono text-rose-800 w-44">
                                {{ $report['financing_activities']['net_cash'] < 0 ? '(Rp ' . number_format(abs($report['financing_activities']['net_cash']), 2, ',', '.') . ')' : 'Rp ' . number_format($report['financing_activities']['net_cash'], 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="border-t border-slate-300 font-bold text-slate-900">
                        <tr>
                            <td class="py-2 pl-2">Arus Kas Bersih dari Aktivitas Penyetoran BAZNAS</td>
                            <td class="py-2 text-right font-mono text-amber-800">
                                {{ $report['financing_activities']['net_cash'] < 0 ? '(Rp ' . number_format(abs($report['financing_activities']['net_cash']), 2, ',', '.') . ')' : 'Rp ' . number_format($report['financing_activities']['net_cash'], 2, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- REKONSILIASI KAS AKHIR -->
            <div class="border-t-2 border-slate-800 pt-3 space-y-1.5 font-bold text-slate-900">
                <div class="flex justify-between py-1">
                    <span>KENAIKAN (PENURUNAN) BERSIH KAS DAN SETARA KAS</span>
                    <span class="font-mono text-sm text-emerald-800">Rp {{ number_format($report['net_cash_change'], 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-1 font-medium text-slate-600">
                    <span>SALDO KAS DAN SETARA KAS AWAL PERIODE</span>
                    <span class="font-mono">Rp {{ number_format($report['beginning_cash'], 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2 bg-emerald-50 px-3 rounded-lg border border-emerald-300 font-extrabold text-emerald-950">
                    <span>SALDO KAS DAN SETARA KAS AKHIR PERIODE</span>
                    <span class="font-mono text-sm">Rp {{ number_format($report['ending_cash'], 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="grid grid-cols-2 gap-8 pt-8 text-xs text-center">
            <div class="space-y-1">
                <div class="text-slate-500">Mengetahui,</div>
                <div class="font-bold text-slate-800 uppercase">Ketua UPZ BAZNAS</div>
                <div class="h-20"></div>
                <div class="font-bold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">{{ $upz->chairman_name ?? 'Ketua UPZ' }}</div>
            </div>
            <div class="space-y-1">
                <div class="text-slate-500">{{ $upz->city }}, {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</div>
                <div class="font-bold text-slate-800 uppercase">Bagian Keuangan / Akuntan</div>
                <div class="h-20"></div>
                <div class="font-bold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">{{ $upz->treasurer_name ?? 'Bendahara / Akuntan' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
