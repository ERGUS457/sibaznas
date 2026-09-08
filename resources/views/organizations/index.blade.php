@extends('layouts.app')

@section('title', 'Kelola Organisasi & UPZ - Multi-Tenant')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-1">
                <a href="{{ route('portal') }}" class="hover:text-slate-800">Portal</a>
                <span>/</span>
                <span class="text-slate-700">Manajemen Organisasi</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                Entitas Organisasi &amp; Ruang Kerja UPZ
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Kelola pendaftaran organisasi (perusahaan, yayasan, instansi, masjid) dan beralih ruang kerja antar organisasi secara terisolasi.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('organizations.create') }}" class="clay-btn-emerald px-4 py-2 text-xs font-semibold flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Daftarkan Organisasi Baru</span>
            </a>
        </div>
    </div>

    <!-- Active Workspace Banner -->
    <div class="clay-card p-5 sm:p-6 bg-gradient-to-r from-emerald-50/70 via-white to-slate-50/50 border-emerald-200">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3.5">
                <div class="w-12 h-12 rounded-xl bg-emerald-700 text-white flex items-center justify-center text-xl font-bold flex-shrink-0 shadow-xs">
                    <i class="fa-solid fa-building-shield"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded border border-emerald-300">
                            RUANG KERJA AKTIF SAAT INI
                        </span>
                        <span class="text-xs font-semibold text-slate-500">
                            Kode: {{ $activeOrg->code }}
                        </span>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900 mt-0.5">
                        {{ $activeOrg->name }}
                    </h2>
                    <p class="text-xs text-slate-600">
                        {{ ucfirst(str_replace('_', ' ', $activeOrg->institution_type ?? 'organisasi')) }} &bull; 
                        SK: {{ $activeOrg->sk_number ?? 'Belum ada SK' }} &bull; 
                        Pembina: {{ $activeOrg->parent_baznas_name ?? 'BAZNAS' }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('portal') }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-table-cells-large text-slate-500"></i>
                    <span>Buka Portal Modul</span>
                </a>
                <a href="{{ route('organizations.edit', $activeOrg->id) }}" class="clay-btn-white px-3.5 py-2 text-xs font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square text-slate-500"></i>
                    <span>Edit Profil</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Registered Organizations List -->
    <div class="clay-card overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 bg-white flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-list-ul text-slate-500 text-sm"></i>
                <h3 class="text-sm font-bold text-slate-800">Daftar Seluruh Organisasi Terdaftar ({{ $organizations->count() }})</h3>
            </div>
            <span class="text-xs text-slate-500">Setiap organisasi memiliki jurnal, muzakki, mustahiq, dan pelaporan independen</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-50 text-slate-600 border-b border-slate-200 uppercase font-semibold text-[11px]">
                    <tr>
                        <th class="py-3 px-4">Nama Organisasi / UPZ</th>
                        <th class="py-3 px-4">Tipe &amp; Induk BAZNAS</th>
                        <th class="py-3 px-4">Legalitas SK UPZ</th>
                        <th class="py-3 px-4 text-center">Data Transaksi</th>
                        <th class="py-3 px-4 text-center">Status Ruang Kerja</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($organizations as $org)
                    @php
                        $isActive = ($org->id === $activeOrg->id);
                        $summary = $orgSummaries[$org->id] ?? [];
                        $zisTotal = $summary['total_zis_collected'] ?? 0;
                        $journals = $org->journal_entries_count ?? 0;
                    @endphp
                    <tr class="hover:bg-slate-50/70 transition {{ $isActive ? 'bg-emerald-50/30' : '' }}">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg {{ $isActive ? 'bg-emerald-700 text-white' : 'bg-slate-100 text-slate-700' }} flex items-center justify-center font-bold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($org->name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 block text-sm">{{ $org->name }}</span>
                                    <span class="text-[11px] text-slate-500">Kode: {{ $org->code }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                {{ ucfirst(str_replace('_', ' ', $org->institution_type)) }}
                            </span>
                            <div class="text-[11px] text-slate-500 mt-1">
                                {{ $org->parent_baznas_name ?? 'BAZNAS' }} ({{ strtoupper($org->parent_baznas_level ?? 'pusat') }})
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($org->sk_number)
                                <div class="font-semibold text-slate-800">{{ $org->sk_number }}</div>
                                <div class="text-[11px] text-slate-500">
                                    {{ $org->sk_date ? $org->sk_date->format('d/m/Y') : '-' }} s/d {{ $org->sk_valid_until ? $org->sk_valid_until->format('d/m/Y') : 'Seterusnya' }}
                                </div>
                            @else
                                <span class="text-slate-400 italic">Belum diinput</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($zisTotal > 0 || $journals > 0)
                                <div class="font-bold text-slate-900">Rp {{ number_format($zisTotal, 0, ',', '.') }}</div>
                                <div class="text-[10px] text-slate-500">{{ $journals }} Jurnal &bull; {{ $org->muzakkis_count }} Muzakki</div>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-semibold bg-sky-50 text-sky-800 border border-sky-200">
                                    <i class="fa-solid fa-sparkles text-[10px]"></i>
                                    <span>Bersih (0 Transaksi)</span>
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($isActive)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                                    <span>Aktif Saat Ini</span>
                                </span>
                            @else
                                <form action="{{ route('organizations.switch', $org->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="clay-btn-white px-3 py-1 text-xs font-semibold text-slate-700 hover:text-emerald-700 hover:border-emerald-300">
                                        <i class="fa-solid fa-arrow-right-to-bracket text-[10px] mr-1"></i>
                                        <span>Pilih / Aktifkan</span>
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('organizations.edit', $org->id) }}" class="clay-btn-white px-2.5 py-1 text-xs text-slate-700 hover:text-slate-900" title="Edit Profil Organisasi">
                                    <i class="fa-solid fa-pen text-[11px]"></i>
                                </a>
                                @if($org->id !== 1 || $organizations->count() > 1)
                                <button type="button" 
                                        onclick="confirmReset('{{ $org->id }}', '{{ addslashes($org->name) }}')"
                                        class="clay-btn-white px-2.5 py-1 text-xs text-rose-600 hover:text-rose-700 hover:border-rose-300"
                                        title="Reset Data Transaksi Menjadi Bersih (0 Transaksi)">
                                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-slate-400">
                            Belum ada organisasi terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Reset Modal -->
