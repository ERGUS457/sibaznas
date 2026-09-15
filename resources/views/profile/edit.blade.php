@extends('layouts.simple')

@section('title', 'Profil Organisasi & Akun')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Profil Organisasi &amp; Akun</h1>
            <p class="text-xs text-slate-500">Kelola informasi resmi lembaga, kode, nama, serta foto/logo organisasi.</p>
        </div>
    </div>

    @if($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Logo Section -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100">
                <div class="w-24 h-24 rounded-2xl border-2 border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-inner">
                    @if($upz->logo_path)
                        <img src="{!! $upz->logo_path ? $upz->logo_path : asset('images/logo.png') !!}" alt="Logo Organisasi" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-building text-3xl text-slate-300"></i>
                    @endif
                </div>
                <div class="space-y-2 text-center sm:text-left flex-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Logo / Foto Profil Organisasi</label>
                    <input type="file" name="logo" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    <p class="text-[11px] text-slate-400">Format JPG, PNG, atau WEBP maksimal 2MB. Tampil di landing page dan laporan resmi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Organisasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $upz->name) }}" required class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kode Organisasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $upz->code) }}" required class="w-full text-xs font-mono border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">{{ old('address', $upz->address) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kota / Kabupaten</label>
                    <input type="text" name="city" value="{{ old('city', $upz->city) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Provinsi</label>
                    <input type="text" name="province" value="{{ old('province', $upz->province) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $upz->phone) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $upz->email) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('portal') }}" class="clay-btn-white px-5 py-2.5 text-xs font-bold text-slate-600">Batal</a>
                <button type="submit" class="clay-btn-emerald px-6 py-2.5 text-xs font-bold">Simpan Perubahan Profil</button>
            </div>
        </form>
    </div>
</div>
@endsection
