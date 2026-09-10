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
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

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
                    <label for="password" class="block text-xs font-semibold text-slate-700">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            value="admin123"
                            required
                            placeholder="••••••••"
                            class="w-full pl-9 pr-3.5 py-2 text-sm text-slate-900 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700/20 focus:border-emerald-700 transition">
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

</body>
</html>
