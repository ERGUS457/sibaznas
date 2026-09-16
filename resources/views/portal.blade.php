<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 dark:bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Ruang Kerja - SILVER-ZIS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class', theme: { extend: { colors: { primary: { 50:'#f0fdf4',100:'#dcfce7',500:'#22c55e',700:'#15803d' } } } } }
    </script>
    <script>
        (function(){ try{ var s=localStorage.getItem('theme'); var m=window.matchMedia('(prefers-color-scheme: dark)').matches; if(s==='dark' || (!s && m)) document.documentElement.classList.add('dark'); }catch(e){} })();
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .formal-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease-in-out;
        }
        .formal-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 16px -2px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .btn-formal-primary {
            background-color: #047857;
            color: #ffffff;
            border: 1px solid #047857;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .btn-formal-primary:hover {
            background-color: #065f46;
            border-color: #065f46;
        }

        .btn-formal-dark {
            background-color: #0f172a;
            color: #ffffff;
            border: 1px solid #0f172a;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .btn-formal-dark:hover {
            background-color: #1e293b;
            border-color: #1e293b;
        }

        .btn-formal-outline {
            background-color: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .btn-formal-outline:hover {
            background-color: #f8fafc;
            color: #0f172a;
            border-color: #94a3b8;
        }
        .btn-formal-primary:focus-visible, .btn-formal-dark:focus-visible, .btn-formal-outline:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(4,120,87,0.35);
        }
        .btn-formal-outline:focus-visible { box-shadow: 0 0 0 3px rgba(148,163,184,0.45); }
        /* Spasi vertikal: beri napas antar section */
        .formal-card + .formal-card, .formal-card + .grid, .grid + .formal-card { margin-top: 0.25rem; }
        /* Dark mode — base */
        .dark .formal-card { background:#1e293b; border-color:#334155; color:#e2e8f0; }
        .dark .formal-card:hover { border-color:#475569; }
        .dark .btn-formal-outline { background:#1e293b; color:#e2e8f0; border-color:#475569; }
        .dark .btn-formal-outline:hover { background:#334155; color:#f1f5f9; }
        .dark .btn-formal-primary { background:#047857; border-color:#047857; }
        .dark header, .dark footer { color:#94a3b8; }
        /* Dark mode — teks kontras (fix font tidak terlihat) */
        .dark [class*="text-slate-900"] { color:#f1f5f9 !important; }
        .dark [class*="text-slate-800"] { color:#e2e8f0 !important; }
        .dark [class*="text-slate-700"] { color:#cbd5e1 !important; }
        .dark [class*="text-slate-600"] { color:#94a3b8 !important; }
        .dark [class*="text-slate-500"] { color:#94a3b8 !important; }
        .dark [class*="bg-white"] { background-color:#1e293b !important; border-color:#334155 !important; }
        .dark [class*="bg-slate-50"] { background-color:#1e293b !important; border-color:#334155 !important; color:#cbd5e1 !important; }
        .dark [class*="bg-slate-100"] { background-color:#334155 !important; color:#e2e8f0 !important; border-color:#475569 !important; }
        .dark [class*="border-slate-200"] { border-color:#334155 !important; }
        .dark [class*="border-slate-100"] { border-color:#334155 !important; }
    </style>
</head>
<body class="min-h-full flex flex-col justify-between p-4 sm:p-8 md:p-12 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 antialiased">

    <!-- Top Navigation Bar — Responsive: desktop horizontal, mobile vertikal menumpuk -->
    <header class="max-w-6xl mx-auto w-full mb-10 sm:mb-14">
        <!-- Brand -->
        <div class="flex items-center gap-3 mb-5">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SILVER-ZIS" class="w-11 h-11 rounded-xl object-contain bg-white border border-slate-200 p-1 shadow-xs flex-shrink-0">
            <div class="min-w-0">
                <h1 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white tracking-tight leading-none">SILVER-ZIS</h1>
                <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 font-medium leading-tight mt-1">Sistem Laporan Keuangan Nirlaba Terintegrasi ZIS — Kelola Keuangan Organisasi</p>
            </div>
        </div>

        <!-- DESKTOP: bar horizontal (hidden di HP) -->
        <nav class="hidden sm:flex items-center gap-2 flex-wrap bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-3 py-2 shadow-sm">
            <a href="{{ route('profile.show') }}#organisasi" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700 text-xs font-bold hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition">
                <i class="fa-solid fa-building text-[11px]"></i> Profil Organisasi
            </a>
            <a href="{{ route('profile.show') }}#akun" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-600 text-xs font-bold hover:bg-slate-50 dark:hover:bg-slate-600 transition">
                <i class="fa-solid fa-user-gear text-[11px] text-slate-500"></i> Akun
            </a>
            <div class="h-6 w-px bg-slate-200 dark:bg-slate-600 mx-1"></div>
            <button type="button" onclick="document.documentElement.classList.toggle('dark'); try{localStorage.setItem('theme', document.documentElement.classList.contains('dark')?'dark':'light')}catch(e){}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-semibold hover:bg-slate-50 transition" title="Ganti tema">
                <i class="fa-solid fa-moon hidden dark:inline text-slate-300"></i><i class="fa-solid fa-sun dark:hidden text-amber-500"></i> Tema
            </button>
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                <i class="fa-solid fa-house text-slate-400 text-[11px]"></i> Landing Page
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline ml-auto">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-white dark:bg-slate-700 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-700/50 text-xs font-bold hover:bg-rose-50 dark:hover:bg-rose-900/20 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i> Keluar
                </button>
            </form>
        </nav>

        <!-- MOBILE: menumpuk vertikal dari atas ke bawah, label di sebelah ikon (sm:hidden) -->
        <nav class="sm:hidden flex flex-col gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-3 shadow-sm">
            <p class="text-[10px] font-extrabold tracking-widest text-slate-400 uppercase px-1 mb-1">Menu Navigasi</p>
            <a href="{{ route('profile.show') }}#organisasi" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/25 border border-emerald-200 dark:border-emerald-800 text-left active:scale-[0.99] transition">
                <span class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-building text-sm"></i></span>
                <span class="flex-1 min-w-0">
                    <span class="block text-sm font-bold text-emerald-900 dark:text-emerald-100 leading-none">Profil Organisasi</span>
                    <span class="block text-[11px] text-emerald-700/70 dark:text-emerald-300/70 mt-1">Kelola nama, kode & logo</span>
                </span>
                <i class="fa-solid fa-chevron-right text-emerald-400 text-xs"></i>
            </a>
            <a href="{{ route('profile.show') }}#akun" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-200 dark:border-slate-600 text-left active:scale-[0.99] transition">
                <span class="w-9 h-9 rounded-xl bg-slate-800 dark:bg-slate-600 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-user-gear text-sm"></i></span>
                <span class="flex-1 min-w-0">
                    <span class="block text-sm font-bold text-slate-900 dark:text-white leading-none">Akun</span>
                    <span class="block text-[11px] text-slate-500 dark:text-slate-400 mt-1">Username, email & password</span>
                </span>
                <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
            </a>
            <button type="button" onclick="document.documentElement.classList.toggle('dark'); try{localStorage.setItem('theme', document.documentElement.classList.contains('dark')?'dark':'light')}catch(e){}" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-left active:scale-[0.99] transition">
                <span class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-circle-half-stroke text-sm"></i></span>
                <span class="flex-1 min-w-0">
                    <span class="block text-sm font-bold text-slate-900 dark:text-white leading-none">Ganti Tema</span>
                    <span class="block text-[11px] text-slate-500 dark:text-slate-400 mt-1">Terang / Gelap</span>
                </span>
                <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
            </button>
            <div class="h-px bg-slate-100 dark:bg-slate-700 my-1"></div>
            <a href="{{ route('landing') }}" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-left active:scale-[0.99] transition">
                <span class="w-9 h-9 rounded-xl bg-white dark:bg-slate-600 border border-slate-200 dark:border-slate-500 text-slate-600 dark:text-slate-200 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-house text-sm"></i></span>
                <span class="flex-1 min-w-0">
                    <span class="block text-sm font-bold text-slate-900 dark:text-white leading-none">Landing Page</span>
                    <span class="block text-[11px] text-slate-500 dark:text-slate-400 mt-1">Kembali ke halaman utama</span>
                </span>
                <i class="fa-solid fa-chevron-right text-slate-300 text-xs"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-left active:scale-[0.99] transition">
                    <span class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-arrow-right-from-bracket text-sm"></i></span>
                    <span class="flex-1 min-w-0">
                        <span class="block text-sm font-bold text-rose-700 dark:text-rose-300 leading-none">Keluar Sistem</span>
                        <span class="block text-[11px] text-rose-600/70 dark:text-rose-300/70 mt-1">Akhiri sesi & logout</span>
                    </span>
                    <i class="fa-solid fa-chevron-right text-rose-300 text-xs"></i>
                </button>
            </form>
        </nav>
    </header>

    <!-- Main Content: Welcome & Cards -->
    <main class="max-w-6xl mx-auto w-full flex-1 flex flex-col justify-center">
        <!-- Flash Alerts -->
        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center justify-between shadow-xs">
            <div class="flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-base leading-none font-bold">&times;</button>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-center justify-between shadow-xs">
            <div class="flex items-center space-x-2.5">
                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-base leading-none font-bold">&times;</button>
        </div>
        @endif

        <!-- Organization Workspace Card -->
        <div class="formal-card p-4 sm:p-5 mb-8 bg-white border-slate-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    @if($upz->logo_path)
                        @if(str_starts_with($upz->logo_path, 'data:'))
                        <img src="{!! $upz->logo_path !!}" alt="Logo Organisasi" class="w-11 h-11 rounded-lg object-cover bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                        @else
                        <img src="{{ asset($upz->logo_path) }}" alt="Logo Organisasi" class="w-11 h-11 rounded-lg object-cover bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0" onerror="this.style.display='none';document.getElementById('orgFallbackIcon').style.display='flex'">
                        <div id="orgFallbackIcon" class="w-11 h-11 rounded-lg bg-amber-50 text-amber-700 border border-amber-200 hidden items-center justify-center text-lg font-bold flex-shrink-0 shadow-xs" style="display:none">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        @endif
                    @else
                    <div class="w-11 h-11 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-lg font-bold flex-shrink-0 shadow-xs">
                        <i class="fa-solid fa-building-shield"></i>
                    </div>
                    @endif
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 px-2 py-0.5 rounded border border-emerald-200">
                                ENTITAS ORGANISASI
                            </span>
                            <span class="text-xs text-slate-500 font-mono font-semibold">
                                Kode: {{ $upz->code }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white mt-1 mb-0.5">
                            {{ $upz->name }}
                        </h3>

                    </div>
                </div>

                <div class="flex items-center gap-2.5 flex-wrap">
                    @if(auth()->user()?->isSuperAdmin())
                        @php $pendingCount = \App\Models\User::where('status', 'pending')->count(); @endphp
                        <a href="{{ route('admin.users.index') }}" class="btn-formal-primary px-3.5 py-2 text-xs flex items-center gap-2">
                            <i class="fa-solid fa-users-gear text-[11px]"></i>
                            <span>Manajemen Pengguna</span>
                            @if($pendingCount > 0)
                                <span class="bg-amber-400 text-slate-900 text-[10px] font-bold px-1.5 py-0.2 rounded-full">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Title & Subtitle -->
        <div class="text-center mb-12 space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 dark:text-white tracking-tight">
                Pilih Ruang Kerja Aplikasi
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mt-2 font-normal">
                Data keuangan dan operasional di bawah ini secara otomatis disesuaikan dengan organisasi aktif: <strong class="text-slate-900 dark:text-slate-100">{{ $upz->name }}</strong>.
            </p>
        </div>

        <!-- 2 Main Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 gap-y-8">
            
            <!-- CARD 1: AKUNTANSI KEUANGAN ORGANISASI (DE ISAK 35) -->
            <div class="formal-card p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <!-- Icon -->
                    <div class="mb-5">
                        <div class="w-12 h-12 rounded-lg bg-slate-800 text-white flex items-center justify-center text-xl shadow-xs">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">
                        Laporan Keuangan Organisasi
                    </h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                        Khusus pencatatan pembukuan internal entitas nonlaba. Mengelola jurnal umum, buku besar akuntansi, neraca saldo, serta 4 laporan keuangan pokok Organisasi.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2.5 mb-6 text-xs text-slate-700 dark:text-slate-300">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-slate-700 text-sm"></i>
                            <span>Jurnal Umum &amp; Buku Besar Kas / Bank</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-slate-700 text-sm"></i>
                            <span>Laporan Posisi Keuangan (Format A)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-slate-700 text-sm"></i>
                            <span>Laporan Penghasilan Komprehensif &amp; Aset Neto</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-slate-700 text-sm"></i>
                            <span>Laporan Arus Kas (Metode Langsung)</span>
                        </div>
                    </div>


                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.isak35') }}" class="btn-formal-dark w-full py-3 px-5 text-sm flex items-center justify-center gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-800 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-900">
                        <span>Buka Pembukuan ISAK 35</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- CARD 2: PENGELOLAAN & PELAPORAN ZAKAT (STANDAR BAZNAS RI) -->
            <div class="formal-card p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <!-- Icon -->
                    <div class="mb-5">
                        <div class="w-12 h-12 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-xl shadow-xs">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">
                        Laporan Keuangan UPZ (Jika Ada)
                    </h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                        Khusus pengelolaan penerimaan donasi / ZIS, penerbitan Bukti Tanda Terima Setor (BSZ), penyaluran bantuan sosial, serta pelaporan aktivitas dana masyarakat.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2.5 mb-6 text-xs text-slate-700 dark:text-slate-300">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Input Penerimaan Dana &amp; Cetak Bukti Setor</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Penyaluran Program &amp; Bantuan Sosial</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Master Data Donatur / Muzakki &amp; Penerima Bantuan</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Laporan Periodik Penerimaan &amp; Penyaluran</span>
                        </div>
                    </div>


                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.baznas') }}" class="btn-formal-primary w-full py-3 px-5 text-sm flex items-center justify-center gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-600 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-900">
                        <span>Buka Laporan Zakat</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

        </div>


    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto w-full text-center text-xs text-slate-500 mt-10">
        <span>SILVER-ZIS &bull; Sistem Laporan Keuangan Nirlaba Terintegrasi ZIS</span>
    </footer>

</body>
</html>
