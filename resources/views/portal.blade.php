<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Ruang Kerja - SIM-UPZ BAZNAS &amp; DE ISAK 35</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="min-h-full flex flex-col justify-between p-4 sm:p-8 md:p-12">

    <!-- Top Navigation Bar -->
    <header class="max-w-6xl mx-auto w-full flex items-center justify-between mb-8 sm:mb-12">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-lg bg-slate-900 text-white flex items-center justify-center text-lg font-bold shadow-xs">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <h1 class="text-base font-bold text-slate-900 tracking-tight">SIM-ORGANISASI &amp; ZAKAT</h1>
                <p class="text-xs text-slate-500 font-medium">Portal Ruang Kerja Multi-Modul</p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('landing') }}" class="btn-formal-outline px-3.5 py-1.5 text-xs flex items-center gap-2">
                <i class="fa-solid fa-house text-slate-400 text-[11px]"></i>
                <span class="hidden sm:inline">Landing Page</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="btn-formal-outline px-3.5 py-1.5 text-xs text-rose-600 hover:text-rose-700 hover:border-rose-300 flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right-from-bracket text-[11px]"></i>
                    <span class="hidden sm:inline">Keluar</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content: Welcome & Cards -->
    <main class="max-w-6xl mx-auto w-full flex-1 flex flex-col justify-center">
        <!-- Title & Subtitle -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold border border-slate-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">
                Pilih Ruang Kerja Aplikasi
            </h2>
            <p class="text-sm text-slate-600 max-w-2xl mx-auto mt-2 font-normal">
                Sistem telah dipisahkan ke dalam modul independen agar pembukuan internal organisasi dan penatausahaan zakat dapat dikelola secara terfokus, rapi, dan sesuai standar masing-masing.
            </p>
        </div>

        <!-- 2 Main Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- CARD 1: AKUNTANSI KEUANGAN ORGANISASI (DE ISAK 35) -->
            <div class="formal-card p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-lg bg-slate-800 text-white flex items-center justify-center text-xl shadow-xs">
                            <i class="fa-solid fa-book-journal-whills"></i>
                        </div>
                        <span class="text-[11px] font-semibold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-1 rounded border border-slate-200">
                            MODUL INTERNAL ORGANISASI
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight mb-2">
                        Akuntansi Keuangan Organisasi (DE ISAK 35)
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Khusus pencatatan pembukuan internal entitas nonlaba. Mengelola jurnal umum, buku besar akuntansi, neraca saldo, serta 4 laporan keuangan pokok berstandar <strong>DE ISAK 35 Format A</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2.5 mb-6 text-xs text-slate-700">
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

                    <!-- Metric Highlights -->
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] font-medium text-slate-500 uppercase block">Total Aset Organisasi</span>
                            <strong class="text-base font-bold text-slate-900">Rp {{ number_format($totalAssets, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] font-medium text-slate-500 uppercase block">Keseimbangan Neraca</span>
                            <span class="inline-block mt-0.5 text-xs font-semibold px-2.5 py-0.5 rounded border {{ $isBalanced ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-rose-50 text-rose-800 border-rose-200' }}">
                                {{ $isBalanced ? '✓ Seimbang' : '! Cek Jurnal' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.isak35') }}" class="btn-formal-dark w-full py-3 px-5 text-sm flex items-center justify-center gap-2">
                        <span>Buka Pembukuan ISAK 35</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- CARD 2: PENGELOLAAN & PELAPORAN ZAKAT (STANDAR BAZNAS RI) -->
            <div class="formal-card p-6 sm:p-8 flex flex-col justify-between">
                <div>
                    <!-- Badge & Icon -->
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-xl shadow-xs">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <span class="text-[11px] font-semibold uppercase tracking-wider bg-emerald-50 text-emerald-800 px-2.5 py-1 rounded border border-emerald-200">
                            UPZ BAZNAS RESMI
                        </span>
                    </div>

                    <!-- Title & Description -->
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight mb-2">
                        Pengelolaan &amp; Pelaporan Zakat (BAZNAS RI)
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed mb-6">
                        Khusus organisasi yang memiliki hak/legalitas mengumpulkan zakat (UPZ). Mengelola penerimaan ZIS, penerbitan Bukti Setor Zakat (BSZ), penyaluran 8 Asnaf, serta pelaporan resmi <strong>Perbaznas No. 2 Tahun 2016</strong>.
                    </p>

                    <!-- Features Checklist -->
                    <div class="space-y-2.5 mb-6 text-xs text-slate-700">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Penerimaan ZIS &amp; Cetak Bukti Setor Zakat (BSZ)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Penyaluran 8 Asnaf &amp; Setoran ke BAZNAS</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Evaluasi Batasan Hak Amil (Maksimal 12,5%)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
                            <span>Lampiran Resmi I, II, III, V, VII Perbaznas 2/2016</span>
                        </div>
                    </div>

                    <!-- Metric Highlights -->
                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 grid grid-cols-2 gap-3 mb-6 text-center">
                        <div>
                            <span class="text-[11px] font-medium text-slate-500 uppercase block">Total Dihimpun (ZIS)</span>
                            <strong class="text-base font-bold text-emerald-700">Rp {{ number_format($totalZisCollected, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span class="text-[11px] font-medium text-slate-500 uppercase block">Kepatuhan Hak Amil</span>
                            <span class="inline-block mt-0.5 text-xs font-semibold px-2.5 py-0.5 rounded border {{ $effectiveAmilPercentage <= 12.5 ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-rose-50 text-rose-800 border-rose-200' }}">
                                {{ number_format($effectiveAmilPercentage, 2) }}% Patuh
                            </span>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Button -->
                <div>
                    <a href="{{ route('dashboard.baznas') }}" class="btn-formal-primary w-full py-3 px-5 text-sm flex items-center justify-center gap-2">
                        <span>Buka Modul Zakat BAZNAS</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Extensibility Notice / Future Slot Placeholder -->
        <div class="mt-8 p-4 rounded-xl border border-dashed border-slate-300 bg-white text-center text-slate-600 text-xs">
            <span class="font-semibold text-slate-800"><i class="fa-solid fa-circle-plus mr-1 text-slate-400"></i> Arsitektur Siap Berkembang:</span>
            Modul pelaporan lain (Card ke-3, seperti Pelaporan Pajak Lembaga, CSR, atau Modul Audit) dapat ditambahkan ke portal ini dengan mudah di masa mendatang.
        </div>
    </main>

    <!-- Footer -->
    <footer class="max-w-6xl mx-auto w-full text-center text-xs text-slate-500 mt-10">
        <span>SIM-ORGANISASI &amp; ZAKAT &bull; STANDAR DE ISAK 35 &amp; PERATURAN BAZNAS NO. 2 TAHUN 2016</span>
    </footer>

</body>
</html>
