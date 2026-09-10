<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Organisasi — SIM-ORGANISASI</title>
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
        .btn-primary {
            background: #059669; color: #fff; border-radius: 10px; padding: 10px 24px;
            font-weight: 600; border: none; cursor: pointer; transition: background 0.2s;
        }
        .btn-primary:hover { background: #047857; }
        .btn-secondary {
            background: #fff; color: #374151; border-radius: 10px; padding: 10px 24px;
            font-weight: 600; border: 1.5px solid #d1d5db; cursor: pointer; transition: all 0.2s;
        }
        .btn-secondary:hover { border-color: #9ca3af; }
        .form-input, .form-select {
            width: 100%; padding: 10px 14px; border: 1.5px solid #d1d5db;
            border-radius: 10px; font-size: 15px; transition: border-color 0.2s; background: #fff;
        }
        .form-input:focus, .form-select:focus { outline: none; border-color: #059669; box-shadow: 0 0 0 3px rgba(5,150,105,0.1); }
        .form-input.error, .form-select.error { border-color: #ef4444; }
        .section-title { font-size: 13px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #f3f4f6; }
        .step-active { background: #059669; color: #fff; }
        .step-done { background: #d1fae5; color: #059669; border: 2px solid #059669; }
        .step-inactive { background: #f3f4f6; color: #9ca3af; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 py-10">
    <div class="w-full max-w-2xl">

        {{-- Header --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Organisasi" class="w-16 h-16 rounded-2xl object-contain bg-white border border-slate-200 p-1 shadow-md mx-auto mb-4">
            <h1 class="text-2xl font-bold text-gray-800">SIM-ORGANISASI</h1>
            <p class="text-gray-500 text-sm mt-1">Sistem Informasi Akuntansi &amp; Manajemen Organisasi — Pendaftaran Organisasi</p>
        </div>

        {{-- Step Indicator --}}
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-done">
                    <i class="fas fa-check text-xs"></i>
                </div>
                <span class="text-sm text-emerald-600 font-semibold">Data Akun</span>
            </div>
            <div class="h-px w-12 bg-emerald-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-active">2</div>
                <span class="text-sm font-semibold text-emerald-700">Data Organisasi</span>
            </div>
            <div class="h-px w-12 bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold step-inactive">3</div>
                <span class="text-sm text-gray-400">Selesai</span>
            </div>
        </div>

        {{-- Card --}}
        <div class="clay-card p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-1">Data Profil Organisasi</h2>
            <p class="text-gray-500 text-sm mb-6">Langkah 2 dari 2 — Isi data profil organisasi Anda</p>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-circle-exclamation text-red-500 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan pada input:</p>
                            <ul class="text-sm text-red-600 space-y-0.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register.step2.submit') }}" class="space-y-6">
                @csrf

                {{-- Identitas Organisasi --}}
                <div>
                    <p class="section-title"><i class="fas fa-building mr-2"></i>Identitas Organisasi</p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Organisasi <span class="text-red-500">*</span></label>
                            <input type="text" name="upz_name" value="{{ old('upz_name') }}"
                                   placeholder="contoh: Yayasan Bina Mandiri"
                                   class="form-input {{ $errors->has('upz_name') ? 'error' : '' }}">
                            @error('upz_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kode Organisasi <span class="text-red-500">*</span></label>
                                <input type="text" name="upz_code" value="{{ old('upz_code') }}"
                                       placeholder="contoh: ORG-YBM-001"
                                       class="form-input {{ $errors->has('upz_code') ? 'error' : '' }}">
                                <p class="text-xs text-gray-400 mt-1">Kode unik untuk Organisasi Anda (huruf/angka/tanda minus)</p>
                                @error('upz_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jenis Lembaga <span class="text-red-500">*</span></label>
                                <select name="institution_type" class="form-select {{ $errors->has('institution_type') ? 'error' : '' }}">
                                    <option value="">-- Pilih --</option>
                                    @foreach(['Instansi Pemerintah', 'BUMN', 'BUMD', 'Swasta', 'Masjid', 'Lembaga Pendidikan', 'Lembaga Nonlaba / Yayasan', 'Lainnya'] as $type)
                                        <option value="{{ $type }}" {{ old('institution_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('institution_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Legalitas & Pembina --}}
                <div>
                    <p class="section-title"><i class="fas fa-file-contract mr-2"></i>Legalitas &amp; Pembina Organisasi</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tingkat Pembina / Induk <span class="text-red-500">*</span></label>
                            <select name="parent_baznas_level" class="form-select {{ $errors->has('parent_baznas_level') ? 'error' : '' }}">
                                <option value="">-- Pilih --</option>
                                @foreach(['Tingkat Nasional', 'Tingkat Provinsi', 'Tingkat Kab/Kota'] as $level)
                                    <option value="{{ $level }}" {{ old('parent_baznas_level') === $level ? 'selected' : '' }}>{{ $level }}</option>
                                @endforeach
                            </select>
                            @error('parent_baznas_level') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Instansi / Pembina Induk <span class="text-red-500">*</span></label>
                            <input type="text" name="parent_baznas_name" value="{{ old('parent_baznas_name', 'Organisasi Induk') }}"
                                   placeholder="contoh: Dinas Sosial / Pembina Organisasi"
                                   class="form-input {{ $errors->has('parent_baznas_name') ? 'error' : '' }}">
                            @error('parent_baznas_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor SK / Izin Pendirian</label>
                            <input type="text" name="sk_number" value="{{ old('sk_number') }}"
                                   placeholder="contoh: 001/SK-ORG/2024" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal SK</label>
                            <input type="date" name="sk_date" value="{{ old('sk_date') }}" class="form-input">
                        </div>
                    </div>
                </div>

                {{-- Kontak & Alamat --}}
                <div>
                    <p class="section-title"><i class="fas fa-map-marker-alt mr-2"></i>Kontak & Alamat</p>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap</label>
                            <textarea name="address" rows="2" placeholder="Jl. Contoh No. 1, RT/RW, Kelurahan, Kecamatan"
                                      class="form-input">{{ old('address') }}</textarea>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kota/Kabupaten</label>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="Bandung" class="form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provinsi</label>
                                <input type="text" name="province" value="{{ old('province') }}" placeholder="Jawa Barat" class="form-input">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon Kantor</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="022-xxxxxxx" class="form-input">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pengurus --}}
                <div>
                    <p class="section-title"><i class="fas fa-users mr-2"></i>Data Pengurus Organisasi</p>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ketua</label>
                            <input type="text" name="chairman_name" value="{{ old('chairman_name') }}" placeholder="Nama Ketua Organisasi" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sekretaris</label>
                            <input type="text" name="secretary_name" value="{{ old('secretary_name') }}" placeholder="Nama Sekretaris" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Bendahara</label>
                            <input type="text" name="treasurer_name" value="{{ old('treasurer_name') }}" placeholder="Nama Bendahara" class="form-input">
                        </div>
                    </div>
                </div>

                {{-- Rekening & Operasional --}}
                <div>
                    <p class="section-title"><i class="fas fa-university mr-2"></i>Rekening Bank &amp; Alokasi Operasional</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Bank</label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="contoh: Bank Syariah Indonesia" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Rekening</label>
                            <input type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" placeholder="xxxx-xxxx-xxxx" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Pemilik Rekening</label>
                            <input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}" placeholder="Nama sesuai buku rekening" class="form-input">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Persentase Operasional / Amil (%)</label>
                            <input type="number" name="amil_share_percentage" value="{{ old('amil_share_percentage', 12.5) }}"
                                   placeholder="12.50" min="0" max="100" step="0.01" class="form-input">
                            <p class="text-xs text-gray-400 mt-1">Alokasi maksimal hak operasional / pengelola</p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('register.step1') }}" class="btn-secondary flex-1 text-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn-primary flex-1">
                        <i class="fas fa-paper-plane mr-2"></i>Daftarkan Organisasi
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            Data Anda akan diverifikasi oleh administrator sebelum akun dapat digunakan.
        </p>
    </div>
</body>
</html>
