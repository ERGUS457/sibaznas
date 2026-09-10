@extends('layouts.app')

@section('title', 'Edit Pengguna — ' . $user->name)

@section('content')
<div class="space-y-6 max-w-3xl mx-auto" x-data="{ showPass: false, showConfirmPass: false }">

    {{-- Breadcrumb & Header --}}
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('admin.users.index') }}" class="hover:text-emerald-700 transition">Manajemen Pengguna</a>
                <span>&rsaquo;</span>
                <span class="text-slate-800 font-semibold">Edit Pengguna</span>
            </div>
            <h1 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-user-pen text-emerald-700"></i>
                <span>Edit Data Pengguna: {{ $user->name }}</span>
            </h1>
        </div>
        <a href="{{ route('admin.users.index') }}" class="clay-btn-white text-xs font-semibold px-3 py-2 flex items-center gap-1.5">
            <i class="fa-solid fa-arrow-left text-[11px]"></i>
            <span>Kembali</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
            <div class="font-bold flex items-center gap-1.5">
                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                <span>Terdapat beberapa kesalahan pengisian:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 ml-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section 1: Profil Pengguna --}}
        <div class="clay-card p-6 space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <i class="fa-solid fa-id-badge text-emerald-700 text-sm"></i>
                <h3 class="font-bold text-sm text-slate-800">Informasi Akun Pengguna</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Nama Lengkap --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>

                {{-- Username --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>

                {{-- Email --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>

                {{-- Phone --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">No. WhatsApp / Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           placeholder="081234567890"
                           class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                </div>
            </div>
        </div>

        {{-- Section 2: Peran, Organisasi & Status --}}
        <div class="clay-card p-6 space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                <i class="fa-solid fa-building-shield text-emerald-700 text-sm"></i>
                <h3 class="font-bold text-sm text-slate-800">Afiliasi Organisasi & Hak Akses</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Role --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Peran / Role <span class="text-red-500">*</span></label>
                    <select name="role" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600">
                        <option value="superadmin" {{ old('role', $user->role) === 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        <option value="pengurus_upz" {{ old('role', $user->role) === 'pengurus_upz' ? 'selected' : '' }}>Pengurus Organisasi</option>
                        <option value="akuntan" {{ old('role', $user->role) === 'akuntan' ? 'selected' : '' }}>Akuntan</option>
                        <option value="baznas_supervisor" {{ old('role', $user->role) === 'baznas_supervisor' ? 'selected' : '' }}>Supervisor / Pengawas Organisasi</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Status Akun <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600">
                        <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Aktif (Disetujui)</option>
                        <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi (Pending)</option>
                        <option value="rejected" {{ old('status', $user->status) === 'rejected' ? 'selected' : '' }}>Dinonaktifkan / Ditolak (Rejected)</option>
                    </select>
                </div>

                {{-- Afiliasi Organisasi --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Afiliasi Organisasi</label>
                    <select name="upz_profile_id" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600">
                        <option value="">-- Tidak Terhubung / Independen --</option>
                        @foreach ($organizations as $org)
                            <option value="{{ $org->id }}" {{ old('upz_profile_id', $user->upz_profile_id) == $org->id ? 'selected' : '' }}>
                                {{ $org->name }} ({{ $org->code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Section 3: Reset Kata Sandi (Dengan Ikon Mata) --}}
        <div class="clay-card p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-key text-emerald-700 text-sm"></i>
                    <h3 class="font-bold text-sm text-slate-800">Reset Kata Sandi Pengguna</h3>
                </div>
                <span class="text-[11px] text-slate-400 font-medium italic">Kosongkan jika tidak ingin mengubah password</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Password Baru --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Password Baru</label>
                    <div class="relative">
                        <input :type="showPass ? 'text' : 'password'" name="password"
                               placeholder="Minimal 8 karakter"
                               class="w-full pl-3 pr-10 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <button type="button" @click="showPass = !showPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-700">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input :type="showConfirmPass ? 'text' : 'password'" name="password_confirmation"
                               placeholder="Ulangi password baru"
                               class="w-full pl-3 pr-10 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">
                        <button type="button" @click="showConfirmPass = !showConfirmPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <i class="fa-solid" :class="showConfirmPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.users.index') }}" class="clay-btn-white px-5 py-2.5 text-xs font-bold text-slate-700">
                Batal
            </a>
            <button type="submit" class="clay-btn-emerald px-6 py-2.5 text-xs font-bold flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection
