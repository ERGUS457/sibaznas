@extends('layouts.app')

@section('title', 'Registrasi Muzakki Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Registrasi Muzakki Baru</h1>
            <p class="text-xs text-slate-500">Mendaftarkan data muzakki perorangan maupun lembaga/korporasi ke database UPZ.</p>
        </div>
        <a href="{{ route('muzakkis.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <form method="POST" action="{{ route('muzakkis.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="upz_profile_id" value="{{ $upz->id }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tipe Muzakki <span class="text-rose-500">*</span></label>
                    <select name="type" required class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="individu">Individu / Perorangan</option>
                        <option value="badan">Badan / Korporasi / Perusahaan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Muzakki atau Perusahaan" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-bold">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">NIK (Individu) atau NPWP (Badan)</label>
                    <input type="text" name="nik_or_npwp" value="{{ old('nik_or_npwp') }}" placeholder="16 digit NIK atau NPWP" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">NPWZ Resmi BAZNAS</label>
                    <input type="text" name="npwz" value="{{ old('npwz') }}" placeholder="Nomor Pokok Wajib Zakat (jika ada)" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Unit Kerja / Instansi</label>
                    <input type="text" name="workplace_or_agency" value="{{ old('workplace_or_agency') }}" placeholder="Divisi, departemen, atau cabang" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">No. Handphone / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08..." class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@domain.com" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Lengkap</label>
                <textarea name="address" rows="2" placeholder="Alamat domisili" class="w-full text-xs border border-slate-300 rounded-lg p-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">{{ old('address') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end space-x-3">
                <a href="{{ route('muzakkis.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium hover:bg-slate-50 transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-5 py-2.5 rounded-lg shadow-sm transition">
                    Simpan Data Muzakki
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
