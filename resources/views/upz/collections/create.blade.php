@extends('layouts.app')

@section('title', 'Input Penerimaan ZIS & Terbitkan BSZ')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Input Penerimaan ZIS &amp; Terbitkan BSZ</h1>
            <p class="text-xs text-slate-500">Menerbitkan Bukti Setor Zakat (BSZ) resmi dan menjurnal otomatis ke pembukuan ISAK 35.</p>
        </div>
        <a href="{{ route('collections.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <form method="POST" action="{{ route('collections.store') }}" class="space-y-5" id="collectionForm">
            @csrf
            <input type="hidden" name="upz_profile_id" value="{{ $upz->id }}">

            <!-- Muzakki Selection -->
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Muzakki / Munfiq <span class="text-rose-500">*</span></label>
                    <a href="{{ route('muzakkis.create') }}" target="_blank" class="text-xs text-emerald-600 hover:text-emerald-800 font-semibold">+ Tambah Muzakki Baru</a>
                </div>
                <select name="muzakki_id" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <option value="">-- Pilih Muzakki --</option>
                    @foreach($muzakkis as $muzakki)
                    <option value="{{ $muzakki->id }}" {{ old('muzakki_id') == $muzakki->id ? 'selected' : '' }}>
                        {{ $muzakki->name }} ({{ strtoupper($muzakki->type) }} - NPWZ: {{ $muzakki->npwz ?? 'Belum ada' }})
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Transaction Date & Fund Type -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tanggal Transaksi <span class="text-rose-500">*</span></label>
                    <input type="date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jenis Dana ZIS <span class="text-rose-500">*</span></label>
                    <select name="fund_type" id="fundType" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="zakat_maal">Zakat Maal (Penghasilan, Perdagangan, Emas, Simpanan)</option>
                        <option value="zakat_fitrah">Zakat Fitrah</option>
                        <option value="infak_terikat">Infak / Sedekah Terikat Program</option>
                        <option value="infak_tidak_terikat">Infak / Sedekah Tidak Terikat</option>
                        <option value="dskl">DSKL (Dana Sosial Keagamaan Lainnya)</option>
                        <option value="fidyah_kafarat">Fidyah &amp; Kafarat</option>
                    </select>
                </div>
            </div>

            <!-- Subtype & Payment Method -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sub-Kategori ZIS</label>
                    <input type="text" name="fund_subtype" value="{{ old('fund_subtype') }}" placeholder="Contoh: Zakat Profesi / Gaji, Beras Fitrah 5 Jiwa" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Metode Pembayaran <span class="text-rose-500">*</span></label>
                    <select name="payment_method" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="transfer_bank">Transfer Bank BSI UPZ</option>
                        <option value="kas_tunai">Kas Tunai / Kantor UPZ</option>
                        <option value="payroll">Potong Gaji (Payroll)</option>
                        <option value="qris">QRIS BAZNAS</option>
                    </select>
                </div>
            </div>

            <!-- Amount & Amil Percentage -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nominal (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" step="any" min="1" name="amount" id="amount" value="{{ old('amount') }}" required placeholder="Contoh: 2500000" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-bold text-slate-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">
                        Persentase Hak Amil (%) 
                        <span class="text-[10px] text-emerald-600 font-normal">(Maks 12.5% Perbaznas 2/2016)</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="12.50" name="amil_percentage" id="amilPercentage" value="{{ old('amil_percentage', $upz->amil_share_percentage ?? 12.50) }}" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <!-- Live Calculation Preview -->
            <div class="bg-emerald-50/70 border border-emerald-200 rounded-xl p-4 text-xs space-y-2">
                <div class="font-bold text-emerald-900 flex items-center gap-1.5">
                    <i class="fa-solid fa-calculator"></i>
                    <span>Simulasi Alokasi Syariah &amp; Akuntansi DE ISAK 35</span>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-1">
                    <div>
                        <span class="text-slate-600">Alokasi Hak Amil (Tanpa Pembatasan):</span>
                        <div class="font-bold text-amber-700 text-sm mt-0.5" id="previewAmil">Rp 0</div>
                    </div>
                    <div>
                        <span class="text-slate-600">Hak Mustahiq (Dengan Pembatasan):</span>
                        <div class="font-bold text-emerald-700 text-sm mt-0.5" id="previewNet">Rp 0</div>
                    </div>
                </div>
            </div>

            <!-- Description & Reference -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">No. Referensi / Mutasi Bank</label>
                    <input type="text" name="reference_number" value="{{ old('reference_number') }}" placeholder="No. slip transfer atau mutasi" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Catatan / Doa Muzakki</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Catatan peruntukan atau doa muzakki" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                <a href="{{ route('collections.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-check"></i>
                    <span>Simpan &amp; Terbitkan BSZ</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateCalculation() {
        const amount = parseFloat(document.getElementById('amount').value) || 0;
        const percent = parseFloat(document.getElementById('amilPercentage').value) || 0;
        
        const amil = Math.round((amount * percent) / 100);
        const net = amount - amil;

        document.getElementById('previewAmil').innerText = 'Rp ' + amil.toLocaleString('id-ID');
        document.getElementById('previewNet').innerText = 'Rp ' + net.toLocaleString('id-ID');
    }

    document.getElementById('amount').addEventListener('input', updateCalculation);
    document.getElementById('amilPercentage').addEventListener('input', updateCalculation);
    updateCalculation();
</script>
@endsection
