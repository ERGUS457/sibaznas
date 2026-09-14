@extends('layouts.app')

@section('title', 'Detail BSZ ' . $collection->bsz_number)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-xs font-semibold uppercase text-emerald-600 tracking-wider">Bukti Setor Zakat (BSZ)</div>
            <h1 class="text-2xl font-bold font-mono text-slate-900">{{ $collection->bsz_number }}</h1>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('collections.print-bsz', $collection->id) }}" target="_blank" class="inline-flex items-center space-x-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-sm transition">
                <i class="fa-solid fa-print"></i>
                <span>Cetak Lembar BSZ</span>
            </a>
            <a href="{{ route('collections.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900 px-3 py-2 border border-slate-300 rounded-xl">
                Kembali
            </a>
        </div>
    </div>

    <!-- BSZ Summary Card -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-slate-200">
            <div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Data Muzakki / Munfiq</h3>
                <div class="text-lg font-bold text-slate-900">{{ $collection->muzakki->name }}</div>
                <div class="text-xs text-slate-600 mt-1 space-y-1">
                    <div><span class="font-medium text-slate-400">NPWZ:</span> <span class="font-mono">{{ $collection->muzakki->npwz ?? 'Belum ada' }}</span></div>
                    <div><span class="font-medium text-slate-400">NIK/NPWP:</span> <span class="font-mono">{{ $collection->muzakki->nik_or_npwp ?? '-' }}</span></div>
                    <div><span class="font-medium text-slate-400">Instansi:</span> {{ $collection->muzakki->workplace_or_agency ?? '-' }}</div>
                </div>
            </div>
            <div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Detail Transaksi</h3>
                <div class="text-xs text-slate-600 space-y-1.5">
                    <div><span class="font-medium text-slate-400">Tanggal:</span> <span class="font-semibold text-slate-800">{{ $collection->transaction_date->format('d F Y') }}</span></div>
                    <div><span class="font-medium text-slate-400">Jenis Dana:</span> <span class="font-semibold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">{{ $collection->fund_type_label }}</span></div>
                    <div><span class="font-medium text-slate-400">Sub-Kategori:</span> {{ $collection->fund_subtype ?? '-' }}</div>
                    <div><span class="font-medium text-slate-400">Metode:</span> {{ $collection->payment_method_label }}</div>
                    <div><span class="font-medium text-slate-400">No. Referensi:</span> {{ $collection->reference_number ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Financial Breakdown -->
        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
            <h3 class="text-xs font-bold text-slate-700 uppercase mb-3">Rincian Alokasi Dana</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                <div class="bg-white p-3 rounded-lg border border-slate-200">
                    <span class="text-xs text-slate-500">Total Nilai ZIS</span>
                    <div class="text-lg font-bold text-slate-900 mt-1">Rp {{ number_format($collection->amount, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white p-3 rounded-lg border border-slate-200">
                    <span class="text-xs text-slate-500">Hak Amil ({{ $collection->amil_percentage }}%)</span>
                    <div class="text-lg font-bold text-amber-600 mt-1">Rp {{ number_format($collection->amil_amount, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white p-3 rounded-lg border border-slate-200">
                    <span class="text-xs text-slate-500">Dana Terikat Mustahiq</span>
                    <div class="text-lg font-bold text-emerald-600 mt-1">Rp {{ number_format($collection->net_fund_amount, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- Linked Accounting Journal -->
        @if($collection->journalEntry)
        <div>
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-bold text-slate-700 uppercase flex items-center gap-2">
                    <i class="fa-solid fa-book text-indigo-600"></i>
                    <span>Jurnal Akuntansi Otomatis (DE ISAK 35 Format A)</span>
                </h3>
                <span class="text-xs font-mono font-semibold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-200">
                    {{ $collection->journalEntry->entry_number }}
                </span>
            </div>
            <div class="border border-slate-200 rounded-lg overflow-hidden">
                <table class="w-full text-xs text-left">
                    <thead class="bg-slate-100 text-slate-600 font-semibold border-b border-slate-200">
                        <tr>
                            <th class="p-2.5">Kode Akun</th>
                            <th class="p-2.5">Nama Akun</th>
                            <th class="p-2.5">Klasifikasi ISAK 35</th>
                            <th class="p-2.5 text-right">Debit (Rp)</th>
                            <th class="p-2.5 text-right">Kredit (Rp)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($collection->journalEntry->items as $item)
                        <tr>
                            <td class="p-2.5 font-mono font-medium text-slate-900">{{ $item->account->code }}</td>
                            <td class="p-2.5 font-semibold text-slate-800">{{ $item->account->name }}</td>
                            <td class="p-2.5">
                                <span class="text-[10px] px-2 py-0.5 rounded-full {{ $item->restriction_type === 'dengan_pembatasan' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }}">
                                    {{ $item->account->classification_label }}
                                </span>
                            </td>
                            <td class="p-2.5 text-right font-mono font-semibold">{{ $item->debit > 0 ? number_format($item->debit, 0, ',', '.') : '-' }}</td>
                            <td class="p-2.5 text-right font-mono font-semibold">{{ $item->credit > 0 ? number_format($item->credit, 0, ',', '.') : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-50 font-bold border-t border-slate-200">
                        <tr>
                            <td colspan="3" class="p-2.5 text-right">Total Debit / Kredit:</td>
                            <td class="p-2.5 text-right font-mono text-emerald-700">Rp {{ number_format($collection->journalEntry->total_debit, 0, ',', '.') }}</td>
                            <td class="p-2.5 text-right font-mono text-emerald-700">Rp {{ number_format($collection->journalEntry->total_credit, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
