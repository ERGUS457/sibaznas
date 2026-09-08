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
        /* ========================================================= */
        /* MAXIMALIST DESIGN SYSTEM (Bold Borders & Hard Shadows)    */
        /* ========================================================= */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            background-image: 
                radial-gradient(#94a3b8 1.2px, transparent 1.2px),
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.12) 0px, transparent 40%),
                radial-gradient(at 100% 100%, rgba(2, 132, 199, 0.12) 0px, transparent 40%);
            background-size: 24px 24px, 100% 100%, 100% 100%;
        }

        /* Maximalist Cards */
        .maxi-card, .clay-card {
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 20px;
            box-shadow: 5px 5px 0px 0px #0f172a;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .maxi-card:hover, .clay-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px 0px #0f172a;
        }

        .maxi-card-soft, .clay-card-soft {
            background: #f8fafc;
            border: 2px solid #1e293b;
            border-radius: 16px;
            box-shadow: 3px 3px 0px 0px #1e293b;
        }

        .maxi-sidebar, .clay-sidebar {
            background: #ffffff;
            border-right: 3px solid #0f172a;
            box-shadow: 4px 0px 0px 0px rgba(15, 23, 42, 0.08);
        }

        .maxi-topbar, .clay-topbar {
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 18px;
            box-shadow: 4px 4px 0px 0px #0f172a;
        }

        /* Maximalist Buttons */
        .maxi-btn-emerald, .clay-btn-emerald {
            background: #10b981;
            color: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 14px;
            font-weight: 800;
            box-shadow: 4px 4px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-emerald:hover, .clay-btn-emerald:hover {
            background: #059669;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #0f172a;
        }
        .maxi-btn-emerald:active, .clay-btn-emerald:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-btn-sky, .clay-btn-sky {
            background: #0284c7;
            color: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 14px;
            font-weight: 800;
            box-shadow: 4px 4px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-sky:hover, .clay-btn-sky:hover {
            background: #0369a1;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #0f172a;
        }
        .maxi-btn-sky:active, .clay-btn-sky:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-btn-white, .clay-btn-white {
            background: #ffffff;
            color: #0f172a;
            border: 2px solid #0f172a;
            border-radius: 14px;
            font-weight: 800;
            box-shadow: 3px 3px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-white:hover, .clay-btn-white:hover {
            background: #f1f5f9;
            transform: translate(-1px, -1px);
            box-shadow: 5px 5px 0px 0px #0f172a;
        }
        .maxi-btn-white:active, .clay-btn-white:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-btn-rose, .clay-btn-rose {
            background: #f43f5e;
            color: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 14px;
            font-weight: 800;
            box-shadow: 3px 3px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-rose:hover, .clay-btn-rose:hover {
            background: #e11d48;
            transform: translate(-1px, -1px);
            box-shadow: 5px 5px 0px 0px #0f172a;
        }
        .maxi-btn-rose:active, .clay-btn-rose:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-input, .clay-input {
            background: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 12px;
            box-shadow: 2px 2px 0px 0px #0f172a;
            transition: all 0.15s ease;
        }
        .maxi-input:focus, .clay-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 3px 3px 0px 0px #10b981;
        }

        .maxi-pill, .clay-pill {
            border: 2px solid #0f172a;
            border-radius: 9999px;
            box-shadow: 2px 2px 0px 0px #0f172a;
            font-weight: 800;
        }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { 
                background: white !important; 
                font-size: 11pt; 
                color: #000 !important; 
                font-family: 'Times New Roman', Times, Georgia, serif !important;
                background-image: none !important;
            }
            .maxi-card, .clay-card, .maxi-card-soft, .clay-card-soft { 
                box-shadow: none !important; 
                border: 1px solid #000000 !important; 
                background: #ffffff !important;
            }
        }
    </style>
</head>
<body class="h-full flex flex-col font-sans text-slate-800 antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex h-full min-h-screen">
        <!-- Backdrop for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-slate-900/30 backdrop-blur-xs lg:hidden no-print"></div>

@php
    $isIsak35 = request()->routeIs('dashboard.isak35') 
        || request()->routeIs('journals.*') 
        || request()->routeIs('reports.financial-position') 
        || request()->routeIs('reports.comprehensive-income') 
        || request()->routeIs('reports.net-assets') 
        || request()->routeIs('reports.cash-flow');

    $isBaznas = request()->routeIs('dashboard.baznas') 
        || request()->routeIs('collections.*') 
        || request()->routeIs('distributions.*') 
        || request()->routeIs('remittances.*') 
        || request()->routeIs('muzakkis.*') 
        || request()->routeIs('mustahiqs.*') 
        || request()->routeIs('reports.perbaznas*');
@endphp

        <!-- Sidebar Navigation (Claymorphic Panel) -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="fixed lg:static inset-y-0 left-0 z-50 w-72 clay-sidebar text-slate-700 flex flex-col flex-shrink-0 transition-transform duration-200 ease-in-out no-print">
            
            <!-- Header Brand -->
            <div class="h-20 px-5 border-b border-slate-100 flex items-center justify-between">
                @if($isIsak35)
                    <a href="{{ route('dashboard.isak35') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white text-lg font-bold shadow-md">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-slate-900 text-sm tracking-tight block">AKUNTANSI NONLABA</span>
                            <span class="text-[10px] font-bold text-sky-700 bg-sky-50 px-2 py-0.5 rounded-full border border-sky-200">DE ISAK 35 FORMAT A</span>
                        </div>
                    </a>
                @elseif($isBaznas)
                    <a href="{{ route('dashboard.baznas') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-lg font-bold shadow-md">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-slate-900 text-sm tracking-tight block">PENGELOLAAN ZAKAT</span>
                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">PERBAZNAS 2/2016</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('portal') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white text-lg font-bold shadow-md">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div>
                            <span class="font-extrabold text-slate-900 text-sm tracking-tight block">SIM-ORGANISASI</span>
                            <span class="text-[10px] font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded-full border border-slate-200">PORTAL MULTI-MODUL</span>
                        </div>
                    </a>
                @endif
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Workspace Switcher Button -->
            <div class="p-3 border-b border-slate-100 bg-slate-50/60">
                <a href="{{ route('portal') }}" class="clay-btn-white w-full py-2 px-3 text-xs font-bold flex items-center justify-between text-slate-700 hover:text-black">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left text-slate-400"></i>
                        <span>Kembali ke Portal</span>
                    </span>
                    <span class="text-[10px] uppercase font-bold text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded">Ganti Modul</span>
                </a>
            </div>

            <!-- Navigation Links (Claymorphic) -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-6 text-xs">
                
                @if($isIsak35)
                    <!-- ================= MODUL ISAK 35 MENU ================= -->
                    <div class="space-y-1">
                        <a href="{{ route('dashboard.isak35') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-2xl {{ request()->routeIs('dashboard.isak35') ? 'clay-card-soft font-extrabold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }} transition">
                            <i class="fa-solid fa-gauge-high w-4 text-center {{ request()->routeIs('dashboard.isak35') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                            <span>Dashboard ISAK 35</span>
                        </a>
                    </div>

                    <!-- Buku Akuntansi -->
                    <div>
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                            Pembukuan &amp; Jurnal
                        </div>
                        <div class="space-y-1">
                            <a href="{{ route('journals.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('journals.index') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-book-journal-whills w-4 text-center {{ request()->routeIs('journals.index') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Jurnal Umum</span>
                            </a>
                            <a href="{{ route('journals.ledger') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('journals.ledger') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-book w-4 text-center {{ request()->routeIs('journals.ledger') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Buku Besar Akun</span>
                            </a>
                            <a href="{{ route('journals.trial-balance') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('journals.trial-balance') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-list-check w-4 text-center {{ request()->routeIs('journals.trial-balance') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Neraca Saldo</span>
                            </a>
                        </div>
                    </div>

                    <!-- 4 Laporan Pokok DE ISAK 35 Format A -->
                    <div>
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                            <span>Laporan DE ISAK 35</span>
                            <span class="text-[9px] bg-sky-100 text-sky-800 px-1.5 py-0.5 rounded font-bold">Format A</span>
                        </div>
                        <div class="space-y-1">
                            <a href="{{ route('reports.financial-position') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.financial-position') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-scale-balanced w-4 text-center {{ request()->routeIs('reports.financial-position') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Posisi Keuangan</span>
                            </a>
                            <a href="{{ route('reports.comprehensive-income') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.comprehensive-income') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-chart-line w-4 text-center {{ request()->routeIs('reports.comprehensive-income') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Penghasilan Komprehensif</span>
                            </a>
                            <a href="{{ route('reports.net-assets') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.net-assets') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-layer-group w-4 text-center {{ request()->routeIs('reports.net-assets') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Perubahan Aset Neto</span>
                            </a>
                            <a href="{{ route('reports.cash-flow') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.cash-flow') ? 'clay-card-soft font-bold text-sky-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-money-bill-transfer w-4 text-center {{ request()->routeIs('reports.cash-flow') ? 'text-sky-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Arus Kas</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Switch to BAZNAS -->
                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('dashboard.baznas') }}" class="flex items-center justify-between p-3 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-100 transition font-bold text-[11px]">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-hand-holding-dollar text-emerald-600"></i>
                                <span>Ke Modul Zakat BAZNAS</span>
                            </span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                @else
                    <!-- ================= MODUL BAZNAS MENU ================= -->
                    <div class="space-y-1">
                        <a href="{{ route('dashboard.baznas') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-2xl {{ request()->routeIs('dashboard.baznas') ? 'clay-card-soft font-extrabold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold' }} transition">
                            <i class="fa-solid fa-gauge-high w-4 text-center {{ request()->routeIs('dashboard.baznas') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                            <span>Dashboard BAZNAS</span>
                        </a>
                    </div>

                    <!-- Operasional UPZ -->
                    <div>
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                            <span>Operasional UPZ</span>
                            <span class="text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">ZIS &amp; DSKL</span>
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

                    <!-- Laporan Peraturan BAZNAS No. 2/2016 -->
                    <div>
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                            <span>Laporan Perbaznas</span>
                            <span class="text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold">No. 2/2016</span>
                        </div>
                        <div class="space-y-1">
                            <a href="{{ route('reports.perbaznas-compliance') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas-compliance') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-stamp w-4 text-center {{ request()->routeIs('reports.perbaznas-compliance') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Ringkasan Kepatuhan</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran1') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-invoice w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran1') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Lampiran I: Penerimaan</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran2') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-contract w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran2') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Lampiran II: Asnaf</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran3') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-lines w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran3') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Lampiran III: Program</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran5') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-circle-check w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran5') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Lampiran V: Operasional</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran7') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-shield w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran7') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Lampiran VII: Penyaluran</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Switch to ISAK 35 -->
                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('dashboard.isak35') }}" class="flex items-center justify-between p-3 rounded-xl bg-sky-50 text-sky-800 border border-sky-200 hover:bg-sky-100 transition font-bold text-[11px]">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-book-journal-whills text-sky-600"></i>
                                <span>Ke Modul ISAK 35</span>
                            </span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endif

            </nav>

            <!-- Sidebar Footer: Active User Profile & Logout -->
            <div class="p-4 border-t border-slate-100 bg-slate-50/70 space-y-3">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900 text-white flex items-center justify-center font-extrabold text-xs shadow-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden flex-1">
                        <div class="text-xs font-bold text-slate-800 truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] text-slate-500 font-semibold truncate">{{ auth()->user()->username ?? 'admin' }} &bull; Superadmin</div>
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
                        <div class="flex items-center space-x-2 text-xs">
                            <a href="{{ route('portal') }}" class="clay-btn-white px-2.5 py-1 text-xs font-bold flex items-center gap-1.5 text-slate-700 hover:text-black">
                                <i class="fa-solid fa-grid-2 text-slate-400"></i>
                                <span class="hidden sm:inline">Portal</span>
                            </a>
                            <span class="text-slate-300">/</span>
                            @if($isIsak35)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-800 border border-sky-200 font-bold clay-pill">
                                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                                    <span>Modul: Akuntansi DE ISAK 35</span>
                                </span>
                            @elseif($isBaznas)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 font-bold clay-pill">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Modul: Pengelolaan Zakat BAZNAS</span>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        @if($isBaznas)
                            <a href="{{ route('collections.create') }}" class="clay-btn-emerald text-xs font-bold px-3.5 py-2 flex items-center space-x-1.5">
                                <i class="fa-solid fa-plus text-[11px]"></i>
                                <span>Input BSZ</span>
                            </a>
                        @elseif($isIsak35)
                            <a href="{{ route('reports.financial-position') }}" class="clay-btn-sky text-xs font-bold px-3.5 py-2 flex items-center space-x-1.5">
                                <i class="fa-solid fa-scale-balanced text-[11px]"></i>
                                <span>Posisi Keuangan</span>
                            </a>
                        @endif
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
