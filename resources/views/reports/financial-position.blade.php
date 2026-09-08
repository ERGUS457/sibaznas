@extends('layouts.app')

@section('title', 'Laporan Posisi Keuangan (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Action Bar -->
    <div class="flex items-center justify-between no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Laporan Posisi Keuangan</h1>
            <p class="text-xs text-slate-500">Standar DE ISAK 35 Format A (Entitas Berorientasi Nonlaba).</p>
        </div>
        <div class="flex items-center space-x-2">
            <form method="GET" class="flex items-center space-x-2">
                <input type="date" name="as_of_date" value="{{ $asOfDate }}" class="text-xs border border-slate-300 rounded-lg p-1.5 focus:ring-2 focus:ring-emerald-500">
                <button type="submit" class="bg-slate-800 text-white text-xs px-3 py-1.5 rounded-lg">Update</button>
            </form>
            <button onclick="window.print()" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Laporan</span>
            </button>
        </div>
    </div>

    <!-- Formal Financial Statement Sheet -->
    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm space-y-6">
        <!-- Official Statement Header -->
        <div class="text-center border-b-2 border-slate-800 pb-4">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide">{{ $upz->name }}</h2>
            <p class="text-xs text-slate-500">Unit Pengumpul Zakat Pembantu {{ $upz->parent_baznas_name }} &bull; SK: {{ $upz->sk_number }}</p>
            <h1 class="text-lg font-black text-emerald-950 uppercase tracking-wider mt-2">LAPORAN POSISI KEUANGAN</h1>
            <p class="text-xs font-semibold text-slate-700">Per {{ \Carbon\Carbon::parse($asOfDate)->format('d F Y') }}</p>
            <p class="text-[11px] text-slate-400 italic">(Disajikan dalam Rupiah, sesuai DE ISAK 35 Format A)</p>
        </div>

        <!-- Table Content -->
        <div class="text-xs space-y-6">
            <!-- I. ASET -->
            <div>
                <div class="bg-slate-100 px-3 py-1.5 font-bold uppercase tracking-wider text-slate-800 border-l-4 border-emerald-600">
                    I. ASET
                </div>
                <div class="mt-2 space-y-3">
                    <!-- Aset Lancar -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">A. ASET LANCAR</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['current_assets'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada akun aset lancar</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1.5 pl-4">Jumlah Aset Lancar</td>
                                    <td class="py-1.5 text-right font-mono text-emerald-800">
                                        Rp {{ number_format($report['total_current_assets'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Aset Tidak Lancar -->
                    <div>
                        <div class="font-bold text-slate-700 pl-2">B. ASET TIDAK LANCAR</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['non_current_assets'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada aset tidak lancar</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1.5 pl-4">Jumlah Aset Tidak Lancar</td>
                                    <td class="py-1.5 text-right font-mono text-emerald-800">
                                        Rp {{ number_format($report['total_non_current_assets'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-emerald-50/80 px-3 py-2 font-extrabold text-emerald-950 flex justify-between border-t-2 border-emerald-700 mt-2">
                    <span class="uppercase">TOTAL ASET</span>
                    <span class="font-mono text-sm">Rp {{ number_format($report['total_assets'], 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- II. LIABILITAS -->
            <div>
                <div class="bg-slate-100 px-3 py-1.5 font-bold uppercase tracking-wider text-slate-800 border-l-4 border-amber-600">
                    II. LIABILITAS (KEWAJIBAN)
                </div>
                <div class="mt-2 space-y-3">
                    <div>
                        <div class="font-bold text-slate-700 pl-2">A. LIABILITAS JANGKA PENDEK</div>
                        <table class="w-full mt-1">
                            <tbody class="divide-y divide-slate-100">
                                @forelse($report['current_liabilities'] as $item)
                                <tr>
                                    <td class="py-1 pl-6 text-slate-800">{{ $item['account']->name }}</td>
                                    <td class="py-1 text-right font-mono text-slate-900 w-44">
                                        Rp {{ number_format($item['balance'], 2, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="py-1 pl-6 text-slate-400 italic">Tidak ada liabilitas jangka pendek</td>
                                    <td class="py-1 text-right font-mono">Rp 0,00</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                                <tr>
                                    <td class="py-1.5 pl-4">Jumlah Liabilitas Jangka Pendek</td>
                                    <td class="py-1.5 text-right font-mono text-amber-800">
                                        Rp {{ number_format($report['total_current_liabilities'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-slate-50 px-3 py-2 font-bold text-slate-800 flex justify-between border-t border-slate-300 mt-2">
                    <span class="uppercase">TOTAL LIABILITAS</span>
                    <span class="font-mono">Rp {{ number_format($report['total_liabilities'], 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- III. ASET BERSIH (NET ASSETS - DE ISAK 35) -->
            <div>
                <div class="bg-slate-100 px-3 py-1.5 font-bold uppercase tracking-wider text-slate-800 border-l-4 border-indigo-600">
                    III. ASET BERSIH (EKUITAS NONLABA DE ISAK 35)
                </div>
                <div class="mt-2 space-y-2">
                    <table class="w-full">
                        <tbody class="divide-y divide-slate-100">
                            <tr>
                                <td class="py-1.5 pl-4 font-semibold text-slate-800">
                                    Tanpa Pembatasan dari Pemberi Sumber Daya (Dana Amil / Operasional)
                                </td>
                                <td class="py-1.5 text-right font-mono font-bold text-amber-800 w-44">
                                    Rp {{ number_format($report['total_unrestricted_net_assets'], 2, ',', '.') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1.5 pl-4 font-semibold text-slate-800">
                                    Dengan Pembatasan dari Pemberi Sumber Daya (Dana Zakat &amp; Infak Terikat)
                                </td>
                                <td class="py-1.5 text-right font-mono font-bold text-emerald-800 w-44">
                                    Rp {{ number_format($report['total_restricted_net_assets'], 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="border-t border-slate-300 font-semibold text-slate-900">
                            <tr>
                                <td class="py-1.5 pl-4 uppercase">Total Aset Bersih</td>
                                <td class="py-1.5 text-right font-mono text-indigo-900 font-extrabold">
                                    Rp {{ number_format($report['total_net_assets'], 2, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="bg-indigo-50/80 px-3 py-2.5 font-extrabold text-indigo-950 flex justify-between border-t-2 border-indigo-700 mt-3">
                    <span class="uppercase">TOTAL LIABILITAS DAN ASET BERSIH</span>
                    <span class="font-mono text-sm">Rp {{ number_format($report['total_liabilities_and_net_assets'], 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Balance Indicator Badge -->
        <div class="p-2 text-center text-xs rounded-lg {{ $report['is_balanced'] ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-rose-50 text-rose-800' }}">
            @if($report['is_balanced'])
            <i class="fa-solid fa-check-circle mr-1"></i> Posisi Neraca Seimbang (Total Aset = Total Liabilitas + Total Aset Bersih)
            @else
            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Posisi Neraca Tidak Seimbang
            @endif
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
                <div class="text-slate-500">{{ $upz->city }}, {{ \Carbon\Carbon::parse($asOfDate)->format('d F Y') }}</div>
                <div class="font-bold text-slate-800 uppercase">Bagian Keuangan / Akuntan</div>
                <div class="h-20"></div>
                <div class="font-bold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">{{ $upz->treasurer_name ?? 'Bendahara / Akuntan' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
