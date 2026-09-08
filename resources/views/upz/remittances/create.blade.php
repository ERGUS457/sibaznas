@extends('layouts.app')

@section('title', 'Rekam Setoran Hasil Pengumpulan ke BAZNAS')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Rekam Setoran ke BAZNAS</h1>
            <p class="text-xs text-slate-500">Mencatat penyetoran hasil penghimpunan dana ZIS dari rekening penampungan UPZ ke rekening resmi BAZNAS.</p>
        </div>
        <a href="{{ route('remittances.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <form method="POST" action="{{ route('remittances.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="upz_profile_id" value="{{ $upz->id }}">

            <!-- Auto Summary Box -->
            <div class="bg-amber-50/70 border border-amber-200 rounded-xl p-4 text-xs space-y-2">
                <div class="font-bold text-amber-900 flex items-center gap-1.5">
                    <i class="fa-solid fa-calculator"></i>
                    <span>Akumulasi Pengumpulan &amp; Rekomendasi Setoran</span>
                </div>
                <div class="grid grid-cols-3 gap-3 pt-1 text-center">
                    <div class="bg-white p-2 rounded border border-amber-200">
                        <span class="text-slate-500 text-[11px]">Total ZIS Dihimpun</span>
                        <div class="font-bold text-slate-800 text-xs mt-0.5">Rp {{ number_format($totalCollected, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-white p-2 rounded border border-amber-200">
                        <span class="text-slate-500 text-[11px]">Hak Amil UPZ</span>
                        <div class="font-bold text-amber-700 text-xs mt-0.5">Rp {{ number_format($totalAmil, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-white p-2 rounded border border-amber-200">
                        <span class="text-slate-500 text-[11px]">Sisa Siap Disetor</span>
                        <div class="font-bold text-emerald-700 text-xs mt-0.5">Rp {{ number_format($suggestedRemittance, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <!-- Date, Month, and Year -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tanggal Transfer / Setor <span class="text-rose-500">*</span></label>
                    <input type="date" name="remittance_date" value="{{ old('remittance_date', date('Y-m-d')) }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Periode Bulan <span class="text-rose-500">*</span></label>
                    <select name="period_month" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ old('period_month', date('n')) == $m ? 'selected' : '' }}>
                            {{ \App\Models\Upz\BaznasRemittance::MONTH_NAMES[$m] }}
                        </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tahun Anggaran <span class="text-rose-500">*</span></label>
                    <input type="number" name="period_year" value="{{ old('period_year', date('Y')) }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none font-bold">
                </div>
            </div>

            <!-- Bank Target -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Bank Rekening Resmi BAZNAS <span class="text-rose-500">*</span></label>
                    <input type="text" name="target_baznas_bank" value="{{ old('target_baznas_bank', 'Bank Syariah Indonesia (BSI) BAZNAS RI') }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor Rekening BAZNAS <span class="text-rose-500">*</span></label>
                    <input type="text" name="target_baznas_account_number" value="{{ old('target_baznas_account_number', '7001122334') }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none font-mono">
                </div>
            </div>

            <!-- Amount Remitted -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nominal Disetor ke BAZNAS (Rp) <span class="text-rose-500">*</span></label>
                <input type="number" step="any" min="1" name="amount_remitted" value="{{ old('amount_remitted', $suggestedRemittance) }}" required placeholder="Contoh: 20000000" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none font-bold text-slate-900 text-sm">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Catatan Setoran</label>
                <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Contoh: Penyetoran termin I pengumpulan ZIS bulan berjalan" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                <a href="{{ route('remittances.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan &amp; Posting Setoran BAZNAS</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
