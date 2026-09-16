<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SILVER-ZIS')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
    <script>
        (function(){ try{ var s=localStorage.getItem('theme'); var m=window.matchMedia('(prefers-color-scheme: dark)').matches; if(s==='dark' || (!s && m)) document.documentElement.classList.add('dark'); }catch(e){} })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
        [x-cloak] { display: none !important; }
        /* ========================================================= */
        /* FORMAL CORPORATE & INSTITUTIONAL DESIGN SYSTEM            */
        /* Linear-inspired dark refinement + print-isolated paper   */
        /* ========================================================= */
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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
        .maxi-btn-emerald:hover, .clay-btn-emerald:hover { background: #065f46; border-color: #065f46; }
        .maxi-btn-sky, .clay-btn-sky {
            background: #0f172a;
            color: #ffffff;
            border: 1px solid #0f172a;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-sky:hover, .clay-btn-sky:hover { background: #1e293b; border-color: #1e293b; }
        .maxi-btn-white, .clay-btn-white {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-white:hover, .clay-btn-white:hover { background: #f8fafc; color: #0f172a; border-color: #94a3b8; }
        .maxi-btn-rose, .clay-btn-rose {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-rose:hover, .clay-btn-rose:hover { background: #fef2f2; border-color: #f87171; color: #b91c1c; }
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
        .clay-btn-emerald:focus-visible, .clay-btn-sky:focus-visible, .clay-btn-white:focus-visible, .clay-btn-rose:focus-visible,
        .maxi-btn-emerald:focus-visible, .maxi-btn-sky:focus-visible, .maxi-btn-white:focus-visible, .maxi-btn-rose:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.35);
        }
        .clay-btn-white:focus-visible, .maxi-btn-white:focus-visible { box-shadow: 0 0 0 3px rgba(148,163,184,0.45); }
        .clay-btn-sky:focus-visible, .maxi-btn-sky:focus-visible { box-shadow: 0 0 0 3px rgba(15,23,42,0.35); }
        .clay-btn-rose:focus-visible, .maxi-btn-rose:focus-visible { box-shadow: 0 0 0 3px rgba(244,63,94,0.35); }
        main > * + * { margin-top: 0.75rem; }

                /* ========== DARK MODE — Linear-inspired refined ========== */
        .dark body { background-color:#080c18; color:#e2e8f0; }
        .dark .clay-card, .dark .maxi-card { background:#111c2e; border-color:rgba(255,255,255,0.07); color:#e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.4); }
        .dark .clay-card:hover, .dark .maxi-card:hover { border-color:rgba(255,255,255,0.12); box-shadow:0 4px 12px rgba(0,0,0,0.35); }
        .dark .clay-sidebar, .dark .maxi-sidebar { background:#0b1220; border-color:rgba(255,255,255,0.06); }
        .dark .clay-topbar, .dark .maxi-topbar { background:#111c2e; border-color:rgba(255,255,255,0.07); }
        .dark .clay-card-soft, .dark .maxi-card-soft { background:#121e33; border-color:rgba(255,255,255,0.06); color:#e2e8f0; }
        .dark .clay-input, .dark .maxi-input { background:#0f1a2e; border-color:#23324d; color:#e2e8f0; }
        .dark .clay-input::placeholder, .dark .maxi-input::placeholder { color:#64748b; }
        .dark .clay-input:focus, .dark .maxi-input:focus { border-color:#047857; box-shadow:0 0 0 2px rgba(16,185,129,0.18); }
        /* Text utilities — scoped to not affect paper */
        .dark .maxi-card [class*="text-slate-900"], .dark .clay-card [class*="text-slate-900"],
        .dark .maxi-sidebar [class*="text-slate-900"], .dark aside [class*="text-slate-900"],
        .dark main [class*="text-slate-900"]:not(.report-sheet),
        .dark header [class*="text-slate-900"], .dark nav [class*="text-slate-900"] { color:#f1f5f9 !important; }
        .dark .maxi-card [class*="text-slate-800"], .dark .clay-card [class*="text-slate-800"],
        .dark aside [class*="text-slate-800"], .dark header [class*="text-slate-800"] { color:#e2e8f0 !important; }
        .dark .maxi-card [class*="text-slate-700"], .dark .clay-card [class*="text-slate-700"],
        .dark aside [class*="text-slate-700"], .dark header [class*="text-slate-700"] { color:#cbd5e1 !important; }
        .dark .maxi-card [class*="text-slate-600"], .dark .clay-card [class*="text-slate-600"],
        .dark aside [class*="text-slate-600"], .dark header [class*="text-slate-600"] { color:#94a3b8 !important; }
        .dark .maxi-card [class*="text-slate-500"], .dark .clay-card [class*="text-slate-500"],
        .dark aside [class*="text-slate-500"], .dark header [class*="text-slate-500"] { color:#94a3b8 !important; }
        /* Background overrides — only outside paper */
        .dark .clay-card[class*="bg-white"], .dark .maxi-card[class*="bg-white"],
        .dark aside [class*="bg-white"], .dark header [class*="bg-white"],
        .dark main [class*="bg-white"]:not(.report-sheet) { background-color:#111c2e !important; border-color:rgba(255,255,255,0.07) !important; }
        .dark .clay-card[class*="bg-slate-50"], .dark aside [class*="bg-slate-50"] { background-color:#121e33 !important; border-color:rgba(255,255,255,0.06) !important; color:#cbd5e1 !important; }
        .dark .clay-card[class*="bg-slate-100"], .dark aside [class*="bg-slate-100"], .dark header [class*="bg-slate-100"] { background-color:#1a2942 !important; color:#e2e8f0 !important; border-color:#23324d !important; }
        .dark aside [class*="border-slate-200"], .dark header [class*="border-slate-200"] { border-color:rgba(255,255,255,0.07) !important; }
        .dark aside [class*="border-slate-100"] { border-color:rgba(255,255,255,0.06) !important; }
        /* Semantic pills — dark variants (outside paper) */
        .dark aside [class*="bg-emerald-50"], .dark header [class*="bg-emerald-50"], .dark .clay-card [class*="bg-emerald-50"] { background:rgba(16,185,129,0.10) !important; border-color:rgba(16,185,129,0.22) !important; color:#6ee7b7 !important; }
        .dark aside [class*="bg-sky-50"], .dark header [class*="bg-sky-50"], .dark .clay-card [class*="bg-sky-50"] { background:rgba(14,165,233,0.10) !important; border-color:rgba(14,165,233,0.22) !important; color:#7dd3fc !important; }
        .dark [class*="text-emerald-800"], .dark [class*="text-emerald-700"] { color:#6ee7b7 !important; }
        .dark [class*="text-sky-800"], .dark [class*="text-sky-700"] { color:#7dd3fc !important; }
        /* Buttons in dark */
        .dark .clay-btn-white, .dark .maxi-btn-white { background:#1a2942; color:#e2e8f0; border-color:#23324d; }
        .dark .clay-btn-white:hover, .dark .maxi-btn-white:hover { background:#1e3350; color:#ffffff; border-color:#2d4a6b; }
        .dark .clay-btn-sky, .dark .maxi-btn-sky { background:#e2e8f0; color:#0b1220; border-color:#e2e8f0; }
        .dark .clay-btn-sky:hover, .dark .maxi-btn-sky:hover { background:#f1f5f9; border-color:#f1f5f9; }
        .dark .clay-btn-emerald, .dark .maxi-btn-emerald { background:#059669; border-color:#059669; }
        .dark .clay-btn-emerald:hover, .dark .maxi-btn-emerald:hover { background:#047857; border-color:#047857; }

        /* Report sheet MUST stay paper-white even in dark mode — floating paper effect (max specificity to beat generic dark rules) */
        html.dark body main .report-sheet.report-sheet.bg-white,
        html.dark body .report-sheet.report-sheet,
        html.dark main .report-sheet.report-sheet.bg-white,
        .dark main .report-sheet.report-sheet.bg-white,
        html.dark .report-sheet.report-sheet.bg-white,
        .dark .report-sheet.report-sheet.bg-white,
        html.dark body .bsz-card.bsz-card,
        html.dark main .bsz-card.bsz-card,
        .dark .bsz-card.bsz-card {
            background:#ffffff !important;
            background-color:#ffffff !important;
            color:#000000 !important;
            border-color:#cbd5e1 !important;
            box-shadow:0 8px 30px rgba(0,0,0,0.35) !important;
        }
        .dark .report-sheet * {
            border-color: #000000;
        }
        .dark .report-sheet .bg-black { background:#000000 !important; color:#ffffff !important; }
        .dark .report-sheet .bg-black * { color:#ffffff !important; }
        .dark .report-sheet table, .dark .report-sheet thead, .dark .report-sheet tbody, .dark .report-sheet tr, .dark .report-sheet th, .dark .report-sheet td {
            color:#000000 !important;
            border-color:#000000 !important;
        }
        .dark .report-sheet .bg-gray-100 { background:#f3f4f6 !important; color:#000 !important; }
        .dark .report-sheet .bg-gray-50 { background:#f9fafb !important; color:#000 !important; }
        .dark .report-sheet .text-gray-600, .dark .report-sheet .text-gray-500 { color:#4b5563 !important; }
        .dark .report-sheet [class*="text-slate-"] { color:#000 !important; }
        .dark .report-sheet .signature-block, .dark .report-sheet .signature-block * { color:#000 !important; }

        /* Responsive helpers */
        .report-sheet-wrapper { overflow-x:auto; -webkit-overflow-scrolling:touch; scrollbar-width:thin; }
        /* Sidebar scrollbar — thin, themed */
        aside nav::-webkit-scrollbar { width:6px; height:6px; }
        aside nav::-webkit-scrollbar-thumb { background:rgba(148,163,184,0.35); border-radius:9999px; }
        .dark aside nav::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.12); }
        .report-sheet-wrapper::-webkit-scrollbar { height:8px; }
        .report-sheet-wrapper::-webkit-scrollbar-thumb { background:rgba(148,163,184,0.45); border-radius:9999px; }
        .dark .report-sheet-wrapper::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.18); }
        .report-sheet { min-width: 640px; }
        @media (max-width: 640px) {
            .report-sheet { min-width: 520px; }
            main { padding-left: 0.75rem; padding-right: 0.75rem; }
        }

        .maxi-pill, .clay-pill, .maxi-badge {
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: none;
        }

        /* ===================== PRINT — force light paper ===================== */
        @media print {
            :root { color-scheme: light !important; }
            @page { size: A4 portrait; margin: 10mm 12mm 12mm 12mm; }
            html, body, html.dark, html.dark body, .dark body {
                height: auto !important; min-height:0 !important; max-height:none !important;
                overflow: visible !important; overflow-x:visible !important; overflow-y:visible !important;
                position: static !important;
                background: #ffffff !important; background-image:none !important;
                color: #000000 !important;
                font-family: 'Times New Roman', Times, Georgia, serif !important;
                font-size: 10pt !important;
                width:100% !important; margin:0 !important; padding:0 !important;
                -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important;
            }
            /* Reset dark surfaces for print — everything paper white */
            .dark .clay-card, .dark .maxi-card, .dark .clay-sidebar, .dark .maxi-sidebar,
            .dark .clay-topbar, .dark .maxi-topbar, .dark .clay-card-soft, .dark .maxi-card-soft,
            .dark .clay-input, .dark .maxi-input,
            .dark [class*="bg-white"], .dark [class*="bg-slate-50"], .dark [class*="bg-slate-100"],
            .clay-card, .maxi-card, .clay-sidebar, .maxi-sidebar {
                background: #ffffff !important; border-color:#e2e8f0 !important; color:#000000 !important; box-shadow:none !important;
            }
            .dark [class*="text-slate-"] { color:#000000 !important; }
            .dark [class*="bg-emerald-"], .dark [class*="bg-teal-"], .dark [class*="bg-amber-"], .dark [class*="bg-rose-"], .dark [class*="bg-sky-"], .dark [class*="bg-blue-"], .dark [class*="bg-indigo-"] {
                background:#f8fafc !important; border-color:#e2e8f0 !important; color:#000 !important;
            }
            body > div:not(.no-print), .min-h-screen, .h-full, main:not(.no-print) {
                display: block !important; height:auto !important; min-height:0 !important; max-height:none !important;
                overflow: visible !important; position: static !important; width:100% !important; max-width:100% !important;
                margin:0 !important; padding:0 !important; float:none !important; flex:none !important; background: transparent !important;
            }
            .max-w-4xl:not(.no-print), .max-w-5xl:not(.no-print), .max-w-6xl:not(.no-print), .max-w-7xl:not(.no-print) {
                max-width:100% !important; width:100% !important; margin:0 !important; padding:0 !important;
            }
            .space-y-6:not(.no-print) { margin:0 !important; padding:0 !important; }
            .space-y-6:not(.no-print) > :not(.no-print) { margin-top:0 !important; margin-bottom:0 !important; }
            .report-sheet, .bsz-card {
                display:block !important; border:none !important; box-shadow:none !important;
                padding:0 !important; margin:0 !important; width:100% !important; max-width:100% !important;
                min-width:0 !important;
                background:#ffffff !important; color:#000000 !important;
                font-family:'Times New Roman', Times, Georgia, serif !important; font-size:9.5pt !important; line-height:1.25 !important;
            }
            .report-sheet .bg-black { background:#000000 !important; color:#ffffff !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .report-sheet .bg-black * { color:#ffffff !important; }
            .report-sheet-wrapper { overflow: visible !important; }
            table { width:100% !important; border-collapse:collapse !important; page-break-inside:auto !important; }
            thead { display:table-header-group !important; }
            tfoot { display:table-footer-group !important; }
            tr { page-break-inside:avoid !important; page-break-after:auto !important; }
            td, th { padding-top:1.5px !important; padding-bottom:1.5px !important; }
            h1,h2,h3,h4,h5,h6 { page-break-after:avoid !important; color:#000 !important; }
            .signature-block, .signature-section, .signatures { page-break-inside:avoid !important; page-break-before:auto !important; margin-top:16px !important; padding-top:8px !important; }
            .no-print, .no-print *, [class*="no-print"], .print\:hidden, aside, header, nav, footer, button, form, input, select, [x-cloak], .backdrop-blur-xs {
                display:none !important; visibility:hidden !important; height:0 !important; width:0 !important; min-height:0 !important; max-height:0 !important;
                margin:0 !important; padding:0 !important; border:none !important; outline:none !important; box-shadow:none !important;
                position:absolute !important; left:-99999px !important; top:-99999px !important; overflow:hidden !important; pointer-events:none !important;
            }
            .print-only { display:block !important; }
        }
    </style>

</head>
<body class="h-full flex flex-col font-sans text-slate-800 antialiased dark:bg-slate-900 dark:text-slate-100" x-data="{ sidebarOpen: false }">
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
            <div class="h-16 px-5 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between bg-white dark:bg-slate-900">
                @if($isIsak35)
                    <a href="{{ route('dashboard.isak35') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo SILVER-ZIS" class="w-9 h-9 rounded-lg object-contain bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">AKUNTANSI NONLABA</span>
                            <span class="text-[10px] font-semibold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">STANDAR AKUNTANSI</span>
                        </div>
                    </a>
                @elseif($isBaznas)
                    <a href="{{ route('dashboard.baznas') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo SILVER-ZIS" class="w-9 h-9 rounded-lg object-contain bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">PENGELOLAAN ZAKAT</span>
                            <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">PERBAZNAS 2/2016</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('portal') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo SILVER-ZIS" class="w-9 h-9 rounded-lg object-contain bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                        <div>
                            <span class="font-bold text-slate-900 text-xs tracking-tight block">SILVER-ZIS</span>
                            <span class="text-[10px] font-semibold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">PORTAL MULTI-MODUL</span>
                        </div>
                    </a>
                @endif
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>


            {{-- User's Organization Badge --}}
            @php $userUpz = auth()->user()?->upzProfile; @endphp
            @if($userUpz)
            <div class="px-4 py-2.5 border-b border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                            <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Organisasi Saya</div>
                            <div class="flex items-center gap-2.5 text-slate-800">
                                @if($userUpz->logo_path)
                                    @if(str_starts_with($userUpz->logo_path, 'data:'))
                                    <img src="{!! $userUpz->logo_path !!}" alt="Logo Organisasi" class="w-7 h-7 rounded-lg object-cover bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                                    @else
                                    <img src="{{ asset($userUpz->logo_path) }}" alt="Logo Organisasi" class="w-7 h-7 rounded-lg object-cover bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0" onerror="this.style.display='none';document.getElementById('orgFallbackIcon').style.display='flex'">
                                    <div id="orgFallbackIcon" class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 border border-emerald-200 hidden items-center justify-center text-sm font-bold flex-shrink-0 shadow-xs" style="display:none">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    @endif
                                @else
                                <div class="w-7 h-7 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-sm font-bold flex-shrink-0 shadow-xs">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                @endif
                                <div class="truncate">
                                    <span class="font-bold text-xs block truncate text-slate-900">{{ $userUpz->name }}</span>
                                    <span class="text-[10px] text-slate-500 font-medium truncate block">{{ $userUpz->code }}</span>
                                </div>
                            </div>
                        </div>
                        @endif


            <div class="p-3 border-b border-slate-200 bg-slate-50/70">
                <a href="{{ route('portal') }}" class="clay-btn-white w-full py-1.5 px-3 text-xs font-semibold flex items-center justify-between text-slate-700 hover:text-slate-900">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left text-slate-400 text-[11px]"></i>
                        <span>Kembali ke Portal</span>
                    </span>
                    <span class="text-[10px] uppercase font-semibold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">Ganti Laporan</span>
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
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between gap-2">
                            <span class="truncate">Laporan DE ISAK 35</span>
                            <span class="text-[9px] bg-sky-100 text-sky-800 px-1.5 py-0.5 rounded font-bold flex-shrink-0 whitespace-nowrap">Format A</span>
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
                                <span>Ke Laporan Zakat BAZNAS</span>
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
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between gap-2">
                            <span class="truncate">Operasional UPZ</span>
                            <span class="text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold flex-shrink-0 whitespace-nowrap">ZIS &amp; DSKL</span>
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
                        <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between gap-2">
                            <span class="truncate">Laporan Perbaznas</span>
                            <span class="text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded font-bold flex-shrink-0 whitespace-nowrap">No. 2/2016</span>
                        </div>
                        <div class="space-y-1">
                            <a href="{{ route('reports.perbaznas-compliance') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas-compliance') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-stamp w-4 text-center {{ request()->routeIs('reports.perbaznas-compliance') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Ringkasan Kepatuhan</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran1') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran1') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-invoice w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran1') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Penerimaan</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran2') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran2') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-contract w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran2') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Asnaf</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran3') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran3') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-lines w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran3') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Program</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran5') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran5') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-circle-check w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran5') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Operasional</span>
                            </a>
                            <a href="{{ route('reports.perbaznas.lampiran7') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('reports.perbaznas.lampiran7') ? 'clay-card-soft font-bold text-emerald-800' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                                <i class="fa-solid fa-file-shield w-4 text-center {{ request()->routeIs('reports.perbaznas.lampiran7') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Laporan Penyaluran</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Switch to ISAK 35 -->
                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('dashboard.isak35') }}" class="flex items-center justify-between p-3 rounded-xl bg-sky-50 text-sky-800 border border-sky-200 hover:bg-sky-100 transition font-bold text-[11px]">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-book-journal-whills text-sky-600"></i>
                                <span>Ke Laporan ISAK 35</span>
                            </span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endif

                <!-- Admin Menu (Superadmin only) -->
                @if(auth()->user()?->isSuperAdmin())
                <div class="pt-4 border-t border-slate-100">
                    <div class="px-3 mb-2 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                        <span>Administrasi</span>
                    </div>
                    <div class="space-y-1">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3.5 py-2 rounded-2xl {{ request()->routeIs('admin.*') ? 'clay-card-soft font-bold text-slate-900' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} transition">
                            <i class="fa-solid fa-users-cog w-4 text-center {{ request()->routeIs('admin.*') ? 'text-emerald-700' : 'text-slate-400' }}"></i>
                            <span>Manajemen Pengguna</span>
                            @php $pendingCount = \App\Models\User::where('status', 'pending')->count(); @endphp
                            @if($pendingCount > 0)
                                <span class="ml-auto bg-amber-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </div>
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
                        <div class="text-[10px] text-slate-500 font-semibold truncate">
                            {{ auth()->user()->username ?? 'admin' }} &bull;
                            {{ match(auth()->user()->role ?? '') {
                                'superadmin' => 'Superadmin',
                                'pengurus_upz' => 'Pengurus UPZ',
                                'akuntan' => 'Akuntan',
                                'baznas_supervisor' => 'Supervisor BAZNAS',
                                default => 'Pengguna'
                            } }}
                        </div>
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
            <header class="px-3 sm:px-6 lg:px-8 pt-3 sm:pt-4 pb-2 no-print sticky top-0 z-10 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur supports-[backdrop-filter]:bg-slate-50/60">
                <div class="clay-topbar px-3 sm:px-5 py-2.5 flex flex-wrap items-center justify-between gap-2 border border-slate-200 bg-white shadow-xs dark:bg-slate-800 dark:border-slate-700">
                    <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                        <button @click="sidebarOpen = true" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-lg hover:bg-slate-100 flex-shrink-0">
                            <i class="fa-solid fa-bars text-sm"></i>
                        </button>
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 text-xs min-w-0">
                            <a href="{{ route('portal') }}" class="clay-btn-white px-2.5 py-1 text-xs font-semibold flex items-center gap-1.5 text-slate-700 hover:text-slate-900">
                                <i class="fa-solid fa-grip text-slate-400"></i>
                                <span class="hidden sm:inline">Portal</span>
                            </a>
                            <span class="text-slate-300">/</span>
                            @if($isIsak35)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-800 border border-slate-200 font-semibold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-700"></span>
                                    <span>Laporan: Akuntansi DE ISAK 35</span>
                                </span>
                            @elseif($isBaznas)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 font-semibold text-xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                    <span>Laporan: Pengelolaan Zakat BAZNAS</span>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3 justify-end">
                        <button type="button" onclick="document.documentElement.classList.toggle('dark'); try{localStorage.setItem('theme', document.documentElement.classList.contains('dark')?'dark':'light')}catch(e){}" class="clay-btn-white px-2 py-1.5 text-xs inline-flex items-center justify-center flex-shrink-0" title="Ganti tema" aria-label="Toggle dark mode">
                            <i class="fa-solid fa-moon hidden dark:inline"></i><i class="fa-solid fa-sun dark:hidden text-amber-500"></i>
                        </button>
                        {{-- User Organization Badge (simple, no switcher) --}}
                        @php $topbarUpz = auth()->user()?->upzProfile; @endphp
                        @if($topbarUpz)
                        <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700">
                            @if($topbarUpz->logo_path)
                                @if(str_starts_with($topbarUpz->logo_path, 'data:'))
                                    <img src="{!! $topbarUpz->logo_path !!}" alt="Logo Organisasi" class="w-5 h-5 rounded object-cover bg-white border border-slate-200 shadow-xs flex-shrink-0">
                                @else
                                    <img src="{{ asset($topbarUpz->logo_path) }}" alt="Logo Organisasi" class="w-5 h-5 rounded object-cover bg-white border border-slate-200 shadow-xs flex-shrink-0" onerror="this.style.display='none';document.getElementById('topbarFallbackIcon').style.display='flex'">
                                    <div id="topbarFallbackIcon" class="w-5 h-5 rounded bg-emerald-100 text-emerald-700 border border-emerald-200 hidden items-center justify-center text-xs font-bold shadow-xs" style="display:none">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                @endif
                            @else
                                <i class="fa-solid fa-building text-emerald-700 text-[11px]"></i>
                            @endif
                            <span class="max-w-[150px] truncate">{{ $topbarUpz->name }}</span>
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
            <main class="flex-1 p-3 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto min-w-0">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="px-4 sm:px-8 py-5 text-center text-xs text-slate-400 dark:text-slate-500 no-print flex flex-col sm:flex-row justify-between items-center gap-2">
                <span>SILVER-ZIS &bull; Sistem Laporan Keuangan Nirlaba Terintegrasi ZIS</span>
                <span>Regulasi: Perbaznas No. 2/2016</span>
            </footer>
        </div>
    </div>

    <!-- SweetAlert2 Global Configuration & Flash Handlers -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ addslashes(session('success')) }}'
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ addslashes(session('error')) }}'
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>