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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }

        /* Claymorphism Styling */
        .clay-card {
            background: #ffffff;
            border-radius: 28px;
            box-shadow: 
                10px 14px 28px rgba(160, 175, 200, 0.22),
                -8px -8px 20px rgba(255, 255, 255, 0.95),
                inset 2px 2px 4px rgba(255, 255, 255, 0.9),
                inset -2px -2px 6px rgba(160, 175, 200, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.9);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .clay-card:hover {
            transform: translateY(-4px);
            box-shadow: 
                14px 20px 36px rgba(160, 175, 200, 0.3),
                -10px -10px 24px rgba(255, 255, 255, 0.98),
                inset 2px 2px 5px rgba(255, 255, 255, 0.95),
                inset -2px -2px 6px rgba(160, 175, 200, 0.15);
        }

        .clay-card-soft {
            background: #f8fafc;
            border-radius: 20px;
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
            border-radius: 18px;
            box-shadow: 
                5px 8px 18px rgba(5, 150, 105, 0.35),
                -3px -3px 10px rgba(255, 255, 255, 0.9),
                inset 2px 2px 4px rgba(255, 255, 255, 0.45),
                inset -2px -3px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .clay-btn-emerald:hover {
            transform: translateY(-2px);
            box-shadow: 
                7px 12px 24px rgba(5, 150, 105, 0.45),
                -4px -4px 12px rgba(255, 255, 255, 0.95);
        }

        .clay-btn-sky {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            border-radius: 18px;
            box-shadow: 
                5px 8px 18px rgba(2, 132, 199, 0.35),
                -3px -3px 10px rgba(255, 255, 255, 0.9),
                inset 2px 2px 4px rgba(255, 255, 255, 0.45),
                inset -2px -3px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .clay-btn-sky:hover {
            transform: translateY(-2px);
            box-shadow: 
                7px 12px 24px rgba(2, 132, 199, 0.45),
                -4px -4px 12px rgba(255, 255, 255, 0.95);
        }

        .clay-btn-white {
            background: #ffffff;
            color: #1e293b;
            border-radius: 16px;
            box-shadow: 
                4px 6px 14px rgba(160, 175, 200, 0.18),
                -3px -3px 8px rgba(255, 255, 255, 0.95),
                inset 1px 1px 3px rgba(255, 255, 255, 0.9);
            transition: all 0.15s ease;
        }
        .clay-btn-white:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-full flex flex-col justify-between p-4 sm:p-8 md:p-12">

    <!-- Top Navigation Bar -->
    <header class="max-w-6xl mx-auto w-full flex items-center justify-between mb-8 sm:mb-12">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white text-xl font-extrabold shadow-md">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <h1 class="text-lg font-black text-slate-900 tracking-tight">SIM-ORGANISASI &amp; ZAKAT</h1>
                <p class="text-xs text-slate-500 font-medium">Portal Ruang Kerja Terpadu Multi-Modul</p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('landing') }}" class="clay-btn-white px-4 py-2 text-xs font-bold flex items-center gap-2 text-slate-700 hover:text-slate-900">
                <i class="fa-solid fa-house text-slate-400"></i>
                <span class="hidden sm:inline">Landing Page</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="clay-btn-white px-4 py-2 text-xs font-bold flex items-center gap-2 text-rose-600 hover:text-rose-700">
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
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100/80 text-emerald-800 text-xs font-bold mb-3 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                Pilih Ruang Kerja Aplikasi
            </h2>
            <p class="text-sm text-slate-600 max-w-2xl mx-auto mt-2">
                Sistem telah dipisahkan ke dalam modul independen agar pembukuan internal organisasi dan penatausahaan zakat dapat dikelola secara terfokus, rapi, dan sesuai standar masing-masing.
            </p>
        </div>

        <!-- 2 Main Cards Grid (Extensible for Card 3 in the future) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            
            <!-- CARD 1: AKUNTANSI KEUANGAN ORGANISASI (DE ISAK 35) -->
            <div class="clay-card p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden border-t-4 border-t-sky-500">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider bg-sky-50 text-sky-700 px-3 py-1 rounded-full border border-sky-200">
                            Modul Internal Organisasi
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Akuntansi Keuangan Organisasi (DE ISAK 35)
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Khusus pencatatan pembukuan internal entitas nonlaba. Mengelola jurnal umum, buku besar akuntansi, neraca saldo, serta 4 laporan keuangan pokok berstandar <strong>DE ISAK 35 Format A</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2 mb-6 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-[13px]"></i>
                            <span>Jurnal Umum &amp; Buku Besar Kas / Bank</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-[13px]"></i>
                            <span>Laporan Posisi Keuangan (Format A)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-[13px]"></i>
                            <span>Laporan Penghasilan Komprehensif &amp; Aset Neto</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-sky-600 text-[13px]"></i>
                            <span>Laporan Arus Kas (Metode Langsung)</span>
                        </div>
                    </div>

                    <!-- Metric Highlights -->
                    <div class="clay-card-soft p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] text-slate-500 block">Total Aset Organisasi</span>
                            <strong class="text-sm font-bold text-slate-900">Rp {{ number_format($totalAssets, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] text-slate-500 block">Keseimbangan Neraca</span>
                            <span class="inline-block mt-0.5 text-xs font-extrabold px-2 py-0.5 rounded-full {{ $isBalanced ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $isBalanced ? '✓ Seimbang (Balanced)' : '! Belum Seimbang' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.isak35') }}" class="clay-btn-sky w-full py-3.5 px-6 font-extrabold text-sm flex items-center justify-center gap-2 shadow-lg">
                        <span>Buka Pembukuan ISAK 35</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- CARD 2: PENGELOLAAN & PELAPORAN ZAKAT (STANDAR BAZNAS RI) -->
            <div class="clay-card p-6 sm:p-8 flex flex-col justify-between relative overflow-hidden border-t-4 border-t-emerald-500">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center text-white text-2xl shadow-lg">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <span class="text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full border border-emerald-200">
                            Unit Pengumpul Zakat (UPZ)
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Pengelolaan &amp; Pelaporan Zakat (BAZNAS RI)
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Khusus organisasi yang memiliki hak/legalitas mengumpulkan zakat (UPZ). Mengelola penerimaan ZIS, pencetakan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, serta pelaporan resmi <strong>Perbaznas No. 2 Tahun 2016</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2 mb-6 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-[13px]"></i>
                            <span>Penerimaan ZIS &amp; Cetak Bukti Setor Zakat (BSZ)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-[13px]"></i>
                            <span>Penyaluran 8 Asnaf &amp; Setoran ke BAZNAS</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-[13px]"></i>
                            <span>Evaluasi Batasan Hak Amil (Maksimal 12,5%)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-[13px]"></i>
                            <span>Lampiran Resmi I, II, III, V, VII Perbaznas 2/2016</span>
                        </div>
                    </div>

                    <!-- Metric Highlights -->
                    <div class="clay-card-soft p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] text-slate-500 block">Total Dihimpun (ZIS)</span>
                            <strong class="text-sm font-bold text-emerald-700">Rp {{ number_format($totalZisCollected, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] text-slate-500 block">Kepatuhan Amil (Maks 12,5%)</span>
                            <span class="inline-block mt-0.5 text-xs font-extrabold px-2 py-0.5 rounded-full {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ number_format($effectiveAmilPercentage, 2) }}% Patuh
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.baznas') }}" class="clay-btn-emerald w-full py-3.5 px-6 font-extrabold text-sm flex items-center justify-center gap-2 shadow-lg">
                        <span>Buka Modul Zakat BAZNAS</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Extensibility Notice / Future Slot Placeholder -->
        <div class="mt-8 p-4 rounded-2xl border-2 border-dashed border-slate-300 text-center text-slate-500 text-xs">
            <span class="font-semibold text-slate-600"><i class="fa-solid fa-circle-plus mr-1"></i> Arsitektur Siap Berkembang:</span>
            Modul pelaporan lain (Card ke-3, seperti Pelaporan Pajak Lembaga, CSR, atau Modul Audit) dapat ditambahkan ke portal ini dengan mudah di masa mendatang.
        </div>
    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto w-full text-center text-xs text-slate-400 mt-10">
        <span>SIM-Organisasi &amp; Zakat &bull; Sistem Terpadu DE ISAK 35 &amp; Peraturan BAZNAS No. 2 Tahun 2016</span>
    </footer>

</body>
</html>
