<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sistem - SIM-UPZ BAZNAS &amp; ISAK 35</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js & SweetAlert2 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6" x-data="{ showPass: false, showForgotModal: false }">

    <div class="w-full max-w-md space-y-6">

        <!-- Formal Login Card -->
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-7 sm:p-8 space-y-6">

            <!-- Logo & Brand Header -->
            <div class="text-center space-y-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SIM-UPZ BAZNAS" class="w-16 h-16 rounded-xl object-contain bg-white border border-slate-200 p-1 shadow-xs mx-auto mb-1">
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">SIM-UPZ BAZNAS</h1>
                <div class="inline-block text-[11px] font-semibold text-emerald-800 bg-emerald-50 py-0.5 px-2.5 rounded border border-emerald-200">
                    DE ISAK 35 FORMAT A &bull; PERBAZNAS 2/2016
                </div>
                <p class="text-xs text-slate-500 font-normal">Silakan masuk untuk mengakses portal kerja amil &amp; akuntansi</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
            <div class="p-3.5 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-start space-x-2.5">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm mt-0.5 flex-shrink-0"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4" id="loginForm">
                @csrf

                <!-- Username Input -->
                <div class="space-y-1.5">
                    <label for="username" class="block text-xs font-semibold text-slate-700">
                        Username / ID Pengguna
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-user text-xs"></i>
                        </span>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username', 'admin') }}" 
                            required 
                            autofocus
                            placeholder="admin"
                            class="w-full pl-9 pr-3.5 py-2 text-sm text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-semibold text-slate-700">
                            Kata Sandi
                        </label>
                        <button type="button" @click="showForgotModal = true" class="text-[11px] font-semibold text-emerald-700 hover:text-emerald-800 hover:underline transition">
                            Lupa Kata Sandi?
                        </button>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </span>
                        <input 
                            :type="showPass ? 'text' : 'password'" 
                            id="password" 
                            name="password" 
                            value="admin123"
                            required
                            placeholder="••••••••"
                            class="w-full pl-9 pr-10 py-2 text-sm text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
                        <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none" tabindex="-1" title="Lihat/Sembunyikan Kata Sandi">
                            <i class="fa-solid text-xs" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Reset -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded text-emerald-700 focus:ring-emerald-700 border-slate-300">
                        <span>Ingat Sesi Saya</span>
                    </label>
                    <span class="text-slate-400">Hak Akses: Administrator</span>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition shadow-xs flex items-center justify-center space-x-2 mt-2">
                    <span>Masuk ke Panel Kerja</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Quick Auto-Fill Credential Box -->
            <div class="p-3.5 text-xs space-y-2 bg-slate-50 border border-slate-200 rounded-lg">
                <div class="flex items-center justify-between text-slate-700 font-semibold border-b border-slate-200 pb-1.5">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-key text-slate-400 text-xs"></i>
                        <span>Kredensial Login Default:</span>
                    </span>
                    <span class="text-[10px] bg-slate-200 text-slate-700 px-1.5 py-0.5 rounded font-medium">Siap Pakai</span>
                </div>
                <div class="grid grid-cols-2 gap-2 pt-1 font-mono text-xs">
                    <div class="bg-white p-2 rounded border border-slate-200">
                        <span class="text-[10px] text-slate-400 block uppercase font-sans">Username</span>
                        <strong class="text-slate-800">admin</strong>
                    </div>
                    <div class="bg-white p-2 rounded border border-slate-200">
                        <span class="text-[10px] text-slate-400 block uppercase font-sans">Password</span>
                        <strong class="text-slate-800">admin123</strong>
                    </div>
                </div>
                <div class="text-center pt-0.5 text-[11px] text-slate-500">
                    Klik tombol <strong>Masuk</strong> langsung untuk login otomatis
                </div>
            </div>

            <!-- Registration Card Section -->
            <div class="pt-3 border-t border-slate-200 text-center space-y-2.5">
                <div class="text-xs text-slate-600 font-medium">
                    Belum memiliki akun organisasi / UPZ?
                </div>
                <a href="{{ route('register.step1') }}" 
                   class="w-full py-2.5 px-4 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold transition border border-emerald-300 flex items-center justify-center gap-2 shadow-xs">
                    <i class="fa-solid fa-building-user text-xs"></i>
                    <span>Daftarkan Organisasi Baru</span>
                </a>
            </div>

            <!-- Footer links -->
            <div class="text-center pt-1">
                <a href="{{ route('landing') }}" class="text-xs font-medium text-slate-500 hover:text-slate-800 flex items-center justify-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Landing Page</span>
                </a>
            </div>

        </div>

        <p class="text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} SIM-UPZ BAZNAS &bull; Terintegrasi DE ISAK 35
        </p>

    </div>

    <!-- Modal Lupa Kata Sandi (Kirim Pesan ke Admin) -->
    <div x-show="showForgotModal" 
         x-cloak
         style="display: none;"
         @keydown.escape.window="showForgotModal = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
        <div @click.away="showForgotModal = false" 
             class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-100 relative space-y-4">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-key text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Lupa Kata Sandi?</h3>
                        <p class="text-[11px] text-slate-500">Kirim pesan bantuan ke Administrator</p>
                    </div>
                </div>
                <button type="button" @click="showForgotModal = false" class="text-slate-400 hover:text-slate-600 rounded-lg p-1 transition">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <p class="text-xs text-slate-600 leading-relaxed">
                Sampaikan data akun dan pesan kendala Anda. Administrator BAZNAS akan memverifikasi permohonan Anda dan membantu mereset kata sandi.
            </p>

            <form method="POST" action="{{ route('password.request.send') }}" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap / Pengurus <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Nama Anda / Pengurus UPZ"
                           class="w-full px-3 py-2 text-xs text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Username atau Alamat Email <span class="text-rose-500">*</span></label>
                    <input type="text" name="username_or_email" required placeholder="contoh: upz_alikhlas atau email@lembaga.org"
                           class="w-full px-3 py-2 text-xs text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">No. WhatsApp / HP Aktif</label>
                    <input type="text" name="phone" placeholder="08xxxxxxxxxx (untuk konfirmasi dari admin)"
                           class="w-full px-3 py-2 text-xs text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Pesan / Kendala Login <span class="text-rose-500">*</span></label>
                    <textarea name="message" rows="3" required placeholder="Jelaskan nama organisasi/UPZ Anda dan kendala lupa password yang dialami..."
                              class="w-full px-3 py-2 text-xs text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition resize-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" @click="showForgotModal = false" class="px-3.5 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 rounded-lg shadow-sm transition flex items-center gap-1.5">
                        <i class="fa-solid fa-paper-plane text-[10px]"></i>
                        <span>Kirim Pesan ke Admin</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Permohonan Terkirim!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#059669',
                confirmButtonText: 'OK, Saya Mengerti'
            });
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Tutup'
            });
        });
    </script>
    @endif

</body>
</html>
