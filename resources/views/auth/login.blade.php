<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sistem - SIM-UPZ BAZNAS &amp; ISAK 35</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #eef2f7;
            background-image: 
                radial-gradient(at 15% 20%, rgba(16, 185, 129, 0.12) 0px, transparent 50%),
                radial-gradient(at 85% 80%, rgba(14, 165, 233, 0.12) 0px, transparent 50%);
        }

        /* Claymorphism Core Styles */
        .clay-card {
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 
                16px 20px 36px rgba(160, 175, 200, 0.28),
                -12px -12px 28px rgba(255, 255, 255, 0.95),
                inset 2px 2px 4px rgba(255, 255, 255, 0.9),
                inset -3px -4px 8px rgba(160, 175, 200, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .clay-input {
            background: #f1f5f9;
            border-radius: 18px;
            border: 1px solid rgba(203, 213, 225, 0.7);
            box-shadow: 
                inset 3px 3px 6px rgba(160, 175, 200, 0.25),
                inset -2px -2px 6px rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease;
        }
        .clay-input:focus {
            outline: none;
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 
                0 0 0 4px rgba(16, 185, 129, 0.18),
                inset 2px 2px 4px rgba(160, 175, 200, 0.1);
        }

        .clay-btn-emerald {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            border-radius: 18px;
            box-shadow: 
                6px 10px 20px rgba(5, 150, 105, 0.35),
                -4px -4px 12px rgba(255, 255, 255, 0.9),
                inset 2px 2px 4px rgba(255, 255, 255, 0.45),
                inset -2px -3px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.15s ease-in-out;
        }
        .clay-btn-emerald:hover {
            box-shadow: 
                8px 12px 24px rgba(5, 150, 105, 0.42),
                -5px -5px 14px rgba(255, 255, 255, 0.95),
                inset 2px 2px 4px rgba(255, 255, 255, 0.55),
                inset -2px -3px 6px rgba(0, 0, 0, 0.25);
            transform: translateY(-1px);
        }
        .clay-btn-emerald:active {
            transform: translateY(2px) scale(0.98);
            box-shadow: 
                2px 4px 8px rgba(5, 150, 105, 0.25),
                inset 3px 3px 6px rgba(0, 0, 0, 0.25);
        }

        .clay-pill-hint {
            background: #f8fafc;
            border-radius: 20px;
            box-shadow: 
                4px 6px 12px rgba(160, 175, 200, 0.18),
                -3px -3px 8px rgba(255, 255, 255, 0.9),
                inset 1px 1px 3px rgba(255, 255, 255, 0.8),
                inset -2px -2px 4px rgba(160, 175, 200, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

    <div class="w-full max-w-md space-y-5">

        <!-- Claymorphic Login Card -->
        <div class="clay-card p-7 sm:p-9 space-y-6">

            <!-- Logo & Brand Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white text-2xl shadow-lg mb-1" style="box-shadow: 6px 8px 16px rgba(16, 185, 129, 0.35), inset 2px 2px 4px rgba(255,255,255,0.4), inset -2px -3px 6px rgba(0,0,0,0.2);">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">SIM-UPZ BAZNAS</h1>
                <p class="text-xs font-semibold text-emerald-700 bg-emerald-50 py-1 px-3 rounded-full inline-block border border-emerald-200">
                    DE ISAK 35 FORMAT A &bull; PERBAZNAS 2/2016
                </p>
                <p class="text-xs text-slate-500 pt-1">Silakan masuk untuk mengakses panel kerja amil &amp; akuntansi</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base flex-shrink-0"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4" id="loginForm">
                @csrf

                <!-- Username Input -->
                <div class="space-y-1.5">
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider pl-1">
                        Username / ID Pengguna
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username', 'admin') }}" 
                            required 
                            autofocus
                            placeholder="admin"
                            class="clay-input w-full pl-11 pr-4 py-3 text-sm text-slate-800 font-medium placeholder-slate-400 focus:outline-none">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider pl-1">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            value="admin123"
                            required
                            placeholder="••••••••"
                            class="clay-input w-full pl-11 pr-4 py-3 text-sm text-slate-800 font-medium placeholder-slate-400 focus:outline-none">
                    </div>
                </div>

                <!-- Remember Me & Reset -->
                <div class="flex items-center justify-between text-xs pt-1 px-1">
                    <label class="flex items-center space-x-2 text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                        <span class="font-medium">Ingat Sesi Saya</span>
                    </label>
                    <span class="text-slate-400">Hak Akses: Administrator</span>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="clay-btn-emerald w-full py-3.5 px-4 font-bold text-sm flex items-center justify-center space-x-2 tracking-wide mt-2">
                    <span>Masuk ke Panel Kerja</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Quick Auto-Fill Credential Box (Clay Pill) -->
            <div class="clay-pill-hint p-4 text-xs space-y-2">
                <div class="flex items-center justify-between text-slate-500 font-semibold border-b border-slate-200/60 pb-1.5">
                    <span class="flex items-center gap-1.5 text-slate-700">
                        <i class="fa-solid fa-key text-amber-500"></i>
                        <span>Kredensial Login Default:</span>
                    </span>
                    <span class="text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-bold">Siap Pakai</span>
                </div>
                <div class="grid grid-cols-2 gap-2 pt-1 font-mono text-[11px]">
                    <div class="bg-white/80 p-2 rounded-xl border border-slate-200/60">
                        <span class="text-[10px] text-slate-400 block">Username</span>
                        <strong class="text-slate-800 font-bold">admin</strong>
                    </div>
                    <div class="bg-white/80 p-2 rounded-xl border border-slate-200/60">
                        <span class="text-[10px] text-slate-400 block">Password</span>
                        <strong class="text-slate-800 font-bold">admin123</strong>
                    </div>
                </div>
                <button 
                    type="button" 
                    onclick="fillAdminCredentials()"
                    class="w-full text-center text-[11px] text-emerald-700 hover:text-emerald-800 font-bold hover:underline pt-0.5">
                    <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> Isi Otomatis Kredensial Ini
                </button>
            </div>

        </div>

        <!-- Back to Landing Page Link -->
        <div class="text-center">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-800 transition">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Beranda / Modul Penggunaan</span>
            </a>
        </div>

    </div>

    <script>
        function fillAdminCredentials() {
            document.getElementById('username').value = 'admin';
            document.getElementById('password').value = 'admin123';
        }
    </script>
</body>
</html>
