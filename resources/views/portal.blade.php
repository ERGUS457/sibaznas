<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Ruang Kerja - SIM-UPZ BAZNAS &amp; DE ISAK 35</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(#94a3b8 1.2px, transparent 1.2px),
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.15) 0px, transparent 45%),
                radial-gradient(at 100% 100%, rgba(2, 132, 199, 0.15) 0px, transparent 45%);
            background-size: 24px 24px, 100% 100%, 100% 100%;
        }

        /* ========================================================= */
        /* MAXIMALIST DESIGN SYSTEM (Bold Borders & Hard Shadows)    */
        /* ========================================================= */
        .maxi-card {
            background: #ffffff;
            border: 3px solid #0f172a;
            border-radius: 24px;
            box-shadow: 8px 8px 0px 0px #0f172a;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .maxi-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 12px 12px 0px 0px #0f172a;
        }

        .maxi-card-soft {
            background: #f8fafc;
            border: 2px solid #0f172a;
            border-radius: 16px;
            box-shadow: 4px 4px 0px 0px #0f172a;
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

        .maxi-btn-sky {
            background: #0284c7;
            color: #ffffff;
            border: 2px solid #0f172a;
            border-radius: 16px;
            font-weight: 800;
            box-shadow: 4px 4px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-sky:hover {
            background: #0369a1;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px #0f172a;
        }
        .maxi-btn-sky:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }

        .maxi-btn-white {
            background: #ffffff;
            color: #0f172a;
            border: 2px solid #0f172a;
            border-radius: 14px;
            font-weight: 800;
            box-shadow: 3px 3px 0px 0px #0f172a;
            transition: all 0.15s ease-in-out;
        }
        .maxi-btn-white:hover {
            background: #f1f5f9;
            transform: translate(-1px, -1px);
            box-shadow: 5px 5px 0px 0px #0f172a;
        }
        .maxi-btn-white:active {
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
<body class="min-h-full flex flex-col justify-between p-4 sm:p-8 md:p-12">

    <!-- Top Navigation Bar -->
    <header class="max-w-6xl mx-auto w-full flex items-center justify-between mb-8 sm:mb-12">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white border-2 border-slate-900 flex items-center justify-center text-xl font-black shadow-[4px_4px_0px_0px_#0f172a]">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <h1 class="text-lg font-black text-slate-900 tracking-tight uppercase">SIM-ORGANISASI &amp; ZAKAT</h1>
                <p class="text-xs text-slate-600 font-bold">Portal Ruang Kerja Multi-Modul</p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('landing') }}" class="maxi-btn-white px-4 py-2 text-xs flex items-center gap-2">
                <i class="fa-solid fa-house"></i>
                <span class="hidden sm:inline">Landing Page</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="maxi-btn-white px-4 py-2 text-xs text-rose-600 hover:text-rose-700 flex items-center gap-2 border-rose-950">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="hidden sm:inline">Keluar</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content: Welcome & Cards -->
    <main class="max-w-6xl mx-auto w-full flex-1 flex flex-col justify-center">
        <!-- Title & Subtitle -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 maxi-badge bg-emerald-100 text-emerald-950 text-xs mb-3">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-black animate-pulse"></span>
                <span>Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight uppercase">
                Pilih Ruang Kerja Aplikasi
            </h2>
            <p class="text-sm text-slate-700 font-medium max-w-2xl mx-auto mt-2">
                Sistem telah dipisahkan ke dalam modul independen agar pembukuan internal organisasi dan penatausahaan zakat dapat dikelola secara terfokus, rapi, dan sesuai standar masing-masing.
            </p>
        </div>

        <!-- 2 Main Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
            
            <!-- CARD 1: AKUNTANSI KEUANGAN ORGANISASI (DE ISAK 35) -->
            <div class="maxi-card p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden bg-white">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-sky-500 text-white border-2 border-slate-900 flex items-center justify-center text-2xl shadow-[4px_4px_0px_0px_#0f172a]">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider bg-sky-100 text-sky-950 px-3 py-1 maxi-badge">
                            MODUL INTERNAL ORGANISASI
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2">
                        Akuntansi Keuangan Organisasi (DE ISAK 35)
                    </h3>
                    <p class="text-xs text-slate-700 font-medium leading-relaxed mb-6">
                        Khusus pencatatan pembukuan internal entitas nonlaba. Mengelola jurnal umum, buku besar akuntansi, neraca saldo, serta 4 laporan keuangan pokok berstandar <strong>DE ISAK 35 Format A</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2 mb-6 text-xs text-slate-800 font-semibold">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-sm"></i>
                            <span>Jurnal Umum &amp; Buku Besar Kas / Bank</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-sm"></i>
                            <span>Laporan Posisi Keuangan (Format A)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-sm"></i>
                            <span>Laporan Penghasilan Komprehensif &amp; Aset Neto</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-sm"></i>
                            <span>Laporan Arus Kas (Metode Langsung)</span>
                        </div>
                    </div>

                    <!-- Metric Highlights -->
                    <div class="maxi-card-soft p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Total Aset Organisasi</span>
                            <strong class="text-base font-black text-slate-900">Rp {{ number_format($totalAssets, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Keseimbangan Neraca</span>
                            <span class="inline-block mt-0.5 text-xs font-black px-2.5 py-0.5 maxi-badge {{ $isBalanced ? 'bg-emerald-100 text-emerald-950' : 'bg-rose-100 text-rose-950' }}">
                                {{ $isBalanced ? '✓ Seimbang' : '! Cek Jurnal' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.isak35') }}" class="maxi-btn-sky w-full py-3.5 px-6 text-sm flex items-center justify-center gap-2">
                        <span>Buka Pembukuan ISAK 35</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- CARD 2: PENGELOLAAN & PELAPORAN ZAKAT (STANDAR BAZNAS RI) -->
            <div class="maxi-card p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden bg-white">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white border-2 border-slate-900 flex items-center justify-center text-2xl shadow-[4px_4px_0px_0px_#0f172a]">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider bg-emerald-100 text-emerald-950 px-3 py-1 maxi-badge">
                            UPZ BAZNAS RESMI
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-2">
                        Pengelolaan &amp; Pelaporan Zakat (BAZNAS RI)
                    </h3>
                    <p class="text-xs text-slate-700 font-medium leading-relaxed mb-6">
                        Khusus organisasi yang memiliki hak/legalitas mengumpulkan zakat (UPZ). Mengelola penerimaan ZIS, penerbitan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, serta pelaporan resmi <strong>Perbaznas No. 2 Tahun 2016</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2 mb-6 text-xs text-slate-800 font-semibold">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>Penerimaan ZIS &amp; Cetak Bukti Setor Zakat (BSZ)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>Penyaluran 8 Asnaf &amp; Setoran ke BAZNAS</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>Evaluasi Batasan Hak Amil (Maksimal 12,5%)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>Lampiran Resmi I, II, III, V, VII Perbaznas 2/2016</span>
                        </div>
                    </div>

                    <!-- Metric Highlights -->
                    <div class="maxi-card-soft p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Total Dihimpun (ZIS)</span>
                            <strong class="text-base font-black text-emerald-700">Rp {{ number_format($totalZisCollected, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold text-slate-500 uppercase block">Kepatuhan Hak Amil</span>
                            <span class="inline-block mt-0.5 text-xs font-black px-2.5 py-0.5 maxi-badge {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-100 text-emerald-950' : 'bg-rose-100 text-rose-950' }}">
                                {{ number_format($effectiveAmilPercentage, 2) }}% Patuh
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.baznas') }}" class="maxi-btn-emerald w-full py-3.5 px-6 text-sm flex items-center justify-center gap-2">
                        <span>Buka Modul Zakat BAZNAS</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Extensibility Notice / Future Slot Placeholder -->
        <div class="mt-8 p-4 rounded-2xl border-3 border-dashed border-slate-400 bg-slate-50 text-center text-slate-700 text-xs font-semibold">
            <span class="font-black text-slate-900 uppercase"><i class="fa-solid fa-circle-plus mr-1"></i> Arsitektur Siap Berkembang:</span>
            Modul pelaporan lain (Card ke-3, seperti Pelaporan Pajak Lembaga, CSR, atau Modul Audit) dapat ditambahkan ke portal ini dengan mudah di masa mendatang.
        </div>
    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto w-full text-center text-xs font-bold text-slate-500 mt-10">
        <span>SIM-ORGANISASI &amp; ZAKAT &bull; STANDAR DE ISAK 35 &amp; PERATURAN BAZNAS NO. 2 TAHUN 2016</span>
    </footer>

</body>
</html>
