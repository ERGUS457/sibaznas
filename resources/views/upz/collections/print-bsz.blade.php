<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BSZ - {{ $collection->bsz_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, Georgia, serif;
            color: #000000;
            background-color: #f8fafc;
        }
        @media print {
            .no-print { display: none !important; }
            body { 
                background: #ffffff !important; 
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .bsz-card { 
                border: 2px solid #000000 !important; 
                box-shadow: none !important; 
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 24px !important;
            }
        }
    </style>
</head>
<body class="p-4 md:p-8 flex flex-col items-center">
    <!-- Action Bar (Hidden on print) -->
    <div class="max-w-3xl w-full mb-4 flex justify-between items-center no-print">
        <a href="{{ route('collections.show', $collection->id) }}" class="text-xs font-sans font-semibold text-slate-600 hover:text-black">
            &larr; Kembali ke Detail Transaksi
        </a>
        <button onclick="window.print()" class="bg-black hover:bg-slate-800 text-white font-sans font-semibold text-xs px-4 py-2 rounded shadow flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Cetak Lembar BSZ</span>
        </button>
    </div>

    <!-- Official Monochrome BSZ Sheet (100% Sesuai Ketentuan BAZNAS) -->
    <div class="bsz-card max-w-3xl w-full bg-white border-2 border-black p-8 shadow-md text-black leading-relaxed">
        
        <!-- Official Kop UPZ BAZNAS -->
        <div class="border-b-2 border-black pb-4 flex items-center justify-between">
            <div class="space-y-0.5">
                <div class="font-bold text-xs uppercase tracking-widest text-black">BADAN AMIL ZAKAT NASIONAL</div>
                <div class="font-extrabold text-base uppercase tracking-wider text-black">{{ $collection->upzProfile->name }}</div>
                <div class="text-xs text-black">
                    Unit Pengumpul Zakat Pembantu {{ $collection->upzProfile->parent_baznas_name }}
                </div>
                <div class="text-[11px] text-black">
                    SK BAZNAS: {{ $collection->upzProfile->sk_number }} &bull; Kode UPZ: {{ $collection->upzProfile->code }}
                </div>
            </div>
            <div class="text-right border-l border-black pl-4">
                <div class="border border-black px-3 py-1.5 inline-block text-center">
                    <div class="text-[10px] uppercase font-bold tracking-wider">NO. BUKTI SETOR ZAKAT</div>
                    <div class="text-sm font-mono font-bold">{{ $collection->bsz_number }}</div>
                </div>
                <div class="text-[11px] mt-1">Tanggal: {{ $collection->transaction_date->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center my-6">
            <h1 class="text-lg font-bold tracking-widest uppercase underline">BUKTI SETOR ZAKAT (BSZ)</h1>
            <p class="text-xs mt-1">Berdasarkan Ketentuan Peraturan BAZNAS No. 2 Tahun 2016</p>
        </div>

        <!-- Muzakki Profile Box -->
        <div class="border border-black p-4 text-xs space-y-2 mb-6">
            <div class="font-bold uppercase tracking-wider text-[11px] border-b border-black pb-1 mb-2">
                IDENTITAS PEMBAYAR (MUZAKKI / MUNFIQ)
            </div>
            <table class="w-full text-xs">
                <tbody>
                    <tr>
                        <td class="w-36 py-0.5 font-bold">Nama Muzakki</td>
                        <td class="w-4">:</td>
                        <td class="font-bold uppercase">{{ $collection->muzakki->name }}</td>
                        <td class="w-28 py-0.5 font-bold">Nomor NPWZ</td>
                        <td class="w-4">:</td>
                        <td class="font-mono">{{ $collection->muzakki->npwz ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-0.5">NIK / NPWP</td>
                        <td>:</td>
                        <td class="font-mono">{{ $collection->muzakki->nik_or_npwp ?? '-' }}</td>
                        <td class="py-0.5">Kategori</td>
                        <td>:</td>
                        <td class="capitalize">{{ $collection->muzakki->type }}</td>
                    </tr>
                    <tr>
                        <td class="py-0.5">Instansi / Unit</td>
                        <td>:</td>
                        <td colspan="4">{{ $collection->muzakki->workplace_or_agency ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="py-0.5">Alamat</td>
                        <td>:</td>
                        <td colspan="4">{{ $collection->muzakki->address ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Details Table -->
        <div class="mb-6 text-xs">
            <table class="w-full border-collapse border border-black">
                <thead>
                    <tr class="bg-gray-100 font-bold border-b border-black text-center">
                        <th class="border border-black p-2.5 w-12">No</th>
                        <th class="border border-black p-2.5 text-left">Jenis Penerimaan ZIS / DSKL</th>
                        <th class="border border-black p-2.5 w-32 text-center">Metode Setor</th>
                        <th class="border border-black p-2.5 w-48 text-right">Jumlah / Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black p-2.5 text-center">1.</td>
                        <td class="border border-black p-2.5">
                            <div class="font-bold">{{ $collection->fund_type_label }}</div>
                            @if($collection->fund_subtype || $collection->description)
                                <div class="text-[11px] text-gray-700 italic">{{ $collection->fund_subtype ?? $collection->description }}</div>
                            @endif
                        </td>
                        <td class="border border-black p-2.5 text-center">{{ $collection->payment_method_label }}</td>
                        <td class="border border-black p-2.5 text-right font-mono font-bold text-sm">
                            {{ number_format($collection->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="font-bold bg-gray-50 border-t-2 border-black">
                        <td colspan="3" class="border border-black p-2.5 text-right uppercase tracking-wider">
                            TOTAL PEMBAYARAN:
                        </td>
                        <td class="border border-black p-2.5 text-right font-mono text-sm font-extrabold">
                            Rp {{ number_format($collection->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Syariah Prayer Box -->
        <div class="border border-black p-3 text-center mb-6">
            <div class="text-base font-serif font-bold mb-1" dir="rtl">
                آجَرَكَ اللهُ فِيْمَا أَعْطَيْتَ، وَبَارَكَ فِيْمَا أَبْقَيْتَ، وَجَعَلَهُ لَكَ طَهُوْرًا
            </div>
            <div class="text-[11px] italic">
                "Semoga Allah memberikan pahala atas apa yang engkau tunaikan, melimpahkan keberkahan atas harta yang engkau pertahankan, dan menjadikannya pembersih lahir batin bagimu."
            </div>
        </div>

        <!-- Tax Notice & Signatures -->
        <div class="grid grid-cols-2 gap-6 pt-2 text-xs">
            <div class="space-y-2 border border-black p-3 text-[10px] leading-relaxed">
                <div><strong>Keterangan Resmi Perpajakan:</strong></div>
                <div>Sesuai UU No. 23 Tahun 2011 Pasal 22, bukti pembayaran zakat atau sumbangan keagamaan yang sifatnya wajib yang dibayarkan melalui Badan/Lembaga/UPZ resmi yang disahkan pemerintah dapat diperhitungkan sebagai <strong>pengurang penghasilan bruto</strong> dalam perhitungan pajak penghasilan (PPh).</div>
                <div class="font-mono text-[9px] pt-1 border-t border-black">
                    Validasi Sistem: {{ strtoupper(substr(md5($collection->bsz_number . $collection->created_at), 0, 16)) }}
                </div>
            </div>
            <div class="text-center space-y-1 flex flex-col justify-between">
                <div>
                    <div>{{ $collection->upzProfile->city ?? 'Jakarta' }}, {{ $collection->transaction_date->translatedFormat('d F Y') }}</div>
                    <div class="font-bold uppercase text-[11px] mt-1">Petugas Penerima UPZ,</div>
                </div>
                <div>
                    <div class="h-20"></div> <!-- Ruang tanda tangan bersih tanpa penghalang -->
                    <div class="font-bold border-t border-black pt-1 inline-block min-w-[180px]">
                        {{ $collection->receivedBy->name ?? 'Petugas Amil UPZ' }}
                    </div>
                    <div class="text-[10px]">Amil Pelaksana UPZ BAZNAS</div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
