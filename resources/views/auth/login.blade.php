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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            background-image: 
                radial-gradient(#94a3b8 1.2px, transparent 1.2px),
                radial-gradient(at 10% 15%, rgba(16, 185, 129, 0.15) 0px, transparent 40%),
                radial-gradient(at 90% 85%, rgba(2, 132, 199, 0.15) 0px, transparent 40%);
            background-size: 24px 24px, 100% 100%, 100% 100%;
        }

        /* Maximalist Core Styles */
        .maxi-card {
            background: #ffffff;
            border: 3px solid #0f172a;
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px #0f172a;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .maxi-input {
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 14px;
            box-shadow: 3px 3px 0px 0px #0f172a;
            transition: all 0.15s ease;
        }
        .maxi-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 4px 4px 0px 0px #10b981;
        }

        .maxi-btn-emerald {
            background: #10b981;
            color: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 16px;
            font-weight: 800;
            box-shadow: 4px 4px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-emerald:hover {
            background: #059669;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #0f172a;
        }
        .maxi-btn-emerald:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-badge {
            border: 2px solid #0f172a;
            border-radius: 9999px;
            font-weight: 800;
            box-shadow: 2px 2px 0px 0px #0f172a;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

    <div class="w-full max-w-md space-y-5">

        <!-- Maximalist Login Card -->
        <div class="maxi-card p-7 sm:p-9 space-y-6">

            <!-- Logo & Brand Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-500 text-white text-2xl font-black border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] mb-1">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase">SIM-UPZ BAZNAS</h1>
                <p class="text-xs font-black text-emerald-950 bg-emerald-100 py-1 px-3 maxi-badge inline-block">
                    DE ISAK 35 FORMAT A &bull; PERBAZNAS 2/2016
                </p>
                <p class="text-xs text-slate-600 font-medium pt-1">Silakan masuk untuk mengakses portal kerja amil &amp; akuntansi</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
            <div class="p-3.5 rounded-xl bg-rose-100 border-2 border-rose-950 text-rose-950 text-xs flex items-center space-x-2.5 font-bold shadow-[3px_3px_0px_0px_#0f172a]">
                <i class="fa-solid fa-circle-exclamation text-rose-700 text-base flex-shrink-0"></i>
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
                    <label for="username" class="block text-xs font-black text-slate-800 uppercase tracking-wider pl-1">
                        Username / ID Pengguna
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-600">
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
                            class="maxi-input w-full pl-11 pr-4 py-3 text-sm text-slate-900 font-bold placeholder-slate-400">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-black text-slate-800 uppercase tracking-wider pl-1">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-600">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            value="admin123"
                            required
                            placeholder="••••••••"
                            class="maxi-input w-full pl-11 pr-4 py-3 text-sm text-slate-900 font-bold placeholder-slate-400">
                    </div>
                </div>

                <!-- Remember Me & Reset -->
                <div class="flex items-center justify-between text-xs pt-1 px-1">
                    <label class="flex items-center space-x-2 text-slate-700 cursor-pointer select-none font-bold">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-2 border-slate-900">
                        <span>Ingat Sesi Saya</span>
                    </label>
                    <span class="text-slate-500 font-bold">Hak Akses: Administrator</span>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="maxi-btn-emerald w-full py-3.5 px-4 font-black text-sm flex items-center justify-center space-x-2 uppercase tracking-wide mt-2">
                    <span>Masuk ke Panel Kerja</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Quick Auto-Fill Credential Box (Sticker Card) -->
            <div class="p-4 text-xs space-y-2 bg-amber-50 border-2 border-slate-900 rounded-2xl shadow-[4px_4px_0px_0px_#0f172a]">
                <div class="flex items-center justify-between text-slate-800 font-black border-b-2 border-slate-900 pb-1.5">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-key text-amber-600"></i>
                        <span class="uppercase">Kredensial Login Default:</span>
                    </span>
                    <span class="text-[10px] bg-emerald-200 text-emerald-950 px-2 py-0.5 maxi-badge">Siap Pakai</span>
                </div>
                <div class="grid grid-cols-2 gap-2 pt-1 font-mono text-[11px]">
                    <div class="bg-white p-2 rounded-xl border-2 border-slate-900">
                        <span class="text-[10px] font-bold text-slate-500 block uppercase">Username</span>
                        <strong class="text-slate-900 font-black">admin</strong>
                    </div>
                    <div class="bg-white p-2 rounded-xl border-2 border-slate-900">
                        <span class="text-[10px] font-bold text-slate-500 block uppercase">Password</span>
                        <strong class="text-slate-900 font-black">admin123</strong>
                    </div>
                </div>
                <div class="text-center pt-1 text-[11px] text-slate-600 font-semibold">
                    Klik tombol <strong>Masuk</strong> langsung untuk login otomatis
                </div>
            </div>

            <!-- Footer links -->
            <div class="text-center pt-2">
                <a href="{{ route('landing') }}" class="text-xs font-bold text-slate-600 hover:text-black flex items-center justify-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-left text-[11px]"></i>
                    <span>Kembali ke Landing Page</span>
                </a>
            </div>

        </div>

    </div>

</body>
</html>
