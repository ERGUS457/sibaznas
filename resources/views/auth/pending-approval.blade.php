<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Verifikasi — SIBAZNAS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .clay-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">

        {{-- Brand Logo Header --}}
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SIBAZNAS" class="w-16 h-16 rounded-2xl object-contain bg-white border border-slate-200 p-1 shadow-md mx-auto mb-2">
            <h2 class="text-xl font-bold text-gray-800">SIBAZNAS</h2>
        </div>

        {{-- Success card --}}
        <div class="clay-card p-8 text-center">

            {{-- Icon --}}
            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-50 rounded-full mb-6 border-2 border-amber-200">
                <i class="fas fa-clock text-amber-500 text-3xl"></i>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">Pendaftaran Berhasil!</h1>
            <p class="text-gray-500 text-sm mb-6">Akun Anda sedang menunggu verifikasi dari administrator</p>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 text-left">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-circle-check text-emerald-600 mt-0.5"></i>
                        <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 text-left">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-circle-info text-blue-600 mt-0.5"></i>
                        <p class="text-sm text-blue-700">{{ session('info') }}</p>
                    </div>
                </div>
            @endif

            {{-- Steps --}}
            <div class="text-left space-y-3 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-emerald-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Pendaftaran Akun</p>
                        <p class="text-xs text-gray-500">Data akun dan organisasi Anda telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-clock text-amber-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">Verifikasi Administrator</p>
                        <p class="text-xs text-gray-500">Administrator akan meninjau dan memverifikasi data Anda</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-unlock text-gray-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-400">Akun Aktif</p>
                        <p class="text-xs text-gray-400">Anda akan dapat masuk setelah diverifikasi</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 mb-6 text-left">
                <p class="text-xs text-gray-600">
                    <i class="fas fa-info-circle text-gray-400 mr-1"></i>
                    Proses verifikasi biasanya membutuhkan waktu <strong>1–2 hari kerja</strong>.
                    Anda akan dihubungi melalui email yang telah didaftarkan setelah akun diverifikasi.
                </p>
            </div>

            <a href="{{ route('login') }}"
               class="block w-full py-3 px-6 bg-emerald-600 text-white rounded-xl font-semibold text-sm hover:bg-emerald-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Halaman Login
            </a>
        </div>

        <p class="text-center text-xs text-gray-400 mt-4">
            SIBAZNAS — Sistem Informasi BAZNAS
        </p>
    </div>
</body>
</html>
