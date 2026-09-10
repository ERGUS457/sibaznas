@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="clay-card p-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><i class="fas fa-users-cog text-emerald-600 mr-2"></i>Manajemen Pengguna</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola akun pengguna dan verifikasi pendaftaran organisasi baru</p>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="clay-card p-4 bg-emerald-50 border-emerald-200">
            <div class="flex items-center gap-3">
                <i class="fas fa-circle-check text-emerald-600"></i>
                <p class="text-emerald-700 font-medium text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="clay-card p-4 bg-red-50 border-red-200">
            <div class="flex items-center gap-3">
                <i class="fas fa-circle-exclamation text-red-600"></i>
                <p class="text-red-700 font-medium text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-amber-600">{{ $pendingCount }}</div>
            <div class="text-xs text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i>Menunggu Verifikasi</div>
        </div>
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-emerald-600">{{ $activeCount }}</div>
            <div class="text-xs text-gray-500 mt-1"><i class="fas fa-circle-check mr-1"></i>Akun Aktif</div>
        </div>
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-red-500">{{ $rejectedCount }}</div>
            <div class="text-xs text-gray-500 mt-1"><i class="fas fa-ban mr-1"></i>Ditolak / Nonaktif</div>
        </div>
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-sky-600">{{ $pendingResetCount }}</div>
            <div class="text-xs text-gray-500 mt-1"><i class="fas fa-envelope-open-text mr-1"></i>Pesan Lupa Password</div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="clay-card p-4">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-3 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama, email, username..."
                   class="flex-1 min-w-48 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
            <select name="status" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700">
                <i class="fas fa-search mr-1"></i>Filter
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50">Reset</a>
            @endif
        </form>
    </div>

    {{-- Users Table --}}
    <div class="clay-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Pengguna</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Organisasi</th>
                        <th class="text-center px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Status</th>
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Didaftarkan</th>
                        <th class="text-center px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors" x-data="{ showRejectForm: false }">
                            <td class="px-5 py-4">
                                <div class="font-semibold text-gray-800">{{ $user->name }}</div>
                                <div class="text-gray-400 text-xs mt-0.5">{{ '@' . ($user->username ?? '-') }} · {{ $user->email }}</div>
                            </td>
                            <td class="px-5 py-4">
                                @if ($user->upzProfile)
                                    <div class="font-medium text-gray-700">{{ $user->upzProfile->name }}</div>
                                    <div class="text-gray-400 text-xs mt-0.5">{{ $user->upzProfile->code }} · {{ $user->upzProfile->institution_type }}</div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada Afiliasi Organisasi</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center">
                                @php
                                    $statusClasses = [
                                        'pending'  => 'bg-amber-100 text-amber-700',
                                        'active'   => 'bg-emerald-100 text-emerald-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                    $statusClass = $statusClasses[$user->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                    @if ($user->status === 'pending') <i class="fas fa-clock text-xs"></i>
                                    @elseif ($user->status === 'active') <i class="fas fa-check text-xs"></i>
                                    @else <i class="fas fa-ban text-xs"></i> @endif
                                    {{ $user->status_label }}
                                </span>
                                @if ($user->isRejected() && $user->rejection_reason)
                                    <div class="text-xs text-red-500 mt-1 max-w-32 truncate" title="{{ $user->rejection_reason }}">
                                        {{ $user->rejection_reason }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-gray-500 text-xs">
                                {{ $user->created_at->format('d M Y') }}<br>
                                {{ $user->created_at->format('H:i') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition-colors flex items-center gap-1"
                                       title="Edit data & kata sandi pengguna">
                                        <i class="fas fa-pen-to-square text-xs text-slate-500"></i>
                                        <span>Edit</span>
                                    </a>

                                    @if ($user->isPending())
                                        {{-- Approve Button (SweetAlert2) --}}
                                        <form id="approve-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.approve', $user) }}">
                                            @csrf
                                            <button type="button"
                                                    class="px-2.5 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition-colors flex items-center gap-1"
                                                    onclick="confirmApprove('approve-form-{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                                <i class="fas fa-check text-xs"></i>
                                                <span>Setujui</span>
                                            </button>
                                        </form>

                                        {{-- Reject Button (SweetAlert2 Prompt) --}}
                                        <form id="reject-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.reject', $user) }}">
                                            @csrf
                                            <input type="hidden" name="rejection_reason" id="reject-reason-{{ $user->id }}">
                                            <button type="button"
                                                    class="px-2.5 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-lg text-xs font-semibold hover:bg-red-100 transition-colors flex items-center gap-1"
                                                    onclick="promptReject('reject-form-{{ $user->id }}', 'reject-reason-{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                                <i class="fas fa-ban text-xs"></i>
                                                <span>Tolak</span>
                                            </button>
                                        </form>
                                    @elseif ($user->isActive() && !$user->isSuperAdmin())
                                        {{-- Suspend (SweetAlert2) --}}
                                        <form id="suspend-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                            @csrf
                                            <button type="button"
                                                    class="px-2.5 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-200 transition-colors flex items-center gap-1"
                                                    onclick="confirmSuspend('suspend-form-{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                                <i class="fas fa-pause text-xs"></i>
                                                <span>Nonaktifkan</span>
                                            </button>
                                        </form>
                                    @elseif ($user->isRejected())
                                        {{-- Reactivate (SweetAlert2) --}}
                                        <form id="reactivate-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.reactivate', $user) }}">
                                            @csrf
                                            <button type="button"
                                                    class="px-2.5 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition-colors flex items-center gap-1"
                                                    onclick="confirmReactivate('reactivate-form-{{ $user->id }}', '{{ addslashes($user->name) }}')">
                                                <i class="fas fa-rotate-right text-xs"></i>
                                                <span>Aktifkan</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                                <i class="fas fa-users text-3xl mb-3 block text-gray-200"></i>
                                Tidak ada pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    {{-- Password Reset Requests from Login --}}
    <div class="clay-card p-6 space-y-4">
        <div class="flex items-center justify-between flex-wrap gap-2 pb-3 border-b border-gray-100">
            <div>
                <h2 class="text-base font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-envelope-open-text text-sky-600"></i>
                    <span>Permohonan Bantuan Lupa Password</span>
                    @if ($pendingResetCount > 0)
                        <span class="bg-sky-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full">
                            {{ $pendingResetCount }} Baru
                        </span>
                    @endif
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftar pesan bantuan yang dikirimkan oleh pengguna/pengurus melalui halaman login.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Pengirim</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Akun / Kontak</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Isi Pesan Permohonan</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Status</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Waktu</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($resetRequests as $req)
                        <tr class="hover:bg-gray-50 {{ $req->isPending() ? 'bg-sky-50/40' : '' }}">
                            <td class="px-4 py-3 font-semibold text-gray-800 text-xs">{{ $req->name }}</td>
                            <td class="px-4 py-3 text-xs text-gray-600">
                                <div class="font-medium text-slate-800">{{ $req->username_or_email }}</div>
                                @if($req->phone)
                                    <div class="text-gray-400 text-[11px]"><i class="fab fa-whatsapp mr-1 text-emerald-600"></i>{{ $req->phone }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-700 max-w-xs">
                                <p class="line-clamp-2" title="{{ $req->message }}">{{ $req->message }}</p>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if ($req->isPending())
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-700">
                                        <i class="fas fa-clock text-[10px]"></i> Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">
                                        <i class="fas fa-check text-[10px]"></i> Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center text-xs text-gray-400 whitespace-nowrap">
                                {{ $req->created_at->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    @php
                                        // Cari user terkait jika ada
                                        $matchedUser = \App\Models\User::where('username', $req->username_or_email)
                                            ->orWhere('email', $req->username_or_email)
                                            ->first();
                                    @endphp
                                    @if($matchedUser)
                                        <a href="{{ route('admin.users.edit', $matchedUser) }}"
                                           class="px-2.5 py-1 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition flex items-center gap-1"
                                           title="Reset password pengguna ini langsung">
                                            <i class="fas fa-key text-[10px]"></i>
                                            <span>Reset Password</span>
                                        </a>
                                    @endif

                                    @if ($req->isPending())
                                        <form method="POST" action="{{ route('admin.password-requests.resolve', $req) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition flex items-center gap-1"
                                                    title="Tandai permohonan ini sudah selesai">
                                                <i class="fas fa-check-double text-[10px] text-emerald-600"></i>
                                                <span>Selesai</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400 text-xs">
                                Belum ada permohonan bantuan lupa password dari pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Organization Overview (for superadmin monitoring) --}}
    <div class="clay-card p-6">
        <h2 class="text-base font-bold text-gray-800 mb-4">
            <i class="fas fa-building text-emerald-600 mr-2"></i>Ringkasan Semua Organisasi
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Nama UPZ / Organisasi</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Kode</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Jenis</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Pengguna</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Penerimaan ZIS</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Penyaluran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($organizations as $org)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $org->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $org->code }}</td>
                            <td class="px-4 py-3 text-gray-500 text-xs">{{ $org->institution_type }}</td>
                            <td class="px-4 py-3 text-center text-gray-700">{{ $org->users_count }}</td>
                            <td class="px-4 py-3 text-center text-emerald-700 font-medium">{{ number_format($org->zis_collections_count) }}</td>
                            <td class="px-4 py-3 text-center text-blue-700 font-medium">{{ number_format($org->zis_distributions_count) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada organisasi terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
function confirmApprove(formId, userName) {
    Swal.fire({
        title: 'Verifikasi & Aktifkan?',
        html: `Apakah Anda yakin ingin memverifikasi dan mengaktifkan akun <b>${userName}</b>?<br><span class="text-xs text-slate-500 mt-1 block">Pengguna akan langsung dapat masuk ke sistem.</span>`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#059669',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: '<i class="fas fa-check mr-1.5"></i>Ya, Aktifkan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-2xl shadow-xl border border-slate-200',
            confirmButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs',
            cancelButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

function confirmSuspend(formId, userName) {
    Swal.fire({
        title: 'Nonaktifkan Akun?',
        html: `Apakah Anda yakin ingin menonaktifkan akun <b>${userName}</b>?<br><span class="text-xs text-slate-500 mt-1 block">Pengguna tidak akan dapat mengakses aplikasi sementara waktu.</span>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: '<i class="fas fa-pause mr-1.5"></i>Ya, Nonaktifkan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-2xl shadow-xl border border-slate-200',
            confirmButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs',
            cancelButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

function confirmReactivate(formId, userName) {
    Swal.fire({
        title: 'Aktifkan Kembali Akun?',
        html: `Apakah Anda yakin ingin mengaktifkan kembali akun <b>${userName}</b>?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#059669',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: '<i class="fas fa-rotate-right mr-1.5"></i>Ya, Aktifkan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-2xl shadow-xl border border-slate-200',
            confirmButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs',
            cancelButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

function promptReject(formId, inputId, userName) {
    Swal.fire({
        title: 'Tolak Pendaftaran Akun',
        html: `<div class="text-xs text-slate-600 mb-2">Tuliskan alasan penolakan untuk akun <b>${userName}</b>:</div>`,
        input: 'textarea',
        inputPlaceholder: 'Tuliskan alasan penolakan (contoh: Dokumen SK belum sesuai atau identitas tidak valid)...',
        inputAttributes: {
            'aria-label': 'Alasan penolakan',
            'rows': 3
        },
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: '<i class="fas fa-ban mr-1.5"></i>Konfirmasi Penolakan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Alasan penolakan wajib diisi agar pengguna mengetahui penyebabnya.';
            }
        },
        customClass: {
            popup: 'rounded-2xl shadow-xl border border-slate-200',
            confirmButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs',
            cancelButton: 'px-4 py-2.5 rounded-xl font-semibold text-xs',
            input: 'text-xs rounded-xl border border-slate-300'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(inputId).value = result.value;
            document.getElementById(formId).submit();
        }
    });
}
</script>
@endpush
