<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — SIBAZNAS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .clay-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
        .btn-primary {
            background: #059669; color: #fff; border-radius: 10px; padding: 10px 24px;
            font-weight: 600; border: none; cursor: pointer; transition: background 0.2s;
        }
        .btn-primary:hover { background: #047857; }
        .btn-secondary {
            background: #fff; color: #374151; border-radius: 10px; padding: 10px 24px;
            font-weight: 600; border: 1.5px solid #d1d5db; cursor: pointer; transition: all 0.2s;
        }
        .btn-secondary:hover { border-color: #9ca3af; background: #f9fafb; }
        .form-input {
            width: 100%; padding: 10px 14px; border: 1.5px solid #d1d5db;
            border-radius: 10px; font-size: 15px; transition: border-color 0.2s;
            background: #fff;
        }
        .form-input:focus { outline: none; border-color: #059669; box-shadow: 0 0 0 3px rgba(5,150,105,0.1); }
        .form-input.error { border-color: #ef4444; }
        .step-active { background: #059669; color: #fff; }
        .step-done { background: #d1fae5; color: #059669; border: 2px solid #059669; }
        .step-inactive { background: #f3f4f6; color: #9ca3af; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-lg">

        {{-- Header --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SIBAZNAS" class="w-16 h-16 rounded-2xl object-contain bg-white border border-slate-200 p-1 shadow-md mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">SIBAZNAS</h1>
            <p class="text-gray-500 text-sm mt-1">Sistem Informasi Baznas — Pendaftaran Organisasi</p>
        </div>

        {{-- Step Indicator --}}
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-active">1</div>
                <span class="text-sm font-semibold text-emerald-700">Data Akun</span>
            </div>
            <div class="h-px w-12 bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-inactive">2</div>
                <span class="text-sm text-gray-400">Data Organisasi</span>
            </div>
            <div class="h-px w-12 bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-inactive">3</div>
                <span class="text-sm text-gray-400">Selesai</span>
            </div>
        </div>

        {{-- Card --}}
        <div class="clay-card p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-1">Buat Akun Baru</h2>
            <p class="text-gray-500 text-sm mb-6">Langkah 1 dari 2 — Isi data akun pengguna Anda</p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-circle-exclamation text-red-500 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan pada input:</p>
                            <ul class="text-sm text-red-600 space-y-0.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register.step1.submit') }}" class="space-y-5" x-data="{ showPass: false, showConfirmPass: false }">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Nama lengkap sesuai KTP"
                           class="form-input {{ $errors->has('name') ? 'error' : '' }}">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" value="{{ old('username') }}"
                               placeholder="contoh: ahmad_upz"
                               class="form-input {{ $errors->has('username') ? 'error' : '' }}">
                        @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               placeholder="08xxxxxxxxxx"
                               class="form-input {{ $errors->has('phone') ? 'error' : '' }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="email@organisasi.or.id"
                           class="form-input {{ $errors->has('email') ? 'error' : '' }}">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input :type="showPass ? 'text' : 'password'" name="password"
                               placeholder="Minimal 8 karakter"
                               class="form-input pr-10 {{ $errors->has('password') ? 'error' : '' }}">
                        <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" tabindex="-1" title="Lihat/Sembunyikan Kata Sandi">
                            <i class="fa-solid text-sm" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input :type="showConfirmPass ? 'text' : 'password'" name="password_confirmation"
                               placeholder="Ulangi password"
                               class="form-input pr-10">
                        <button type="button" @click="showConfirmPass = !showConfirmPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none" tabindex="-1" title="Lihat/Sembunyikan Konfirmasi Kata Sandi">
                            <i class="fa-solid text-sm" :class="showConfirmPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full">
                        Lanjut ke Data Organisasi <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-emerald-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>
