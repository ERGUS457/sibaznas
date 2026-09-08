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
        /* FORMAL CORPORATE & INSTITUTIONAL DESIGN SYSTEM            */
        /* ========================================================= */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Formal Cards */
        .maxi-card, .clay-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .maxi-card:hover, .clay-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -2px rgba(0, 0, 0, 0.04);
        }

        .maxi-card-soft, .clay-card-soft {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .maxi-sidebar, .clay-sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            box-shadow: none;
        }

        .maxi-topbar, .clay-topbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        }

        /* Formal Buttons */
        .maxi-btn-emerald, .clay-btn-emerald {
            background: #047857;
            color: #ffffff;
            border: 1px solid #047857;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-emerald:hover, .clay-btn-emerald:hover {
            background: #065f46;
            border-color: #065f46;
        }
        .maxi-btn-emerald:active, .clay-btn-emerald:active {
            transform: scale(0.99);
        }

        .maxi-btn-sky, .clay-btn-sky {
            background: #0f172a;
            color: #ffffff;
            border: 1px solid #0f172a;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-sky:hover, .clay-btn-sky:hover {
            background: #1e293b;
            border-color: #1e293b;
        }
        .maxi-btn-sky:active, .clay-btn-sky:active {
            transform: scale(0.99);
        }

        .maxi-btn-white, .clay-btn-white {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-white:hover, .clay-btn-white:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #94a3b8;
        }
        .maxi-btn-white:active, .clay-btn-white:active {
            transform: scale(0.99);
        }

        .maxi-btn-rose, .clay-btn-rose {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-rose:hover, .clay-btn-rose:hover {
            background: #fef2f2;
            border-color: #f87171;
            color: #b91c1c;
        }
        .maxi-btn-rose:active, .clay-btn-rose:active {
            transform: scale(0.99);
        }

        .maxi-input, .clay-input {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-shadow: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .maxi-input:focus, .clay-input:focus {
            outline: none;
            border-color: #047857;
            box-shadow: 0 0 0 2px rgba(4, 120, 87, 0.15);
        }

        .maxi-pill, .clay-pill, .maxi-badge {
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: none;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm 12mm 12mm 12mm;
            }

            /* 1. Root & Viewport Reset: Crucial for multi-page pagination without clipping in Chromium */
            html,
            body {
                height: auto !important;
                min-height: 0 !important;
                max-height: none !important;
                overflow: visible !important;
                overflow-x: visible !important;
                overflow-y: visible !important;
                position: static !important;
                background: #ffffff !important;
                background-image: none !important;
                color: #000000 !important;
                font-family: 'Times New Roman', Times, Georgia, serif !important;
                font-size: 10pt !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* 2. Structural Unwrapping: Unwrap only layout wrappers without overriding utility or hiding classes */
            body > div:not(.no-print),
            .min-h-screen,
            .h-full,
            main:not(.no-print) {
                display: block !important;
                height: auto !important;
                min-height: 0 !important;
                max-height: none !important;
                overflow: visible !important;
                overflow-x: visible !important;
                overflow-y: visible !important;
                position: static !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                float: none !important;
                flex: none !important;
                background: transparent !important;
            }

            .max-w-4xl:not(.no-print),
            .max-w-5xl:not(.no-print),
            .max-w-6xl:not(.no-print),
            .max-w-7xl:not(.no-print) {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .space-y-6:not(.no-print) {
                margin: 0 !important;
                padding: 0 !important;
            }

            .space-y-6:not(.no-print) > :not(.no-print) {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }

            /* 3. Official Report Sheet Print Rules */
            .report-sheet,
            .bsz-card {
                display: block !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                background: #ffffff !important;
                color: #000000 !important;
                font-family: 'Times New Roman', Times, Georgia, serif !important;
                font-size: 9.5pt !important;
                line-height: 1.25 !important;
            }

            /* 4. Table Pagination & Avoid Bad Breaks */
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                page-break-inside: auto !important;
            }

            thead {
                display: table-header-group !important;
            }

            tfoot {
                display: table-footer-group !important;
            }

            tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }

            td, th {
                padding-top: 1.5px !important;
                padding-bottom: 1.5px !important;
            }

            /* 5. Headers & Signature Blocks */
            h1, h2, h3, h4, h5, h6 {
                page-break-after: avoid !important;
            }

            .signature-block,
            .signature-section,
            .signatures {
                page-break-inside: avoid !important;
                page-break-before: auto !important;
                margin-top: 16px !important;
                padding-top: 8px !important;
            }

            /* 6. ABSOLUTE HIDING OF UI & NON-PRINT ELEMENTS (DECLARED LAST) */
            .no-print,
            .no-print *,
            [class*="no-print"],
            .print\:hidden,
            aside,
            header,
            nav,
            footer,
            button,
            form,
            input,
            select,
            [x-cloak],
            .backdrop-blur-xs {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                width: 0 !important;
                min-height: 0 !important;
                max-height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                position: absolute !important;
                left: -99999px !important;
                top: -99999px !important;
                overflow: hidden !important;
                pointer-events: none !important;
            }

            .print-only {
                display: block !important;
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
            <div class="h-16 px-5 border-b border-slate-200 flex items-center justify-between bg-white">
                @if($isIsak35)
                    <a href="{{ route('dashboard.isak35') }}" class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-white text-base font-semibold shadow-xs">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">AKUNTANSI NONLABA</span>
                            <span class="text-[10px] font-semibold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">DE ISAK 35 FORMAT A</span>
                        </div>
                    </a>
                @elseif($isBaznas)
                    <a href="{{ route('dashboard.baznas') }}" class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-700 flex items-center justify-center text-white text-base font-semibold shadow-xs">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">PENGELOLAAN ZAKAT</span>
                            <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">PERBAZNAS 2/2016</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('portal') }}" class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-slate-900 flex items-center justify-center text-white text-base font-semibold shadow-xs">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">SIM-ORGANISASI</span>
                            <span class="text-[10px] font-semibold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">PORTAL MULTI-MODUL</span>
                        </div>
                    </a>
                @endif
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Active Organization Badge & Switcher Trigger -->
            @if(isset($currentOrganization) && $currentOrganization)
            <div class="px-4 py-2.5 border-b border-slate-200 bg-slate-50/50">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 flex items-center justify-between mb-1">
                    <span>Ruang Kerja Aktif</span>
                    <a href="{{ route('organizations.index') }}" class="text-emerald-700 hover:text-emerald-900 font-semibold text-[10px] flex items-center gap-1">
                        <span>Ganti</span>
                        <i class="fa-solid fa-arrow-right-arrow-left text-[9px]"></i>
                    </a>
                </div>
                <a href="{{ route('organizations.index') }}" class="flex items-center gap-2.5 text-slate-800 hover:text-slate-950 group">
                    <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs font-bold flex-shrink-0 group-hover:bg-emerald-200 transition">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div class="truncate">
                        <span class="font-bold text-xs block truncate text-slate-900">{{ $currentOrganization->name }}</span>
                        <span class="text-[10px] text-slate-500 font-medium truncate block">Kode: {{ $currentOrganization->code }} &bull; {{ ucfirst(str_replace('_', ' ', $currentOrganization->institution_type ?? 'UPZ')) }}</span>
                    </div>
                </a>
            </div>
            @endif

            <!-- Workspace Switcher Button -->
            <div class="p-3 border-b border-slate-200 bg-slate-50/70">
                <a href="{{ route('portal') }}" class="clay-btn-white w-full py-1.5 px-3 text-xs font-semibold flex items-center justify-between text-slate-700 hover:text-slate-900">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left text-slate-400 text-[11px]"></i>
                        <span>Kembali ke Portal</span>
                    </span>
                    <span class="text-[10px] uppercase font-semibold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">Ganti Modul</span>
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

                <!-- Entitas Organisasi & UPZ -->
                <div class="pt-4 border-t border-slate-100">
                    <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                        <span>Organisasi / UPZ</span>
                        <span class="text-[9px] bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded font-bold">Multi-Entitas</span>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('organizations.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('organizations.index') ? 'clay-card-soft font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-building-user w-4 text-center {{ request()->routeIs('organizations.index') ? 'text-emerald-700' : 'text-slate-400' }}"></i>
                            <span>Kelola Organisasi</span>
                        </a>
                        <a href="{{ route('organizations.create') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('organizations.create') ? 'clay-card-soft font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-plus w-4 text-center {{ request()->routeIs('organizations.create') ? 'text-emerald-700' : 'text-slate-400' }}"></i>
                            <span>+ Daftarkan Baru</span>
                        </a>
                    </div>
                </div>

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
            <!-- Top App Bar (Formal Corporate) -->
            <header class="px-4 sm:px-8 pt-4 pb-2 no-print sticky top-0 z-10 bg-slate-50/80 backdrop-blur-xs">
                <div class="clay-topbar px-5 py-2.5 flex items-center justify-between border border-slate-200 bg-white shadow-xs">
                    <div class="flex items-center space-x-3">
                        <button @click="sidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-lg hover:bg-slate-100">
                            <i class="fa-solid fa-bars text-sm"></i>
                        </button>
                        <div class="flex items-center space-x-2 text-xs">
                            <a href="{{ route('portal') }}" class="clay-btn-white px-2.5 py-1 text-xs font-semibold flex items-center gap-1.5 text-slate-700 hover:text-slate-900">
                                <i class="fa-solid fa-grip text-slate-400"></i>
                                <span class="hidden sm:inline">Portal</span>
                            </a>
                            <span class="text-slate-300">/</span>
                            @if($isIsak35)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 font-semibold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-700"></span>
                                    <span>Modul: Akuntansi DE ISAK 35</span>
                                </span>
                            @elseif($isBaznas)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 font-semibold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    <span>Modul: Pengelolaan Zakat BAZNAS</span>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <!-- Organization Switcher Dropdown (Alpine.js) -->
                        @if(isset($currentOrganization) && $currentOrganization)
                        <div class="relative" x-data="{ orgOpen: false }">
                            <button @click="orgOpen = !orgOpen" @click.away="orgOpen = false" type="button" 
                                    class="clay-btn-white px-2.5 py-1.5 text-xs font-semibold flex items-center gap-1.5 text-slate-700 hover:text-slate-900 border-slate-200">
                                <i class="fa-solid fa-building-shield text-emerald-700 text-[11px]"></i>
                                <span class="max-w-[120px] sm:max-w-[190px] truncate font-bold text-slate-800">{{ $currentOrganization->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[9px] text-slate-400"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="orgOpen" x-cloak 
                                 class="absolute right-0 mt-1.5 w-72 rounded-xl bg-white border border-slate-200 shadow-xl py-2 z-50 text-xs">
                                <div class="px-3 py-1.5 border-b border-slate-100 flex items-center justify-between">
                                    <span class="font-bold text-[10px] text-slate-400 uppercase tracking-wider">Ruang Kerja Aktif</span>
                                    <a href="{{ route('organizations.index') }}" class="text-[11px] text-emerald-700 hover:underline font-semibold">Kelola</a>
                                </div>
                                <div class="max-h-60 overflow-y-auto py-1">
                                    @foreach($availableOrganizations ?? [] as $availOrg)
                                    <form action="{{ route('organizations.switch', $availOrg->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full px-3 py-2 text-left flex items-center justify-between hover:bg-slate-50 transition {{ $availOrg->id === $currentOrganization->id ? 'bg-emerald-50/70 font-bold text-emerald-950' : 'text-slate-700' }}">
                                            <div class="truncate mr-2">
                                                <div class="truncate text-xs">{{ $availOrg->name }}</div>
                                                <div class="text-[10px] text-slate-400 font-normal">{{ $availOrg->code }} &bull; {{ ucfirst(str_replace('_', ' ', $availOrg->institution_type)) }}</div>
                                            </div>
                                            @if($availOrg->id === $currentOrganization->id)
                                                <i class="fa-solid fa-check text-emerald-600 text-xs flex-shrink-0"></i>
                                            @endif
                                        </button>
                                    </form>
                                    @endforeach
                                </div>
                                <div class="px-3 pt-2 border-t border-slate-100">
                                    <a href="{{ route('organizations.create') }}" class="w-full py-1.5 px-2.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-semibold flex items-center justify-center gap-1.5 text-xs transition">
                                        <i class="fa-solid fa-plus text-[10px]"></i>
                                        <span>+ Daftarkan Organisasi Baru</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($isBaznas)
                            <a href="{{ route('collections.create') }}" class="clay-btn-emerald text-xs font-semibold px-3 py-1.5 flex items-center space-x-1.5">
                                <i class="fa-solid fa-plus text-[11px]"></i>
                                <span>Input BSZ</span>
                            </a>
                        @elseif($isIsak35)
                            <a href="{{ route('reports.financial-position') }}" class="clay-btn-sky text-xs font-semibold px-3 py-1.5 flex items-center space-x-1.5">
                                <i class="fa-solid fa-scale-balanced text-[11px]"></i>
                                <span>Posisi Keuangan</span>
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline sm:hidden">
                            @csrf
                            <button type="submit" class="clay-btn-rose p-1.5 text-xs" title="Keluar">
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
