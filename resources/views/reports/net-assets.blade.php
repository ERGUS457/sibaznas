@extends('layouts.app')

@section('title', 'Laporan Perubahan Aset Bersih (DE ISAK 35 Format A)')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between no-print">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Laporan Perubahan Aset Bersih</h1>
            <p class="text-xs text-slate-500">Rekonsiliasi pergerakan saldo aset bersih tanpa pembatasan dan dengan pembatasan.</p>
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
            <h1 class="text-lg font-black text-emerald-950 uppercase tracking-wider mt-2">LAPORAN PERUBAHAN ASET BERSIH</h1>
            <p class="text-xs font-semibold text-slate-700">
                Periode {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
            </p>
            <p class="text-[11px] text-slate-400 italic">(Disajikan dalam Rupiah, sesuai DE ISAK 35 Format A)</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-800 font-bold border-b-2 border-slate-300">
                    <tr>
                        <th class="p-3">Uraian Rekonsiliasi</th>
                        <th class="p-3 text-right">Tanpa Pembatasan (Rp)</th>
                        <th class="p-3 text-right">Dengan Pembatasan (Rp)</th>
                        <th class="p-3 text-right">Total Aset Bersih (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-800">
                    <tr>
                        <td class="p-3 font-semibold">Saldo Awal Aset Bersih</td>
                        <td class="p-3 text-right font-mono font-medium">
                            {{ number_format($report['beginning_unrestricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono font-medium">
                            {{ number_format($report['beginning_restricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono font-bold">
                            {{ number_format($report['beginning_total'], 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="bg-emerald-50/30">
                        <td class="p-3 font-semibold text-emerald-900">
                            Kenaikan / (Penurunan) Bersih Periode Berjalan
                        </td>
                        <td class="p-3 text-right font-mono font-medium text-amber-800">
                            {{ number_format($report['change_unrestricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono font-medium text-emerald-800">
                            {{ number_format($report['change_restricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono font-bold text-emerald-900">
                            {{ number_format($report['change_total'], 2, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot class="bg-slate-100 font-extrabold border-t-2 border-slate-300">
                    <tr>
                        <td class="p-3 uppercase">Saldo Akhir Aset Bersih</td>
                        <td class="p-3 text-right font-mono text-amber-900 text-sm">
                            Rp {{ number_format($report['ending_unrestricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono text-emerald-900 text-sm">
                            Rp {{ number_format($report['ending_restricted'], 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono text-indigo-950 text-sm">
                            Rp {{ number_format($report['ending_total'], 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

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