<div id="resetModal" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="clay-card p-6 max-w-md w-full bg-white border-rose-200">
        <div class="flex items-center gap-3 text-rose-600 mb-3">
            <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center text-lg font-bold">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Reset Data Transaksi Organisasi</h3>
                <p class="text-xs text-slate-500">Tindakan ini akan mengosongkan semua transaksi organisasi ini</p>
            </div>
        </div>
        <p class="text-xs text-slate-600 leading-relaxed mb-4">
            Semua penerimaan ZIS, BSZ, penyaluran mustahiq, setoran BAZNAS, dan jurnal umum untuk organisasi <strong id="resetOrgName"></strong> akan dihapus permanen sehingga menjadi bersih (0 transaksi).
        </p>
        <form id="resetForm" method="POST" action="">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-semibold text-slate-700 mb-1">
                    Ketik nama organisasi untuk konfirmasi:
                </label>
                <input type="text" name="confirm_name" id="confirmNameInput" class="maxi-input w-full px-3 py-2 text-xs" required placeholder="Ketik nama persis di sini...">
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="button" onclick="closeResetModal()" class="clay-btn-white px-3.5 py-1.5 text-xs font-semibold">
                    Batal
                </button>
                <button type="submit" class="clay-btn-rose px-4 py-1.5 text-xs font-bold">
                    Konfirmasi Reset Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function confirmReset(orgId, orgName) {
        document.getElementById('resetOrgName').innerText = orgName;
        document.getElementById('resetForm').action = '/organizations/' + orgId + '/reset';
        document.getElementById('confirmNameInput').value = '';
        document.getElementById('resetModal').classList.remove('hidden');
        document.getElementById('resetModal').classList.add('flex');
    }
    function closeResetModal() {
        document.getElementById('resetModal').classList.add('hidden');
        document.getElementById('resetModal').classList.remove('flex');
    }
</script>
@endsection
