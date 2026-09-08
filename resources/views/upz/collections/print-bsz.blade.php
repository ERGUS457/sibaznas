<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BSZ - {{ $collection->bsz_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; font-size: 11pt; }
            .print-container { border: 2px solid #047857 !important; }
        }
    </style>
</head>
<body class="bg-slate-100 p-4 md:p-8 flex flex-col items-center">
    <!-- Action Bar (Hidden on print) -->
    <div class="max-w-3xl w-full mb-4 flex justify-between items-center no-print">
        <a href="{{ route('collections.show', $collection->id) }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Kembali ke Detail
        </a>
        <button onclick="window.print()" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs px-4 py-2 rounded-lg shadow flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            <span>Cetak Lembar BSZ</span>
        </button>
    </div>

    <!-- Official BSZ Certificate Box -->
    <div class="max-w-3xl w-full bg-white border-2 border-emerald-700 rounded-2xl p-8 shadow-xl print-container relative overflow-hidden">
        <!-- Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none select-none">
            <span class="text-8xl font-black uppercase tracking-widest text-emerald-900">BAZNAS</span>
        </div>

        <!-- Official Header -->
        <div class="border-b-2 border-emerald-800 pb-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-xl bg-emerald-800 text-white flex flex-col items-center justify-center font-bold text-xs shadow-inner">
                    <span class="text-lg">BAZNAS</span>
                    <span class="text-[8px] tracking-tighter">UPZ RESMI</span>
                </div>
                <div>
                    <h2 class="font-extrabold text-slate-900 text-lg tracking-wide uppercase">{{ $collection->upzProfile->name }}</h2>
                    <p class="text-xs text-slate-600 font-medium">
                        Unit Pengumpul Zakat Pembantu {{ $collection->upzProfile->parent_baznas_name }}
                    </p>
                    <p class="text-[11px] text-emerald-800 font-mono font-semibold">
                        SK BAZNAS: {{ $collection->upzProfile->sk_number }} &bull; Kode UPZ: {{ $collection->upzProfile->code }}
                    </p>
                </div>
            </div>
            <div class="text-right">
                <div class="bg-emerald-50 border border-emerald-300 rounded-lg px-3 py-1.5 inline-block">
                    <div class="text-[10px] uppercase font-bold text-emerald-800 tracking-wider">No. Bukti Setor Zakat</div>
                    <div class="text-sm font-mono font-extrabold text-emerald-900">{{ $collection->bsz_number }}</div>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">Tanggal: {{ $collection->transaction_date->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Title -->
        <div class="text-center my-6">
            <h1 class="text-xl font-extrabold tracking-wider text-emerald-900 uppercase">BUKTI SETOR ZAKAT (BSZ)</h1>
            <p class="text-xs text-slate-500">Berdasarkan Ketentuan Peraturan BAZNAS No. 2 Tahun 2016</p>
        </div>

        <!-- Muzakki Profile Box -->
        <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-xs space-y-2 mb-6">
            <div class="font-bold text-slate-700 uppercase tracking-wider text-[11px] border-b border-slate-200 pb-1 mb-2">
                Identitas Pembayar (Muzakki / Munfiq)
            </div>
            <div class="grid grid-cols-2 gap-y-1.5">
                <div><span class="text-slate-500">Nama Lengkap:</span> <strong class="text-slate-900 ml-1">{{ $collection->muzakki->name }}</strong></div>
                <div><span class="text-slate-500">Nomor NPWZ:</span> <span class="font-mono font-bold text-emerald-800 ml-1">{{ $collection->muzakki->npwz ?? '-' }}</span></div>
                <div><span class="text-slate-500">NIK / NPWP:</span> <span class="font-mono text-slate-800 ml-1">{{ $collection->muzakki->nik_or_npwp ?? '-' }}</span></div>
                <div><span class="text-slate-500">Kategori:</span> <span class="capitalize ml-1">{{ $collection->muzakki->type }}</span></div>
                <div><span class="text-slate-500">Unit / Instansi:</span> <span class="ml-1">{{ $collection->muzakki->workplace_or_agency ?? '-' }}</span></div>
                <div><span class="text-slate-500">Alamat:</span> <span class="ml-1">{{ $collection->muzakki->address ?? '-' }}</span></div>
            </div>
        </div>

        <!-- Payment Details Table -->
        <div class="border border-slate-200 rounded-xl overflow-hidden mb-6 text-xs">
            <table class="w-full">
                <thead class="bg-emerald-800 text-white font-bold">
                    <tr>
                        <th class="p-3 text-left">Deskripsi Penerimaan Dana</th>
                        <th class="p-3 text-center">Metode Setor</th>
                        <th class="p-3 text-right">Jumlah / Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr>
                        <td class="p-3">
                            <div class="font-bold text-slate-900">{{ $collection->fund_type_label }}</div>
                            <div class="text-slate-500 text-[11px]">{{ $collection->fund_subtype ?? $collection->description }}</div>
                        </td>
                        <td class="p-3 text-center text-slate-700 font-medium">{{ $collection->payment_method_label }}</td>
                        <td class="p-3 text-right font-extrabold text-base text-emerald-800">
                            Rp {{ number_format($collection->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot class="bg-slate-50 font-bold border-t border-slate-200">
                    <tr>
                        <td colspan="2" class="p-3 text-right uppercase text-slate-600">Total Pembayaran ZIS:</td>
                        <td class="p-3 text-right text-lg text-emerald-900">
                            Rp {{ number_format($collection->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Syariah Prayer Box -->
        <div class="bg-emerald-50/70 border border-emerald-200 rounded-xl p-4 text-center mb-6">
            <div class="text-lg font-serif text-emerald-950 font-bold mb-1" dir="rtl">
                آجَرَكَ اللهُ فِيْمَا أَعْطَيْتَ، وَبَارَكَ فِيْمَا أَبْقَيْتَ، وَجَعَلَهُ لَكَ طَهُوْرًا
            </div>
            <div class="text-[11px] text-emerald-800 italic">
                "Semoga Allah memberikan pahala atas apa yang engkau tunaikan, melimpahkan keberkahan atas harta yang engkau pertahankan, dan menjadikannya pembersih lahir batin bagimu."
            </div>
        </div>

        <!-- Legal Disclaimer & Signatures -->
        <div class="grid grid-cols-2 gap-6 pt-2 text-xs">
            <div class="space-y-2">
                <div class="bg-slate-100 p-2.5 rounded-lg border border-slate-200 text-[10px] text-slate-600 leading-relaxed">
                    <strong>Pemberitahuan Pajak:</strong> Sesuai UU No. 23 Tahun 2011 Pasal 22, zakat atau sumbangan keagamaan yang dibayarkan melalui BAZNAS atau Lembaga/UPZ resmi dapat diperhitungkan sebagai <u>pengurang penghasilan bruto</u> dalam pelaporan SPT Tahunan PPh.
                </div>
                <div class="text-[10px] text-slate-400 font-mono">
                    Verifikasi Keaslian: {{ md5($collection->bsz_number . $collection->created_at) }}
                </div>
            </div>
            <div class="text-center space-y-1">
                <div class="text-slate-600">{{ $collection->upzProfile->city }}, {{ $collection->transaction_date->format('d F Y') }}</div>
                <div class="font-bold text-slate-800 uppercase text-[11px]">Pengurus UPZ Penerima,</div>
                <div class="h-16"></div>
                <div class="font-extrabold text-slate-900 border-t border-slate-300 pt-1 inline-block min-w-[160px]">
                    {{ $collection->receivedBy->name ?? 'Petugas Amil UPZ' }}
                </div>
                <div class="text-[10px] text-slate-500">Amil Pelaksana UPZ BAZNAS</div>
            </div>
        </div>
    </div>
</body>
</html>
