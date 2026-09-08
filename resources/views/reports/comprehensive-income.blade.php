@extends('layouts.app')

@section('title', 'Laporan Penghasilan Komprehensif (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar -->
    <div class="flex items-center justify-between no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Laporan Penghasilan Komprehensif</h1>
            <p class="text-xs text-slate-500">Penyajian Penghasilan Komprehensif Standar DE ISAK 35 Format A.</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2 text-xs">
                <input type="date" name="start_date" value="{{ $startDate }}" class="border border-slate-300 rounded-lg p-1.5 focus:ring-2 focus:ring-emerald-500">
                <span class="text-slate-400">s/d</span>
                <input type="date" name="end_date" value="{{ $endDate }}" class="border border-slate-300 rounded-lg p-1.5 focus:ring-2 focus:ring-emerald-500">
                <button type="submit" class="bg-slate-800 text-white px-3 py-1.5 rounded-lg">Filter</button>
            </form>
            <button onclick="window.print()" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak</span>
            </button>
        </div>
    </div>

    <!-- Formal Statement Box -->
    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-6">
        <!-- Header -->
        <div class="text-center border-b-2 border-slate-800 pb-4">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide">{{ $upz->name }}</h2>
            <p class="text-xs text-slate-500">Unit Pengumpul Zakat Pembantu {{ $upz->parent_baznas_name }} &bull; SK: {{ $upz->sk_number }}</p>
            <h1 class="text-lg font-black text-emerald-950 uppercase tracking-wider mt-2">LAPORAN PENGHASILAN KOMPREHENSIF</h1>
            <p class="text-xs font-semibold text-slate-700">
                Periode {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
            </p>
            <p class="text-[11px] text-slate-400 italic">(Disajikan dalam Rupiah, sesuai DE ISAK 35 Format A)</p>
        </div>

        <div class="text-xs space-y-6">
            <!-- I. PENGHASILAN TANPA PEMBATASAN -->
            <div>
                <div class="bg-amber-50/80 px-3 py-1.5 font-bold uppercase tracking-wider text-amber-900 border-l-4 border-amber-600">
                    I. PENGHASILAN TANPA PEMBATASAN (DANA AMIL / OPERASIONAL)
                </div>
                <div class="mt-2 space-y-3">
                    <!-- Pendapatan -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">A. Pendapatan Tanpa Pembatasan</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['unrestricted_revenues'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada pendapatan tanpa pembatasan</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1 pl-4">Jumlah Pendapatan Tanpa Pembatasan</td>
                                    <td class="py-1 text-right font-mono text-amber-800">
                                        Rp {{ number_format($report['total_unrestricted_revenue'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Beban Manajemen & Umum -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">B. Beban Manajemen &amp; Umum (Operasional Amil)</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['unrestricted_expenses'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada beban operasional amil pada periode ini</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1 pl-4">Jumlah Beban Manajemen &amp; Umum</td>
                                    <td class="py-1 text-right font-mono text-rose-800">
                                        Rp {{ number_format($report['total_unrestricted_expense'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-amber-100/50 px-3 py-2 font-bold text-amber-950 flex justify-between border-t border-amber-300 mt-2">
                    <span>KENAIKAN (PENURUNAN) ASET BERSIH TANPA PEMBATASAN</span>
                    <span class="font-mono font-extrabold text-sm">Rp {{ number_format($report['change_unrestricted_net_assets'], 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- II. PENGHASILAN DENGAN PEMBATASAN -->
            <div>
                <div class="bg-emerald-50/80 px-3 py-1.5 font-bold uppercase tracking-wider text-emerald-900 border-l-4 border-emerald-600">
                    II. PENGHASILAN DENGAN PEMBATASAN (DANA ZIS &amp; DSKL TERIKAT)
                </div>
                <div class="mt-2 space-y-3">
                    <!-- Penerimaan ZIS -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">A. Penerimaan Sumbangan / ZIS Terikat</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['restricted_revenues'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada penerimaan ZIS terikat</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1 pl-4">Jumlah Penerimaan ZIS Terikat</td>
                                    <td class="py-1 text-right font-mono text-emerald-800">
                                        Rp {{ number_format($report['total_restricted_revenue'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Beban Penyaluran Program -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">B. Beban Program / Penyaluran kepada Mustahiq (8 Asnaf)</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['program_expenses'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada penyaluran program pada periode ini</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1 pl-4">Jumlah Beban Program / Penyaluran</td>
                                    <td class="py-1 text-right font-mono text-rose-800">
                                        Rp {{ number_format($report['total_program_expense'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-emerald-100/50 px-3 py-2 font-bold text-emerald-950 flex justify-between border-t border-emerald-300 mt-2">
                    <span>KENAIKAN (PENURUNAN) ASET BERSIH DENGAN PEMBATASAN</span>
                    <span class="font-mono font-extrabold text-sm">Rp {{ number_format($report['change_restricted_net_assets'], 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- III. TOTAL PERUBAHAN ASET BERSIH -->
            <div class="bg-indigo-900 text-white p-4 rounded-xl flex justify-between items-center shadow-sm">
                <div>
                    <span class="font-extrabold uppercase text-sm tracking-wide">TOTAL KENAIKAN (PENURUNAN) ASET BERSIH</span>
                    <p class="text-[11px] text-indigo-200 mt-0.5">Surplus / defisit komprehensif periode berjalan</p>
                </div>
                <div class="text-xl font-mono font-black text-amber-300">
                    Rp {{ number_format($report['total_change_in_net_assets'], 2, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="grid grid-cols-2 gap-8 pt-6 text-xs text-center">
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
