<!DOCTYPE html>
<html lang="id" class="h-full dark:bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SILVER-ZIS')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <script>(function(){ try{ var v=localStorage.getItem('theme'); var m=window.matchMedia('(prefers-color-scheme: dark)').matches; if(v==='dark'||(!v&&m)) document.documentElement.classList.add('dark'); }catch(e){} })();</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .btn-primary:focus-visible, .btn-outline:focus-visible, button:focus-visible, a:focus-visible { outline:none; box-shadow:0 0 0 3px rgba(4,120,87,0.35); }
        .dark body{ background:#0f172a; color:#e2e8f0; }
        .dark header{ background:#0f172a; border-color:#334155; }
        .dark .bg-white{ background-color:#1e293b !important; border-color:#334155 !important; }
        .dark [class*="text-slate-900"]{ color:#f1f5f9 !important; }
        .dark [class*="text-slate-800"]{ color:#e2e8f0 !important; }
        .dark [class*="text-slate-700"]{ color:#cbd5e1 !important; }
        .dark [class*="text-slate-600"]{ color:#94a3b8 !important; }
        .dark [class*="text-slate-500"]{ color:#94a3b8 !important; }
        .dark [class*="bg-slate-50"]{ background-color:#1e293b !important; border-color:#334155 !important; color:#cbd5e1 !important; }
        .dark [class*="border-slate-200"]{ border-color:#334155 !important; }
        body {font-family: 'Plus Jakarta Sans', sans-serif; background:#f8fafc; color:#1e293b;}
    </style>
</head>
<body class="h-full flex flex-col antialiased bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100">
    <header class="flex items-center justify-between px-4 py-3 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700 gap-4">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SILVER-ZIS" class="w-8 h-8">
            <h1 class="text-base font-bold text-slate-900 dark:text-white">SILVER-ZIS</h1>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="document.documentElement.classList.toggle('dark'); try{localStorage.setItem('theme', document.documentElement.classList.contains('dark')?'dark':'light')}catch(e){}" class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs" title="Ganti tema" aria-label="Toggle dark mode"><i class="fa-solid fa-moon hidden dark:inline"></i><i class="fa-solid fa-sun dark:hidden text-amber-500"></i></button>
            <a href="{{ route('portal') }}" class="text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-slate-700 rounded-lg px-3 py-1.5 bg-white dark:bg-slate-800">Portal</a>
        </div>
    </header>
    <main class="flex-1 p-4 sm:p-6 max-w-4xl mx-auto w-full space-y-6">
        @yield('content')
    </main>
    <footer class="text-center text-xs text-slate-400 dark:text-slate-500 py-6">
        SILVER-ZIS &bull; Sistem Laporan Keuangan Nirlaba Terintegrasi ZIS
    </footer>
</body>
</html>
