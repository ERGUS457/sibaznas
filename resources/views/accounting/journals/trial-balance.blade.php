@extends('layouts.app')

@section('title', 'Neraca Saldo (Trial Balance)')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Neraca Saldo (Trial Balance)</h1>
            <p class="text-xs text-slate-500">Daftar saldo akhir seluruh akun riil dan nominal untuk verifikasi keseimbangan pembukuan.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-500">Per Tanggal: {{ \Carbon\Carbon::parse($asOfDate)->format('d F Y') }}</span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-100 text-slate-700 font-semibold border-b border-slate-200 uppercase tracking-wider">
                    <tr>
                        <th class="p-3">Kode Akun</th>
                        <th class="p-3">Nama Akun</th>
                        <th class="p-3">Klasifikasi DE ISAK 35</th>
                        <th class="p-3 text-right">Debit (Rp)</th>
                        <th class="p-3 text-right">Kredit (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($rows as $row)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-3 font-mono font-medium text-slate-900">{{ $row['account']->code }}</td>
                        <td class="p-3 font-semibold text-slate-800">{{ $row['account']->name }}</td>
                        <td class="p-3">
                            <span class="inline-block text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                {{ $row['account']->classification_label }}
                            </span>
                        </td>
                        <td class="p-3 text-right font-mono font-semibold text-slate-900">
                            {{ $row['debit'] > 0 ? number_format($row['debit'], 2, ',', '.') : '-' }}
                        </td>
                        <td class="p-3 text-right font-mono font-semibold text-slate-900">
                            {{ $row['credit'] > 0 ? number_format($row['credit'], 2, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-400">Tidak ada saldo akun tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-slate-100 font-extrabold border-t-2 border-slate-300">
                    <tr>
                        <td colspan="3" class="p-3 text-right uppercase text-slate-800">Total Neraca Saldo:</td>
                        <td class="p-3 text-right font-mono text-emerald-800 text-sm">
                            Rp {{ number_format($grandDebit, 2, ',', '.') }}
                        </td>
                        <td class="p-3 text-right font-mono text-emerald-800 text-sm">
                            Rp {{ number_format($grandCredit, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="p-2 text-center text-xs {{ round($grandDebit, 2) === round($grandCredit, 2) ? 'bg-emerald-50 text-emerald-800' : 'bg-rose-50 text-rose-800' }}">
                            @if(round($grandDebit, 2) === round($grandCredit, 2))
                            <i class="fa-solid fa-check-circle mr-1"></i> Neraca Saldo Seimbang (Total Debit = Total Kredit)
                            @else
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Selisih Neraca: Rp {{ number_format(abs($grandDebit - $grandCredit), 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
