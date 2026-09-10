<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-UPZ BAZNAS &bull; Terintegrasi DE ISAK 35 FORMAT A</title>
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

        /* Formal Corporate Cards */
        .clay-card, .maxi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease-in-out;
        }
        .clay-card-interactive:hover, .maxi-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .clay-card-soft, .maxi-card-soft {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .clay-btn-emerald, .maxi-btn-emerald {
            background: #047857;
            color: #ffffff;
            border: 1px solid #047857;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.15s ease-in-out;
        }
        .clay-btn-emerald:hover, .maxi-btn-emerald:hover {
            background: #065f46;
            border-color: #065f46;
        }
        .clay-btn-emerald:active, .maxi-btn-emerald:active {
            transform: scale(0.99);
        }

        .clay-btn-white, .maxi-btn-white {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.15s ease-in-out;
        }
        .clay-btn-white:hover, .maxi-btn-white:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #94a3b8;
        }
        .clay-btn-white:active, .maxi-btn-white:active {
            transform: scale(0.99);
        }

        .clay-pill, .maxi-pill {
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: none;
        }
    </style>
</head>
<body class="text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Top Sticky Clay Navigation Bar -->
    <header class="sticky top-4 z-50 px-4 sm:px-8 max-w-7xl mx-auto">
        <nav class="clay-card px-5 py-3.5 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SIM-UPZ BAZNAS" class="w-10 h-10 rounded-lg object-contain bg-white border border-slate-200 p-0.5 shadow-xs flex-shrink-0">
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-slate-900 text-base tracking-tight">SIM-UPZ BAZNAS</span>
                        <span class="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">RESMI</span>
                    </div>
                    <span class="text-[11px] font-medium text-slate-500 tracking-wide block">DE ISAK 35 FORMAT A</span>
                </div>
            </a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-6 text-xs font-semibold text-slate-600">
                <a href="#modul-operasional" class="hover:text-emerald-700 transition">Modul Operasional</a>
                <a href="#modul-akuntansi" class="hover:text-emerald-700 transition">Modul Akuntansi</a>
                <a href="#alur-kerja" class="hover:text-emerald-700 transition">Alur Kerja</a>
                <a href="#panduan-login" class="hover:text-emerald-700 transition">Kredensial Login</a>
            </div>

            <!-- CTA Button -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                @auth
                <a href="{{ route('portal') }}" class="clay-btn-emerald px-4 py-2 text-xs font-bold flex items-center gap-1.5">
                    <i class="fa-solid fa-layer-group text-xs"></i>
                    <span>Portal Kerja</span>
                </a>
                @else
                <a href="{{ route('register.step1') }}" class="clay-btn-white px-3.5 py-2 text-xs font-bold flex items-center gap-1.5 text-emerald-700 border-emerald-300 hover:bg-emerald-50">
                    <i class="fa-solid fa-building-user text-xs"></i>
                    <span>Daftar Organisasi</span>
                </a>
                <a href="{{ route('login') }}" class="clay-btn-emerald px-4 py-2 text-xs font-bold flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    <span>Masuk</span>
                </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-12 space-y-16 sm:space-y-24">

        <!-- ============================================================= -->
        <!-- 1. HERO SECTION (Claymorphic)                                 -->
        <!-- ============================================================= -->
        <section class="text-center space-y-6 pt-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 clay-pill bg-white text-emerald-800 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Standar Kepatuhan: Perbaznas No. 2 Tahun 2016 &bull; Format A DE ISAK 35</span>
            </div>

            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight max-w-4xl mx-auto">
                Sistem Terpadu Pengelolaan <br class="hidden sm:inline">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-700">UPZ BAZNAS &amp; Akuntansi Nonlaba</span>
            </h1>

            <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Platform modern untuk mencatat penerimaan ZIS, penerbitan Bukti Setor Zakat (BSZ) resmi, penyaluran 8 Asnaf, serta otomasi pembukuan jurnal dan 4 laporan keuangan standar IAI untuk pertanggungjawaban amil.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                @auth
                <a href="{{ route('portal') }}" class="clay-btn-emerald px-6 py-3.5 text-sm font-bold flex items-center gap-2">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Buka Portal Ruang Kerja</span>
                </a>
                @else
                <a href="{{ route('register.step1') }}" class="clay-btn-emerald px-7 py-3.5 text-sm font-bold flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-building-user"></i>
                    <span>Daftar Organisasi Baru</span>
                </a>
                <a href="{{ route('login') }}" class="clay-btn-white px-6 py-3.5 text-sm font-bold flex items-center gap-2 text-slate-800 border-slate-300">
                    <i class="fa-solid fa-right-to-bracket text-emerald-600"></i>
                    <span>Masuk ke Aplikasi</span>
                </a>
                @endauth
                <a href="#modul-operasional" class="clay-btn-white px-5 py-3.5 text-sm font-bold flex items-center gap-2 text-slate-600">
                    <i class="fa-solid fa-book-bookmark text-slate-400"></i>
                    <span>Pelajari Modul</span>
                </a>
            </div>

            <!-- Live Stats Row (Clay Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 pt-8 text-left">
                <!-- 1. Total Pengumpulan ZIS -->
                <div class="clay-card clay-card-interactive p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pengumpulan ZIS</span>
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                    </div>
                    <div class="text-xl font-extrabold text-slate-900 font-mono mt-3">
                        Rp {{ number_format($totalZisCollected, 0, ',', '.') }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-users text-emerald-600"></i>
                        <span>{{ $muzakkiCount }} Muzaki terdaftar</span>
                    </div>
                </div>

                <!-- 2. Tersalurkan ke Mustahik -->
                <div class="clay-card clay-card-interactive p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tersalurkan ke Mustahik</span>
                        <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-parachute-box"></i>
                        </div>
                    </div>
                    <div class="text-xl font-extrabold text-slate-900 font-mono mt-3">
                        Rp {{ number_format($totalDistributed, 0, ',', '.') }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-people-roof text-teal-600"></i>
                        <span>8 Asnaf &bull; 5 Bidang Program</span>
                    </div>
                </div>

                <!-- 3. Kas Siap Disalurkan -->
                <div class="clay-card clay-card-interactive p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kas ZIS Siap Salur</span>
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                    <div class="text-xl font-extrabold text-emerald-700 font-mono mt-3">
                        Rp {{ number_format($availableZisCash, 0, ',', '.') }}
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-shield-check text-amber-600"></i>
                        <span>Hak amil terjaga maks 12,5%</span>
                    </div>
                </div>

                <!-- 4. Neraca DE ISAK 35 -->
                <div class="clay-card clay-card-interactive p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Neraca</span>
                        <div class="w-9 h-9 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                    </div>
                    <div class="text-xl font-extrabold text-slate-900 mt-3 flex items-center gap-2">
                        @if($financialPosition['is_balanced'] ?? true)
                        <span class="text-emerald-700">Seimbang</span>
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        @else
                        <span class="text-rose-700">Perlu Koreksi</span>
                        @endif
                    </div>
                    <div class="text-[11px] text-slate-500 mt-1">
                        <span>Aset = Liabilitas + Aset Neto</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================= -->
        <!-- 2. MODUL 1: OPERASIONAL UPZ (Perbaznas No. 2/2016)           -->
        <!-- ============================================================= -->
        <section id="modul-operasional" class="space-y-8 scroll-mt-24">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider clay-pill px-3.5 py-1 bg-emerald-50 inline-block">
                    Modul 1 &bull; Peraturan BAZNAS No. 2 Tahun 2016
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Modul Operasional UPZ BAZNAS
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto">
                    Panduan teknis dan alur operasional pengumpulan, penyaluran, serta pelaporan pertanggungjawaban amil.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Fitur 1: Penerimaan & BSZ -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">1. Penerimaan ZIS &amp; Bukti Setor Zakat (BSZ)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sesuai <strong>Lampiran 1 &amp; 6 Perbaznas</strong>. Amil mencatat penerimaan Zakat Maal, Fitrah, Infak/Sedekah, dan DSKL. Sistem secara otomatis menerbitkan dokumen resmi <strong>Bukti Setor Zakat (BSZ)</strong> dengan verifikasi hash keaslian yang dapat dicetak langsung dan diperhitungkan sebagai <u>pengurang penghasilan bruto (UU No. 23/2011 Pasal 22)</u>.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-emerald-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i>
                        <span>Cetak BSZ Standar BAZNAS RI</span>
                    </div>
                </div>

                <!-- Fitur 2: Penyaluran 8 Asnaf -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-parachute-box"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">2. Penyaluran ke 8 Asnaf Mustahik</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sesuai <strong>Lampiran 2, 3, &amp; 7 Perbaznas</strong>. Penyaluran dana zakat diklasifikasikan secara ketat ke 8 Asnaf syariah (Fakir, Miskin, Amil, Mualaf, Riqab, Gharimin, Fii Sabilillah, Ibnu Sabil) ke dalam 5 Pilar Program BAZNAS: <em>Pendidikan, Kesehatan, Kemanusiaan, Ekonomi, dan Dakwah &amp; Advokasi</em>.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-teal-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-teal-600"></i>
                        <span>Validasi Kategori Mustahik &amp; Asnaf</span>
                    </div>
                </div>

                <!-- Fitur 3: Penyetoran BAZNAS -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">3. Penyetoran ke Rekening BAZNAS</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sesuai <strong>Lampiran 5 Perbaznas</strong>. Bagi UPZ pengumpul yang bertugas menyetorkan dana ke BAZNAS Pusat/Daerah, modul ini mencatat nomor bukti transfer bank, validasi verifikasi BAZNAS, serta mengurangi kewajiban utang penyetoran secara akuntansi otomatis.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-amber-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-amber-600"></i>
                        <span>Rekonsiliasi Bukti Setor Bank Resmi</span>
                    </div>
                </div>

                <!-- Fitur 4: Proteksi Hak Amil -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">4. Pembatasan Hak Amil Maksimal 12.5%</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sistem dilengkapi dengan <em>validation rule</em> otomatis di mana persentase bagian amil dibatasi maksimal <strong>12,50%</strong> (atau 1/8 bagian asnaf amil). Jika ada input melebihi batas regulasi, sistem akan menolak transaksi secara otomatis demi menjamin kepatuhan syariah dan regulasi.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-indigo-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-indigo-600"></i>
                        <span>Pencegahan Pelanggaran Batas Amil</span>
                    </div>
                </div>

                <!-- Fitur 5: Master Data Muzaki & Mustahik -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">5. Basis Data Muzaki &amp; Mustahik</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Penyimpanan riwayat donatur (*Muzaki*) lengkap dengan Nomor Pokok Wajib Zakat (NPWZ), NIK, nomor telepon, dan email untuk pengiriman tanda terima elektronik. Serta direktori penerima manfaat (*Mustahik*) untuk memastikan akuntabilitas penyaluran tepat sasaran.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-sky-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-sky-600"></i>
                        <span>Manajemen Database Terintegrasi</span>
                    </div>
                </div>

                <!-- Fitur 6: Laporan Rekapitulasi UPZ -->
                <div class="clay-card clay-card-interactive p-6 space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">6. Laporan Pertanggungjawaban UPZ</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Merekapitulasi seluruh kepatuhan tata kerja UPZ (Lampiran 1 hingga Lampiran 7) dalam satu dokumen konsolidasi yang rapi, siap ditandatangani oleh Ketua UPZ dan Bagian Keuangan untuk diserahkan ke BAZNAS pembina saat audit periodik.
                    </p>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-rose-800 font-semibold flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-rose-600"></i>
                        <span>Format Laporan Siap Audit &amp; Cetak</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================= -->
        <!-- 3. MODUL 2: AKUNTANSI ISAK 35 (FORMAT A)                      -->
        <!-- ============================================================= -->
        <section id="modul-akuntansi" class="space-y-8 scroll-mt-24">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider clay-pill px-3.5 py-1 bg-sky-50 inline-block">
                    Modul 2 &bull; DE ISAK 35 Format A (IAI)
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Modul Akuntansi Keuangan Entitas Nonlaba
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto">
                    Otomatisasi penjurnalan berpasangan (*double-entry*) dan 4 laporan keuangan standar untuk kepatuhan akuntansi.
                </p>
            </div>

            <!-- Otomasi Penjurnalan Banner -->
            <div class="clay-card p-6 sm:p-8 bg-gradient-to-r from-white to-slate-50">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="space-y-2">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                            Zero Manual Journal Entry
                        </span>
                        <h3 class="text-xl font-bold text-slate-900">Penjurnalan Otomatis dari Transaksi Amil</h3>
                        <p class="text-xs text-slate-600 max-w-2xl leading-relaxed">
                            Amil operasional tidak perlu memahami debit dan kredit akuntansi. Saat amil menginput penerimaan ZIS atau penyaluran ke mustahik di Modul 1, sistem secara otomatis membentuk ayat jurnal umum berpasangan di Buku Jurnal Umum dan memutakhirkan Buku Besar secara real-time.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="clay-card-soft p-4 text-xs font-mono space-y-1 text-slate-700">
                            <div class="text-slate-400 text-[10px]">Contoh Ayat Jurnal Otomatis:</div>
                            <div class="text-emerald-700 font-bold">(D) 1101 Kas ZIS di Bank &bull; Rp 10.000.000</div>
                            <div class="text-slate-700 font-medium pl-4">(K) 4201 Pendapatan Amil &bull; Rp 1.250.000</div>
                            <div class="text-slate-700 font-medium pl-4">(K) 4101 Penerimaan Zakat Terikat &bull; Rp 8.750.000</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4 Financial Statements Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <!-- 1. Posisi Keuangan -->
                <div class="clay-card clay-card-interactive p-6 space-y-3">
                    <div class="text-xs font-bold text-emerald-700">01. Format A (Hal. 21)</div>
                    <h3 class="text-base font-bold text-slate-900">Laporan Posisi Keuangan</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Neraca entitas nonlaba yang menyajikan Aset Lancar, Aset Tetap, Liabilitas Penyetoran, dan Ekuitas Aset Neto (Tanpa Pembatasan Amil &amp; Dengan Pembatasan ZIS).
                    </p>
                </div>

                <!-- 2. Penghasilan Komprehensif -->
                <div class="clay-card clay-card-interactive p-6 space-y-3">
                    <div class="text-xs font-bold text-emerald-700">02. Format A (Hal. 24)</div>
                    <h3 class="text-base font-bold text-slate-900">Penghasilan Komprehensif</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Laporan aktivitas yang menyajikan pendapatan donasi muzaki, beban operasional amil, beban bantuan mustahik, dan surplus/defisit bersih periode berjalan.
                    </p>
                </div>

                <!-- 3. Perubahan Aset Neto -->
                <div class="clay-card clay-card-interactive p-6 space-y-3">
                    <div class="text-xs font-bold text-emerald-700">03. Format A (Hal. 26)</div>
                    <h3 class="text-base font-bold text-slate-900">Perubahan Aset Neto</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Menelusuri mutasi saldo awal dana amil dan dana ZIS, penerimaan periode berjalan, alokasi penggunaan, serta saldo akhir aset neto siap disalurkan.
                    </p>
                </div>

                <!-- 4. Arus Kas -->
                <div class="clay-card clay-card-interactive p-6 space-y-3">
                    <div class="text-xs font-bold text-emerald-700">04. Format A (Hal. 27)</div>
                    <h3 class="text-base font-bold text-slate-900">Laporan Arus Kas</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Metode langsung untuk memetakan arus kas masuk dari muzaki, pembayaran kas untuk program mustahik, serta saldo akhir kas dan setara kas di rekening UPZ.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================================= -->
        <!-- 4. ALUR KERJA TERINTEGRASI (End-to-End Workflow)              -->
        <!-- ============================================================= -->
        <section id="alur-kerja" class="space-y-8 scroll-mt-24">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider clay-pill px-3.5 py-1 bg-amber-50 inline-block">
                    Alur Transaksi &bull; End-to-End
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Bagaimana Aplikasi Bekerja
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto">
                    Dari penerimaan dana dari Muzaki hingga penerbitan laporan keuangan siap audit.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="clay-card p-6 space-y-3 relative">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-extrabold text-sm flex items-center justify-center">1</div>
                    <h4 class="font-bold text-sm text-slate-900">Muzaki Berzakat</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Petugas menginput penerimaan dana ZIS. Sistem menerbitkan Bukti Setor Zakat (BSZ) resmi ber-hash unik untuk donatur.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="clay-card p-6 space-y-3 relative">
                    <div class="w-8 h-8 rounded-full bg-teal-600 text-white font-extrabold text-sm flex items-center justify-center">2</div>
                    <h4 class="font-bold text-sm text-slate-900">Auto-Journaling</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Sistem memisahkan porsi hak amil (maks 12,5%) dan dana mustahik, lalu mendebit kas bank dan mengkredit pendapatan ZIS.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="clay-card p-6 space-y-3 relative">
                    <div class="w-8 h-8 rounded-full bg-sky-600 text-white font-extrabold text-sm flex items-center justify-center">3</div>
                    <h4 class="font-bold text-sm text-slate-900">Penyaluran 8 Asnaf</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Petugas mendistribusikan dana kepada mustahik terdaftar. Sistem mencatat beban program dan mengurangi kas saldo ZIS.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="clay-card p-6 space-y-3 relative">
                    <div class="w-8 h-8 rounded-full bg-amber-600 text-white font-extrabold text-sm flex items-center justify-center">4</div>
                    <h4 class="font-bold text-sm text-slate-900">Laporan Siap Saji</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Seluruh 4 laporan DE ISAK 35 dan laporan tata kerja UPZ Perbaznas langsung terbentuk secara otomatis tanpa perlu rekap manual.
                    </p>
                </div>
            </div>
        </section>

        <!-- ============================================================= -->
        <!-- 5. KREDENSIAL LOGIN & AKSES CEPAT (Clay Card)                 -->
        <!-- ============================================================= -->
        <section id="panduan-login" class="clay-card p-8 sm:p-10 scroll-mt-24 bg-gradient-to-b from-white to-emerald-50/40">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-700 text-white text-xl shadow-xs mx-auto">
                    <i class="fa-solid fa-key"></i>
                </div>

                <div class="space-y-2">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                        Akses Sistem &bull; Kredensial Login
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 max-w-lg mx-auto">
                        Gunakan akun administrator berikut untuk masuk ke panel kerja operasional UPZ dan akuntansi keuangan:
                    </p>
                </div>

                <!-- Inset Box Credential -->
                <div class="clay-card-soft p-5 max-w-md mx-auto space-y-3 text-left">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-200 text-xs font-bold text-slate-600">
                        <span>Akun Administrator Bawaan</span>
                        <span class="text-emerald-700 bg-emerald-100 px-2.5 py-0.5 rounded-full text-[10px]">Aktif &amp; Terverifikasi</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 block font-sans">Username</span>
                            <span class="text-base font-extrabold text-slate-900">admin</span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xl border border-slate-200">
                            <span class="text-[10px] text-slate-400 block font-sans">Password</span>
                            <span class="text-base font-extrabold text-slate-900">admin123</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Button to Login & Register -->
                <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('login') }}" class="clay-btn-emerald inline-flex items-center space-x-2 px-8 py-3.5 font-bold text-sm tracking-wide">
                        <span>Buka Halaman Login</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('register.step1') }}" class="clay-btn-white inline-flex items-center space-x-2 px-6 py-3.5 font-bold text-sm text-emerald-800 border-emerald-300 hover:bg-emerald-50">
                        <i class="fa-solid fa-building-user text-emerald-600 text-xs"></i>
                        <span>Daftarkan Organisasi Baru</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Claymorphic Footer -->
    <footer class="mt-16 py-8 border-t border-slate-200/80 bg-white/70 text-center text-xs text-slate-500 space-y-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center space-x-2">
                <span class="font-extrabold text-slate-800">SIM-UPZ BAZNAS</span>
                <span>&bull;</span>
                <span>Terintegrasi DE ISAK 35 FORMAT A</span>
            </div>
            <div>
                Regulasi: <strong>Perbaznas No. 2/2016</strong> &bull; Standar: <strong>DE ISAK 35 Format A</strong>
            </div>
        </div>
    </footer>

</body>
</html>
