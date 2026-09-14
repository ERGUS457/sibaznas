@extends('layouts.app')

@section('title', 'Input Transaksi Keuangan / Jurnal Umum')

@section('content')
<div class="max-w-5xl mx-auto space-y-6" x-data="journalForm()">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-[10px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded border border-slate-200">
                    JURNAL UMUM
                </span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">Input Transaksi Keuangan / Jurnal Umum</h1>
            <p class="text-xs text-slate-500">Catat transaksi harian: pemasukan, pengeluaran, penyaluran, dan penyesuaian saldo.</p>
        </div>
        <a href="{{ route('journals.index') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold inline-flex items-center gap-2 text-slate-700 w-fit">
            <i class="fa-solid fa-arrow-left text-slate-400"></i>
            <span>Kembali ke Jurnal</span>
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-xl p-4 text-xs space-y-1 shadow-xs">
        <div class="font-bold flex items-center gap-2 text-rose-900">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>Terdapat kesalahan pengisian form:</span>
        </div>
        <ul class="list-disc list-inside space-y-1 pl-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-6 space-y-6">
        <form method="POST" action="{{ route('journals.store') }}" class="space-y-6" @submit="handleSubmit">
            @csrf

            <!-- Header Info: Tanggal, Nomor Transaksi, Keterangan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50/70 p-4 rounded-xl border border-slate-200">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Tanggal Transaksi <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required
                        class="w-full text-xs border border-slate-300 rounded-lg p-2.5 bg-white focus:ring-2 focus:ring-slate-700 focus:outline-none font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Nomor Transaksi <span class="text-slate-400 font-normal text-[10px]">(Opsional - Otomatis)</span>
                    </label>
                    <input type="text" name="voucher_number" value="{{ old('voucher_number') }}" placeholder="Contoh: JV/202609/0001"
                        class="w-full text-xs border border-slate-300 rounded-lg p-2.5 bg-white focus:ring-2 focus:ring-slate-700 focus:outline-none font-mono">
                </div>
                <div class="md:col-span-3 sm:col-span-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Deskripsi / Keterangan Transaksi <span class="text-slate-400 font-normal text-[10px]">(Opsional)</span>
                    </label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Contoh: Pembayaran Beban Listrik & Internet Kantor Bulan September"
                        class="w-full text-xs border border-slate-300 rounded-lg p-2.5 bg-white focus:ring-2 focus:ring-slate-700 focus:outline-none">
                </div>
            </div>

            <!-- Table Baris Jurnal -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-slate-600"></i> Rincian Akun &amp; Nominal Jurnal
                    </h2>
                    <button type="button" @click="addRow()" class="clay-btn-sky px-3 py-1.5 text-xs font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Baris Akun</span>
                    </button>
                </div>

                <div class="overflow-x-auto border border-slate-200 rounded-xl shadow-2xs">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-slate-100 text-slate-700 font-bold uppercase tracking-wider text-[10px] border-b border-slate-200">
                            <tr>
                                <th class="p-3 w-10 text-center">#</th>
                                <th class="p-3 min-w-[260px]">Akun <span class="text-rose-500">*</span></th>
                                <th class="p-3 min-w-[140px] text-right">Debit (Rp)</th>
                                <th class="p-3 min-w-[140px] text-right">Kredit (Rp)</th>
                                <th class="p-3 min-w-[180px]">Keterangan</th>
                                <th class="p-3 w-10 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="(row, index) in rows" :key="index">
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="p-3 text-center text-slate-400 font-mono text-[11px]" x-text="index + 1"></td>
                                    <td class="p-2.5">
                                        <select :name="`items[${index}][account_id]`" x-model="row.account_id" @change="updateHint(index)" required
                                            class="w-full text-xs border border-slate-300 rounded-lg p-2 focus:ring-2 focus:ring-slate-700 focus:outline-none">
                                            <option value="">-- Pilih Akun --</option>
                                            @foreach($accounts as $account)
                                            <option value="{{ $account->id }}">
                                                {{ $account->code }} - {{ $account->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div x-show="getAccount(index)" class="mt-1 text-[10px] leading-tight" :class="getAccount(index)?.normal_balance === 'DEBIT' ? 'text-emerald-700' : 'text-sky-700'">
                                            <span x-text="getAccount(index) ? `Normal: ${getAccount(index).normal_balance} — ${getAccount(index).normal_balance === 'DEBIT' ? 'Debit menambah, Kredit mengurangi' : 'Kredit menambah, Debit mengurangi'}` : ''"></span>
                                        </div>
                                        <input type="hidden" :name="`items[${index}][restriction_type]`" :value="getDefaultRestriction(index)">
                                    </td>
                                    <td class="p-2.5 text-right">
                                        <input type="number" step="any" min="0" :name="`items[${index}][debit]`" x-model.number="row.debit"
                                            @input="if(row.debit > 0) row.credit = 0; updateHint(index)" placeholder="0"
                                            class="w-full text-xs text-right border border-slate-300 rounded-lg p-2 font-mono font-medium focus:ring-2 focus:ring-slate-700 focus:outline-none">
                                    </td>
                                    <td class="p-2.5 text-right">
                                        <input type="number" step="any" min="0" :name="`items[${index}][credit]`" x-model.number="row.credit"
                                            @input="if(row.credit > 0) row.debit = 0; updateHint(index)" placeholder="0"
                                            class="w-full text-xs text-right border border-slate-300 rounded-lg p-2 font-mono font-medium focus:ring-2 focus:ring-slate-700 focus:outline-none">
                                    </td>
                                    <td class="p-2.5">
                                        <span class="text-[11px] leading-tight block" :class="row.hintColor" x-text="row.hint || '— Pilih akun & isi nominal'"></span>
                                    </td>
                                    <td class="p-2.5 text-center">
                                        <button type="button" @click="removeRow(index)" :disabled="rows.length <= 2"
                                            class="w-7 h-7 inline-flex items-center justify-center text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition disabled:opacity-30 disabled:cursor-not-allowed">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <p class="text-[11px] text-slate-500"><i class="fa-solid fa-circle-info mr-1"></i> Isi <b>salah satu</b> saja per baris: Debit <b>atau</b> Kredit. Total Debit harus sama dengan Total Kredit.</p>
            </div>

            <!-- Live Calculation & Balance Summary Footer -->
            <div class="bg-slate-900 text-white rounded-xl p-5 shadow-sm space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 block mb-1">Total Debit</span>
                        <div class="text-lg font-bold font-mono tracking-tight text-emerald-400">
                            Rp <span x-text="formatRupiah(totalDebit)">0</span>
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 block mb-1">Total Kredit</span>
                        <div class="text-lg font-bold font-mono tracking-tight text-sky-400">
                            Rp <span x-text="formatRupiah(totalCredit)">0</span>
                        </div>
                    </div>
                    <div>
                        <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-400 block mb-1">Status Keseimbangan</span>
                        <template x-if="isBalanced">
                            <div class="inline-flex items-center gap-1.5 bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 px-3 py-1 rounded-full text-xs font-bold">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>SEIMBANG (BALANCED)</span>
                            </div>
                        </template>
                        <template x-if="!isBalanced">
                            <div class="inline-flex items-center gap-1.5 bg-rose-500/20 text-rose-300 border border-rose-500/40 px-3 py-1 rounded-full text-xs font-bold">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                                <span>SELISIH: Rp <span x-text="formatRupiah(difference)">0</span></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <span class="text-slate-400 text-[11px]">
                        <i class="fa-solid fa-info-circle mr-1"></i> Pastikan total Debit sama dengan total Kredit sebelum menyimpan.
                    </span>
                    <button type="submit" :disabled="!isBalanced || totalDebit <= 0"
                        class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-6 py-2.5 rounded-lg shadow-sm transition flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Entri Jurnal Keuangan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
const ACCOUNT_MAP = {
    @foreach($accounts as $a)
    "{{ $a->id }}": { code: "{{ $a->code }}", name: "{{ addslashes($a->name) }}", category: "{{ $a->category }}", normal_balance: "{{ $a->normal_balance }}" },
    @endforeach
};
function journalForm() {
    return {
        rows: [
            { account_id: '', debit: 0, credit: 0, hint: '', hintColor: 'text-slate-400' },
            { account_id: '', debit: 0, credit: 0, hint: '', hintColor: 'text-slate-400' }
        ],
        getAccount(index) {
            return ACCOUNT_MAP[this.rows[index].account_id] || null;
        },
        getDefaultRestriction(index) {
            const acc = this.getAccount(index);
            if (!acc) return 'WITHOUT_RESTRICTION';
            // Aset bersih / pendapatan terbatas -> WITH_RESTRICTION
            if (acc.category === 'NET_ASSET' || acc.code.startsWith('4-2') || acc.code.startsWith('5-1')) return 'WITH_RESTRICTION';
            return 'WITHOUT_RESTRICTION';
        },
        updateHint(index) {
            const acc = this.getAccount(index);
            const row = this.rows[index];
            if (!acc) { row.hint = '— Pilih akun & isi nominal'; row.hintColor='text-slate-400'; return; }
            const hasDebit = (parseFloat(row.debit)||0) > 0;
            const hasCredit = (parseFloat(row.credit)||0) > 0;
            if (!hasDebit && !hasCredit) {
                row.hint = acc.normal_balance === 'DEBIT' ? 'Isi Debit untuk menambah, Kredit untuk mengurangi' : 'Isi Kredit untuk menambah, Debit untuk mengurangi';
                row.hintColor = 'text-slate-500';
                return;
            }
            const isNormal = (hasDebit && acc.normal_balance==='DEBIT') || (hasCredit && acc.normal_balance==='CREDIT');
            if (isNormal) {
                row.hint = hasDebit ? `Debit ${acc.name}: menambah saldo` : `Kredit ${acc.name}: menambah saldo`;
                row.hintColor = 'text-emerald-700 font-medium';
            } else {
                row.hint = hasDebit ? `Debit ${acc.name}: mengurangi saldo` : `Kredit ${acc.name}: mengurangi saldo`;
                row.hintColor = 'text-amber-700 font-medium';
            }
        },
        addRow() {
            this.rows.push({ account_id: '', debit: 0, credit: 0, hint: '', hintColor: 'text-slate-400' });
        },
        removeRow(index) {
            if (this.rows.length > 2) {
                this.rows.splice(index, 1);
            }
        },
        get totalDebit() {
            return this.rows.reduce((sum, r) => sum + (parseFloat(r.debit) || 0), 0);
        },
        get totalCredit() {
            return this.rows.reduce((sum, r) => sum + (parseFloat(r.credit) || 0), 0);
        },
        get difference() {
            return Math.abs(this.totalDebit - this.totalCredit);
        },
        get isBalanced() {
            return this.totalDebit > 0 && Math.abs(this.totalDebit - this.totalCredit) < 0.01;
        },
        formatRupiah(num) {
            return new Intl.NumberFormat('id-ID').format(Math.round(num || 0));
        },
        handleSubmit(e) {
            if (!this.isBalanced) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Jurnal Unbalanced!',
                    text: 'Total Debit dan Total Kredit harus seimbang sebelum disimpan.'
                });
            }
        }
    }
}
</script>
@endsection
