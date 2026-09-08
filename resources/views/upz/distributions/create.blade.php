@extends('layouts.app')

@section('title', 'Input Penyaluran ZIS ke Mustahiq')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Input Penyaluran ZIS</h1>
            <p class="text-xs text-slate-500">Mencatat pendistribusian dana ZIS ke Mustahiq 8 Asnaf dan otomatis memposting beban program pada jurnal ISAK 35.</p>
        </div>
        <a href="{{ route('distributions.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <form method="POST" action="{{ route('distributions.store') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="upz_profile_id" value="{{ $upz->id }}">

            <!-- Mustahiq Selection -->
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Pilih Mustahiq Terdaftar</label>
                    <a href="{{ route('mustahiqs.create') }}" target="_blank" class="text-xs text-teal-600 hover:text-teal-800 font-semibold">+ Tambah Mustahiq Baru</a>
                </div>
                <select name="mustahiq_id" id="mustahiqSelect" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                    <option value="">-- Pilih Mustahiq (atau isi nama manual jika kegiatan massal) --</option>
                    @foreach($mustahiqs as $mustahiq)
                    <option value="{{ $mustahiq->id }}" data-asnaf="{{ $mustahiq->asnaf_category }}" data-name="{{ $mustahiq->name }}" {{ old('mustahiq_id') == $mustahiq->id ? 'selected' : '' }}>
                        {{ $mustahiq->name }} [Asnaf: {{ strtoupper($mustahiq->asnaf_category) }} - {{ $mustahiq->city ?? '-' }}]
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Recipient Name -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Penerima Langsung / Penanggung Jawab Program <span class="text-rose-500">*</span></label>
                <input type="text" name="recipient_identity_name" id="recipientName" value="{{ old('recipient_identity_name') }}" required placeholder="Contoh: Pak Slamet Riyadi / Pengurus TPA Al-Ikhlas" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none font-medium">
            </div>

            <!-- Date, Fund Type, and Asnaf -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tanggal Penyaluran <span class="text-rose-500">*</span></label>
                    <input type="date" name="distribution_date" value="{{ old('distribution_date', date('Y-m-d')) }}" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sumber Dana <span class="text-rose-500">*</span></label>
                    <select name="fund_type" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                        <option value="zakat_maal">Zakat Maal</option>
                        <option value="zakat_fitrah">Zakat Fitrah</option>
                        <option value="infak_terikat">Infak Terikat</option>
                        <option value="dskl">DSKL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Asnaf Tujuan <span class="text-rose-500">*</span></label>
                    <select name="asnaf_category" id="asnafSelect" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none font-semibold">
                        <option value="fakir">Fakir</option>
                        <option value="miskin">Miskin</option>
                        <option value="fisabilillah">Fisabilillah</option>
                        <option value="gharimin">Gharimin</option>
                        <option value="mualaf">Mualaf</option>
                        <option value="ibnu_sabil">Ibnu Sabil</option>
                        <option value="riqab">Riqab</option>
                    </select>
                </div>
            </div>

            <!-- Program Name & Type -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Program BAZNAS <span class="text-rose-500">*</span></label>
                    <input type="text" name="program_name" value="{{ old('program_name') }}" required placeholder="Contoh: BAZNAS Peduli, BAZNAS Cerdas, BAZNAS Sehat" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Karakteristik Penyaluran</label>
                    <select name="distribution_type" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                        <option value="konsumtif">Konsumtif (Santunan Sembako, Bantuan Tunai Langsung, Biaya Pengobatan)</option>
                        <option value="produktif">Produktif (Modal Usaha Mikro, Alat Kerja, Pelatihan Vokasi)</option>
                    </select>
                </div>
            </div>

            <!-- Amount & Description -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nominal Bantuan (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" step="any" min="1" name="amount" value="{{ old('amount') }}" required placeholder="Contoh: 1500000" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none font-bold text-slate-900">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Keterangan / Berita Acara</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Catatan bantuan atau berita acara serah terima" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                <a href="{{ route('distributions.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-sm transition flex items-center gap-1.5">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Simpan &amp; Posting Penyaluran</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('mustahiqSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (selected.value) {
            document.getElementById('recipientName').value = selected.getAttribute('data-name');
            const asnaf = selected.getAttribute('data-asnaf');
            if (asnaf) {
                document.getElementById('asnafSelect').value = asnaf;
            }
        }
    });
</script>
@endsection
