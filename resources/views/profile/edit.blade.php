@extends('layouts.simple')

@section('title', 'Profil Organisasi & Akun')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Pengaturan Profil</h1>
            <p class="text-xs text-slate-500">Kelola profil organisasi dan akun login Anda di halaman terpisah (tidak tercampur laporan).</p>
        </div>
        <div class="flex items-center gap-2 text-[11px] font-bold">
            <a href="#organisasi" class="px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100"><i class="fa-solid fa-building mr-1"></i> Organisasi</a>
            <a href="#akun" class="px-3 py-1.5 rounded-xl bg-white text-slate-600 border border-slate-200 hover:bg-slate-50"><i class="fa-solid fa-user mr-1"></i> Akun</a>
        </div>
    </div>

    @if($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs">
        <p class="font-bold mb-1"><i class="fa-solid fa-circle-exclamation mr-1"></i> Periksa kembali isian:</p>
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-semibold flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- ===================== SEKSI 1: ORGANISASI ===================== -->
        <div id="organisasi" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 scroll-mt-6">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-building"></i></div>
                <div>
                    <h2 class="text-sm font-extrabold text-slate-900 tracking-tight">Profil Organisasi</h2>
                    <p class="text-[11px] text-slate-500">Nama, kode, alamat, kontak, dan logo organisasi. Logo organisasi tampil di card ENTITAS di portal — bukan logo aplikasi SILVER-ZIS.</p>
                </div>
            </div>

            <!-- Logo -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-100 mb-6">
                <div class="w-24 h-24 rounded-2xl border-2 border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-inner" id="logoPreviewWrap">
                    @if($upz->logo_path)
                        @if(str_starts_with($upz->logo_path, 'data:'))
                        <img id="logoPreviewImg" src="{!! $upz->logo_path !!}" alt="Logo Organisasi" class="w-full h-full object-cover">
                        @else
                        <img id="logoPreviewImg" src="{{ asset($upz->logo_path) }}" alt="Logo Organisasi" class="w-full h-full object-cover" onerror="this.style.display='none';document.getElementById('logoFallbackIcon').style.display='flex'">
                        <i id="logoFallbackIcon" class="fa-solid fa-building text-3xl text-slate-300" style="display:none"></i>
                        @endif
                    @else
                        <i id="logoFallbackIcon" class="fa-solid fa-building text-3xl text-slate-300"></i>
                        <img id="logoPreviewImg" alt="Logo Organisasi" class="w-full h-full object-cover hidden">
                    @endif
                </div>
                <div class="space-y-2 text-center sm:text-left flex-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Logo / Foto Profil Organisasi</label>
                    <input type="file" name="logo" id="logoInput" accept="image/png,image/jpeg,image/jpg,image/webp" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer w-full sm:w-auto">
                    <p class="text-[11px] text-slate-400">JPG/PNG/WEBP maksimal 2MB. Pratinjau muncul langsung sebelum simpan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Organisasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $upz->name) }}" required class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kode Organisasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="code" value="{{ old('code', $upz->code) }}" required class="w-full text-xs font-mono border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('address', $upz->address) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Kota / Kabupaten</label>
                    <input type="text" name="city" value="{{ old('city', $upz->city) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Provinsi</label>
                    <input type="text" name="province" value="{{ old('province', $upz->province) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nomor Telepon Organisasi</label>
                    <input type="text" name="phone" value="{{ old('phone', $upz->phone) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Resmi Organisasi</label>
                    <input type="email" name="email" value="{{ old('email', $upz->email) }}" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>
        </div>

        <!-- ===================== SEKSI 2: AKUN ===================== -->
        <div id="akun" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 scroll-mt-6">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 rounded-xl bg-slate-800 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-user-gear"></i></div>
                <div>
                    <h2 class="text-sm font-extrabold text-slate-900 tracking-tight">Akun Login</h2>
                    <p class="text-[11px] text-slate-500">Ubah username, email, dan password akun Anda. Kosongkan password jika tidak ingin mengganti.</p>
                </div>
            </div>
            <div class="mb-5 mt-3 p-3 rounded-xl bg-slate-50 border border-slate-200 text-[11px] text-slate-600 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-slate-400"></i> Saat ini login sebagai <span class="font-bold text-slate-900">{{ $user->name }}</span> — peran: <span class="font-mono text-xs bg-white border border-slate-200 px-1.5 py-0.5 rounded">{{ $user->role }}</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nama Lengkap Akun</label>
                    <input type="text" name="account_name" value="{{ old('account_name', $user->name) }}" placeholder="Nama Anda" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Username</label>
                    <input type="text" name="account_username" value="{{ old('account_username', $user->username) }}" placeholder="username" class="w-full text-xs font-mono border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                    <p class="text-[10px] text-slate-400 mt-1">Dipakai saat login (unik).</p>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Email Akun</label>
                    <input type="email" name="account_email" value="{{ old('account_email', $user->email) }}" placeholder="email@contoh.id" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">No. HP Akun</label>
                    <input type="text" name="account_phone" value="{{ old('account_phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-100">
                <h3 class="text-xs font-extrabold text-slate-800 flex items-center gap-2"><i class="fa-solid fa-key text-amber-500"></i> Ganti Password</h3>
                <p class="text-[11px] text-slate-400 mt-1 mb-4">Isi ketiga kolom di bawah hanya jika ingin mengganti password.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Password Saat Ini</label>
                        <input type="password" name="current_password" autocomplete="current-password" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Password Baru (min 8 karakter)</label>
                        <input type="password" name="password" autocomplete="new-password" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" class="w-full text-xs border border-slate-300 rounded-xl px-3.5 py-2.5 focus:ring-2 focus:ring-emerald-500" placeholder="••••••••">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-2">
            <a href="{{ route('portal') }}" class="w-full sm:w-auto text-center px-5 py-2.5 text-xs font-bold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50">← Kembali ke Portal</a>
            <button type="submit" class="w-full sm:w-auto clay-btn-emerald px-8 py-2.5 text-xs font-bold flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Perubahan
            </button>
        </div>
        <p class="text-center text-[10px] text-slate-400">Setelah simpan, Anda akan diarahkan kembali ke Portal Ruang Kerja.</p>
    </form>
</div>

<script>
document.getElementById('logoInput')?.addEventListener('change', function(e){
    const f=e.target.files[0]; if(!f) return;
    if(f.size>2*1024*1024){ alert('Maksimal 2MB'); e.target.value=''; return; }
    const r=new FileReader();
    r.onload=function(ev){
        const img=document.getElementById('logoPreviewImg');
        const icon=document.getElementById('logoFallbackIcon');
        if(icon) icon.style.display='none';
        if(!img){
            const wrap=document.getElementById('logoPreviewWrap');
            const n=document.createElement('img');
            n.id='logoPreviewImg'; n.className='w-full h-full object-cover'; n.src=ev.target.result;
            wrap.innerHTML=''; wrap.appendChild(n);
        } else {
            img.src=ev.target.result;
            img.classList.remove('hidden');
            img.style.display='block';
        }
    };
    r.readAsDataURL(f);
});
</script>
@endsection
