@extends('layouts.app')

@section('title', 'Daftarkan Mustahiq Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Registrasi Mustahiq Baru (8 Asnaf)</h1>
            <p class="text-xs text-slate-500">Mendaftarkan data mustahiq calon penerima manfaat program BAZNAS.</p>
        </div>
        <a href="{{ route('mustahiqs.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <form method="POST" action="{{ route('mustahiqs.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="upz_profile_id" value="{{ $upz->id }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Mustahiq" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none font-bold">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori Asnaf <span class="text-rose-500">*</span></label>
                    <select name="asnaf_category" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none font-semibold">
                        @foreach(\App\Models\Upz\Mustahiq::ASNAF_LABELS as $key => $label)
                        <option value="{{ $key }}" {{ old('asnaf_category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK KTP" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jenis Kelamin</label>
                    <select name="gender" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jumlah Tanggungan (Jiwa)</label>
                    <input type="number" min="0" name="family_dependents_count" value="{{ old('family_dependents_count', 0) }}" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Penghasilan / Bulan (Rp)</label>
                    <input type="number" min="0" step="any" name="monthly_income" value="{{ old('monthly_income', 0) }}" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">No. Kontak / HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08..." class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Domisili</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Jalan, RT/RW, Kelurahan" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kota / Kabupaten</label>
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="Kota Domisili" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Catatan Asesmen / Kelayakan</label>
                <textarea name="eligibility_notes" rows="2" placeholder="Hasil survei kondisi ekonomi & urgensi bantuan" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('eligibility_notes') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                <a href="{{ route('mustahiqs.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
                    Simpan Data Mustahiq
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
