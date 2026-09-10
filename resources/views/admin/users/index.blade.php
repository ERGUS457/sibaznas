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
    <div class="grid grid-cols-3 gap-4">
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-amber-600">{{ $pendingCount }}</div>
            <div class="text-sm text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i>Menunggu Verifikasi</div>
        </div>
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-emerald-600">{{ $activeCount }}</div>
            <div class="text-sm text-gray-500 mt-1"><i class="fas fa-circle-check mr-1"></i>Akun Aktif</div>
        </div>
        <div class="clay-card p-5 text-center">
            <div class="text-3xl font-bold text-red-500">{{ $rejectedCount }}</div>
            <div class="text-sm text-gray-500 mt-1"><i class="fas fa-ban mr-1"></i>Ditolak</div>
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
                        <th class="text-left px-5 py-3.5 font-semibold text-gray-600 text-xs uppercase tracking-wide">Organisasi / UPZ</th>
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
                                <div class="text-gray-400 text-xs mt-0.5">@{{ $user->username }} · {{ $user->email }}</div>
                            </td>
                            <td class="px-5 py-4">
                                @if ($user->upzProfile)
                                    <div class="font-medium text-gray-700">{{ $user->upzProfile->name }}</div>
                                    <div class="text-gray-400 text-xs mt-0.5">{{ $user->upzProfile->code }} · {{ $user->upzProfile->institution_type }}</div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada UPZ</span>
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
                                <div class="flex items-center justify-center gap-2">
                                    @if ($user->isPending())
                                        {{-- Approve --}}
                                        <form method="POST" action="{{ route('admin.users.approve', $user) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-semibold hover:bg-emerald-700 transition-colors"
                                                    onclick="return confirm('Verifikasi dan aktifkan akun {{ addslashes($user->name) }}?')">
                                                <i class="fas fa-check mr-1"></i>Setujui
                                            </button>
                                        </form>
                                        {{-- Reject Button --}}
                                        <button @click="showRejectForm = !showRejectForm"
                                                class="px-3 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded-lg text-xs font-semibold hover:bg-red-100 transition-colors">
                                            <i class="fas fa-ban mr-1"></i>Tolak
                                        </button>
                                    @elseif ($user->isActive() && !$user->isSuperAdmin())
                                        {{-- Suspend --}}
                                        <form method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-200 transition-colors"
                                                    onclick="return confirm('Nonaktifkan akun {{ addslashes($user->name) }}?')">
                                                <i class="fas fa-pause mr-1"></i>Nonaktifkan
                                            </button>
                                        </form>
                                    @elseif ($user->isRejected())
                                        {{-- Reactivate --}}
                                        <form method="POST" action="{{ route('admin.users.reactivate', $user) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-lg text-xs font-semibold hover:bg-emerald-100 transition-colors"
                                                    onclick="return confirm('Aktifkan kembali akun {{ addslashes($user->name) }}?')">
                                                <i class="fas fa-rotate-right mr-1"></i>Aktifkan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Superadmin</span>
                                    @endif
                                </div>

                                {{-- Reject Form (inline, collapsible) --}}
                                <div x-show="showRejectForm" x-cloak class="mt-3">
                                    <form method="POST" action="{{ route('admin.users.reject', $user) }}">
                                        @csrf
                                        <textarea name="rejection_reason" rows="2" required
                                                  placeholder="Alasan penolakan (wajib diisi)..."
                                                  class="w-full text-xs px-3 py-2 border border-red-200 rounded-lg focus:outline-none focus:border-red-400 resize-none"></textarea>
                                        <div class="flex gap-2 mt-1.5">
                                            <button type="submit" class="flex-1 py-1.5 bg-red-600 text-white rounded-lg text-xs font-semibold hover:bg-red-700">
                                                Konfirmasi Penolakan
                                            </button>
                                            <button type="button" @click="showRejectForm = false"
                                                    class="px-3 py-1.5 border border-gray-200 rounded-lg text-xs text-gray-500 hover:bg-gray-50">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
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
