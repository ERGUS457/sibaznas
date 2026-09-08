@extends('layouts.app')

@section('title', 'Edit Profil Organisasi - ' . $organization->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-1">
                <a href="{{ route('portal') }}" class="hover:text-slate-800">Portal</a>
                <span>/</span>
                <a href="{{ route('organizations.index') }}" class="hover:text-slate-800">Organisasi</a>
                <span>/</span>
                <span class="text-slate-700">Edit Profil</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Edit Profil: {{ $organization->name }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Perbarui identitas legal, susunan pengurus, rekening bank, serta persentase hak amil organisasi ini.
            </p>
        </div>
        <a href="{{ route('organizations.index') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-slate-400"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('organizations.update', $organization->id) }}" method="POST" class="clay-card p-6 sm:p-8 space-y-8 bg-white">
        @csrf
        @method('PUT')

        <!-- Section 1: Profil & Identitas Organisasi -->
        <div>
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-200 mb-5">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">1. Identitas &amp; Legalitas Organisasi</h3>
                    <p class="text-[11px] text-slate-500">Nama resmi entitas dan status hubungan dengan BAZNAS</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="sm:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1">
                        Nama Lengkap Organisasi / Entitas / Perusahaan <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $organization->name) }}" required 
                           class="maxi-input w-full px-3 py-2 text-xs font-medium">
                    @error('name')
                        <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Kode Organisasi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="code" value="{{ old('code', $organization->code) }}" required 
                           class="maxi-input w-full px-3 py-2 text-xs font-mono uppercase">
                    @error('code')
                        <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Jenis Entitas / Tipe Lembaga <span class="text-rose-500">*</span>
                    </label>
                    <select name="institution_type" required class="maxi-input w-full px-3 py-2 text-xs bg-white">
                        <option value="perusahaan_swasta" {{ old('institution_type', $organization->institution_type) == 'perusahaan_swasta' ? 'selected' : '' }}>Perusahaan Swasta (PT / CV)</option>
                        <option value="yayasan" {{ old('institution_type', $organization->institution_type) == 'yayasan' ? 'selected' : '' }}>Yayasan / Lembaga Nonlaba</option>
                        <option value="instansi_pemerintah" {{ old('institution_type', $organization->institution_type) == 'instansi_pemerintah' ? 'selected' : '' }}>Instansi Pemerintah / Kementerian / Dinas</option>
                        <option value="bumn_bumd" {{ old('institution_type', $organization->institution_type) == 'bumn_bumd' ? 'selected' : '' }}>BUMN / BUMD</option>
                        <option value="lembaga_pendidikan" {{ old('institution_type', $organization->institution_type) == 'lembaga_pendidikan' ? 'selected' : '' }}>Lembaga Pendidikan / Universitas / Sekolah</option>
                        <option value="masjid" {{ old('institution_type', $organization->institution_type) == 'masjid' ? 'selected' : '' }}>Masjid / DKM</option>
                        <option value="komunitas" {{ old('institution_type', $organization->institution_type) == 'komunitas' ? 'selected' : '' }}>Komunitas / Asosiasi</option>
                        <option value="lainnya" {{ old('institution_type', $organization->institution_type) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Tingkat BAZNAS Pembina <span class="text-rose-500">*</span>
                    </label>
                    <select name="parent_baznas_level" required class="maxi-input w-full px-3 py-2 text-xs bg-white">
                        <option value="kab_kota" {{ old('parent_baznas_level', $organization->parent_baznas_level) == 'kab_kota' ? 'selected' : '' }}>BAZNAS Kabupaten / Kota</option>
                        <option value="provinsi" {{ old('parent_baznas_level', $organization->parent_baznas_level) == 'provinsi' ? 'selected' : '' }}>BAZNAS Provinsi</option>
                        <option value="pusat" {{ old('parent_baznas_level', $organization->parent_baznas_level) == 'pusat' ? 'selected' : '' }}>BAZNAS RI (Pusat)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Nama BAZNAS Pembina <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="parent_baznas_name" value="{{ old('parent_baznas_name', $organization->parent_baznas_name) }}" required 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Nomor SK Pembentukan UPZ
                    </label>
                    <input type="text" name="sk_number" value="{{ old('sk_number', $organization->sk_number) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Tanggal SK</label>
                        <input type="date" name="sk_date" value="{{ old('sk_date', $organization->sk_date ? $organization->sk_date->format('Y-m-d') : '') }}" 
                               class="maxi-input w-full px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Masa Berlaku SK</label>
                        <input type="date" name="sk_valid_until" value="{{ old('sk_valid_until', $organization->sk_valid_until ? $organization->sk_valid_until->format('Y-m-d') : '') }}" 
                               class="maxi-input w-full px-3 py-2 text-xs">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Struktur Pengurus & Rekening Bank -->
        <div>
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-200 mb-5">
                <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-800 flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">2. Pengurus UPZ &amp; Rekening Penampungan</h3>
                    <p class="text-[11px] text-slate-500">Pejabat penanggung jawab dan rekening bank penampung dana ZIS</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Ketua / Pimpinan</label>
                    <input type="text" name="chairman_name" value="{{ old('chairman_name', $organization->chairman_name) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Sekretaris</label>
                    <input type="text" name="secretary_name" value="{{ old('secretary_name', $organization->secretary_name) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Bendahara</label>
                    <input type="text" name="treasurer_name" value="{{ old('treasurer_name', $organization->treasurer_name) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Bank Penampungan</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $organization->bank_name) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Rekening</label>
                    <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $organization->bank_account_number) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Atas Nama Rekening</label>
                    <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $organization->bank_account_name) }}" 
                           class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Persentase Hak Amil (%) <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" max="12.50" name="amil_share_percentage" 
                           value="{{ old('amil_share_percentage', $organization->amil_share_percentage) }}" required 
                           class="maxi-input w-full px-3 py-2 text-xs font-semibold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">
                        Status Keaktifan <span class="text-rose-500">*</span>
                    </label>
                    <select name="is_active" required class="maxi-input w-full px-3 py-2 text-xs bg-white">
                        <option value="1" {{ old('is_active', $organization->is_active) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !old('is_active', $organization->is_active) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Section 3: Alamat & Kontak -->
        <div>
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-200 mb-5">
                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">3. Domisili &amp; Kontak</h3>
                    <p class="text-[11px] text-slate-500">Alamat sekretariat dan kontak resmi organisasi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="sm:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Kantor / Sekretariat</label>
                    <textarea name="address" rows="2" class="maxi-input w-full px-3 py-2 text-xs">{{ old('address', $organization->address) }}</textarea>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kota / Kabupaten</label>
                    <input type="text" name="city" value="{{ old('city', $organization->city) }}" class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Provinsi</label>
                    <input type="text" name="province" value="{{ old('province', $organization->province) }}" class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ old('phone', $organization->phone) }}" class="maxi-input w-full px-3 py-2 text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Alamat Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $organization->email) }}" class="maxi-input w-full px-3 py-2 text-xs">
                </div>
            </div>
        </div>

        <!-- Submit Button Banner -->
        <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-2">
            <a href="{{ route('organizations.index') }}" class="clay-btn-white px-4 py-2 text-xs font-semibold">
                Batal
            </a>
            <button type="submit" class="clay-btn-emerald px-6 py-2 text-xs font-bold flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection
