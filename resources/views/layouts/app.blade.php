<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM-UPZ BAZNAS & ISAK 35')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #eef2f7;
            background-image: 
                radial-gradient(at 10% 15%, rgba(16, 185, 129, 0.08) 0px, transparent 40%),
                radial-gradient(at 90% 85%, rgba(14, 165, 233, 0.08) 0px, transparent 40%);
        }

        /* Claymorphism Theme Styles */
        .clay-card {
            background: #ffffff;
            border-radius: 26px;
            box-shadow: 
                14px 18px 36px rgba(160, 175, 200, 0.25),
                -10px -10px 24px rgba(255, 255, 255, 0.95),
                inset 2px 2px 5px rgba(255, 255, 255, 0.9),
                inset -3px -4px 8px rgba(160, 175, 200, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.85);
            transition: all 0.2s ease-in-out;
        }

        .clay-sidebar {
            background: #ffffff;
            box-shadow: 
                12px 0 30px rgba(160, 175, 200, 0.2),
                inset -2px 0 6px rgba(160, 175, 200, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.9);
        }

        .clay-topbar {
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 
                8px 12px 24px rgba(160, 175, 200, 0.2),
                -6px -6px 18px rgba(255, 255, 255, 0.95),
                inset 2px 2px 4px rgba(255, 255, 255, 0.9),
                inset -2px -3px 6px rgba(160, 175, 200, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        .clay-card-soft {
            background: #f8fafc;
            border-radius: 18px;
            box-shadow: 
                6px 8px 18px rgba(160, 175, 200, 0.18),
                -4px -4px 12px rgba(255, 255, 255, 0.9),
                inset 2px 2px 3px rgba(255, 255, 255, 0.85),
                inset -2px -2px 5px rgba(160, 175, 200, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        .clay-btn-emerald {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            border-radius: 16px;
            box-shadow: 
                5px 8px 18px rgba(5, 150, 105, 0.35),
                -3px -3px 10px rgba(255, 255, 255, 0.9),
                inset 2px 2px 4px rgba(255, 255, 255, 0.45),
                inset -2px -3px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.15s ease-in-out;
        }
        .clay-btn-emerald:hover {
            transform: translateY(-1px);
            box-shadow: 
                7px 11px 22px rgba(5, 150, 105, 0.42),
                -4px -4px 12px rgba(255, 255, 255, 0.95),
                inset 2px 2px 4px rgba(255, 255, 255, 0.55),
                inset -2px -3px 5px rgba(0, 0, 0, 0.25);
        }
        .clay-btn-emerald:active {
            transform: translateY(2px) scale(0.98);
            box-shadow: 
                2px 3px 6px rgba(5, 150, 105, 0.25),
                inset 3px 3px 6px rgba(0, 0, 0, 0.25);
        }

        .clay-btn-white {
            background: #ffffff;
            color: #1e293b;
            border-radius: 16px;
            box-shadow: 
                5px 8px 16px rgba(160, 175, 200, 0.2),
                -3px -3px 10px rgba(255, 255, 255, 0.95),
                inset 2px 2px 3px rgba(255, 255, 255, 0.9),
                inset -2px -2px 5px rgba(160, 175, 200, 0.1);
            transition: all 0.15s ease-in-out;
        }
        .clay-btn-white:hover {
            transform: translateY(-1px);
            box-shadow: 
                7px 10px 20px rgba(160, 175, 200, 0.25),
                -4px -4px 12px rgba(255, 255, 255, 0.98);
        }
        .clay-btn-white:active {
            transform: translateY(2px) scale(0.98);
            box-shadow: 
                2px 3px 6px rgba(160, 175, 200, 0.15),
                inset 3px 3px 5px rgba(160, 175, 200, 0.18);
        }

        .clay-btn-rose {
            background: #fff1f2;
            color: #be123c;
            border-radius: 14px;
            box-shadow: 
                4px 6px 12px rgba(244, 63, 94, 0.15),
                -2px -2px 8px rgba(255, 255, 255, 0.9),
                inset 1px 1px 3px rgba(255, 255, 255, 0.8),
                inset -2px -2px 4px rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(254, 205, 211, 0.7);
            transition: all 0.15s ease;
        }
        .clay-btn-rose:hover {
            background: #ffe4e6;
            color: #9f1239;
        }

        .clay-pill {
            border-radius: 9999px;
            box-shadow: 
                3px 4px 8px rgba(160, 175, 200, 0.16),
                -2px -2px 6px rgba(255, 255, 255, 0.9),
                inset 1px 1px 2px rgba(255, 255, 255, 0.7),
                inset -1px -2px 3px rgba(160, 175, 200, 0.1);
        }

        .clay-input {
            background: #f1f5f9;
            border-radius: 16px;
            border: 1px solid rgba(203, 213, 225, 0.7);
            box-shadow: 
                inset 3px 3px 6px rgba(160, 175, 200, 0.25),
                inset -2px -2px 6px rgba(255, 255, 255, 0.9);
            transition: all 0.2s ease;
        }
        .clay-input:focus {
            background: #ffffff;
            border-color: #10b981;
            box-shadow: 
                0 0 0 4px rgba(16, 185, 129, 0.18),
                inset 2px 2px 4px rgba(160, 175, 200, 0.1);
        }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white !important; font-size: 11pt; color: #000 !important; }
            .clay-card, .clay-card-soft { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>
</head>
<body class="h-full flex flex-col font-sans text-slate-800 antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex h-full min-h-screen">
        <!-- Backdrop for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-slate-900/30 backdrop-blur-xs lg:hidden no-print"></div>

        <!-- Sidebar Navigation (Claymorphic Panel) -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 clay-sidebar text-slate-700 flex flex-col flex-shrink-0 transition-transform duration-200 ease-in-out no-print">
            
            <!-- Header Brand -->
            <div class="h-20 px-5 border-b border-slate-100 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-lg font-bold shadow-md" style="box-shadow: 4px 6px 14px rgba(16, 185, 129, 0.35), inset 1px 1px 3px rgba(255,255,255,0.4), inset -2px -2px 4px rgba(0,0,0,0.2);">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-slate-900 text-sm tracking-tight block">SIM-UPZ BAZNAS</span>
                        <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">DE ISAK 35 FORMAT A</span>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links (Claymorphic) -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-6 text-xs">
                <!-- Nav Section: Menu Utama -->
                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-2xl {{ request()->routeIs('dashboard') ? 'clay-card-soft font-extrabold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }} transition">
                        <i class="fa-solid fa-gauge-high w-4 text-center {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="{{ route('landing') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl text-slate-500 hover:bg-slate-50 hover:text-slate-800 font-medium transition">
                        <i class="fa-solid fa-compass w-4 text-center text-slate-400"></i>
                        <span>Landing Page &amp; Panduan</span>
                    </a>
                </div>

                <!-- Modul 1: Operasional UPZ -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                        <span>Operasional UPZ</span>
                        <span class="text-[9px] bg-emerald-100/80 text-emerald-800 px-1.5 py-0.5 rounded-md font-bold">Perbaznas 2/2016</span>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('collections.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('collections.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-receipt w-4 text-center {{ request()->routeIs('collections.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Penerimaan ZIS &amp; BSZ</span>
                        </a>
                        <a href="{{ route('distributions.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('distributions.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-parachute-box w-4 text-center {{ request()->routeIs('distributions.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Penyaluran (8 Asnaf)</span>
                        </a>
                        <a href="{{ route('remittances.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('remittances.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-building-columns w-4 text-center {{ request()->routeIs('remittances.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Setoran ke BAZNAS</span>
                        </a>
                        <a href="{{ route('muzakkis.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('muzakkis.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-users w-4 text-center {{ request()->routeIs('muzakkis.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Data Muzaki</span>
                        </a>
                        <a href="{{ route('mustahiqs.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('mustahiqs.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-people-roof w-4 text-center {{ request()->routeIs('mustahiqs.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Data Mustahik</span>
                        </a>
                    </div>
                </div>

                <!-- Modul 2: Akuntansi Keuangan & Laporan ISAK 35 -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                        <span>Akuntansi &amp; ISAK 35</span>
                        <span class="text-[9px] bg-sky-100/80 text-sky-800 px-1.5 py-0.5 rounded-md font-bold">Format A</span>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('journals.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('journals.*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-book-journal-whills w-4 text-center {{ request()->routeIs('journals.*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Jurnal &amp; Buku Besar</span>
                        </a>
                        <a href="{{ route('reports.financial-position') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.financial-position') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-scale-balanced w-4 text-center {{ request()->routeIs('reports.financial-position') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Posisi Keuangan</span>
                        </a>
                        <a href="{{ route('reports.comprehensive-income') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.comprehensive-income') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-chart-line w-4 text-center {{ request()->routeIs('reports.comprehensive-income') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Penghasilan Komprehensif</span>
                        </a>
                        <a href="{{ route('reports.net-assets') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.net-assets') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-layer-group w-4 text-center {{ request()->routeIs('reports.net-assets') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Perubahan Aset Neto</span>
                        </a>
                        <a href="{{ route('reports.cash-flow') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.cash-flow') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-money-bill-transfer w-4 text-center {{ request()->routeIs('reports.cash-flow') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Laporan Arus Kas</span>
                        </a>
                        <a href="{{ route('reports.perbaznas-compliance') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas*') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-stamp w-4 text-center {{ request()->routeIs('reports.perbaznas*') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Laporan UPZ (Perbaznas)</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Sidebar Footer: Active User Profile & Logout -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/70 space-y-3">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center font-extrabold text-xs shadow-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden flex-1">
                        <div class="text-xs font-bold text-slate-800 truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-emerald-700 font-semibold truncate">{{ auth()->user()->username ?? 'admin' }} &bull; Superadmin</div>
                    </div>
                </div>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="clay-btn-rose w-full py-1.5 px-3 text-xs font-bold flex items-center justify-center space-x-1.5">
                        <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Top App Bar (Claymorphic) -->
            <header class="px-4 sm:px-8 pt-4 pb-2 no-print sticky top-0 z-10">
                <div class="clay-topbar px-5 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button @click="sidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-xl hover:bg-slate-100">
                            <i class="fa-solid fa-bars text-base"></i>
                        </button>
                        <div class="hidden sm:flex items-center space-x-2 text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 font-bold clay-pill">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Neon PostgreSQL Terhubung</span>
                            </span>
                            <span class="text-slate-400">&bull;</span>
                            <span class="font-medium text-slate-600">{{ $upz->name ?? 'UPZ BAZNAS' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <a href="{{ route('collections.create') }}" class="clay-btn-emerald text-xs font-bold px-3.5 py-2 flex items-center space-x-1.5">
                            <i class="fa-solid fa-plus text-[11px]"></i>
                            <span>Input Penerimaan</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline sm:hidden">
                            @csrf
                            <button type="submit" class="clay-btn-rose p-2 text-xs" title="Keluar">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Flash Alerts -->
            @if(session('success'))
            <div class="mx-4 sm:mx-8 mt-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center space-x-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-base leading-none font-bold">&times;</button>
            </div>
            @endif

            @if(session('error'))
            <div class="mx-4 sm:mx-8 mt-3 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-center justify-between shadow-sm no-print">
                <div class="flex items-center space-x-2.5">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-base leading-none font-bold">&times;</button>
            </div>
            @endif

            <!-- Body View -->
            <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="px-4 sm:px-8 py-5 text-center text-xs text-slate-400 no-print flex flex-col sm:flex-row justify-between items-center gap-2">
                <span>SIM-UPZ BAZNAS &bull; Terintegrasi DE ISAK 35 FORMAT A</span>
                <span>Regulasi: Perbaznas No. 2/2016</span>
            </footer>
        </div>
    </div>
</body>
</html>
