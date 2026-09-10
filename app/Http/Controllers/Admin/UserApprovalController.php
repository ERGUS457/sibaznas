<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Upz\UpzProfile;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /**
     * Daftar semua pengguna yang terdaftar (superadmin only).
     */
    public function index(Request $request)
    {
        $query = User::with('upzProfile')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users        = $query->paginate(20)->withQueryString();
        $pendingCount = User::where('status', 'pending')->count();
        $activeCount  = User::where('status', 'active')->count();
        $rejectedCount= User::where('status', 'rejected')->count();

        // Ringkasan semua organisasi untuk superadmin
        $organizations = UpzProfile::withCount([
            'users',
            'zisCollections',
            'zisDistributions',
        ])->orderBy('name')->get();

        // Permohonan reset password dari login
        $resetRequests = \App\Models\PasswordResetRequest::latest()->take(30)->get();
        $pendingResetCount = \App\Models\PasswordResetRequest::where('status', 'pending')->count();

        return view('admin.users.index', compact(
            'users',
            'pendingCount',
            'activeCount',
            'rejectedCount',
            'organizations',
            'resetRequests',
            'pendingResetCount'
        ));
    }

    /**
     * Setujui akun user.
     */
    public function approve(User $user)
    {
        if (!$user->isPending()) {
            return back()->with('error', 'Akun ini sudah pernah diproses sebelumnya.');
        }

        $user->update([
            'status'      => 'active',
            'verified_at' => now(),
        ]);

        return back()->with('success', "Akun '{$user->name}' ({$user->username}) berhasil diverifikasi dan diaktifkan.");
    }

    /**
     * Tolak akun user.
     */
    public function reject(Request $request, User $user)
    {
        $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ], [
            'rejection_reason.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $user->update([
            'status'           => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return back()->with('success', "Akun '{$user->name}' telah ditolak pendaftarannya.");
    }

    /**
     * Aktifkan kembali akun yang ditolak.
     */
    public function reactivate(User $user)
    {
        $user->update([
            'status'           => 'active',
            'rejection_reason' => null,
            'verified_at'      => now(),
        ]);

        return back()->with('success', "Akun '{$user->name}' berhasil diaktifkan kembali.");
    }

    /**
     * Nonaktifkan akun aktif (suspend).
     */
    public function suspend(User $user)
    {
        if ($user->isSuperAdmin()) {
            return back()->with('error', 'Tidak dapat menonaktifkan akun superadmin.');
        }

        $user->update(['status' => 'rejected', 'rejection_reason' => 'Akun dinonaktifkan oleh administrator.']);

        return back()->with('success', "Akun '{$user->name}' berhasil dinonaktifkan.");
    }

    /**
     * Tampilkan formulir edit pengguna.
     */
    public function edit(User $user)
    {
        $organizations = UpzProfile::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'organizations'));
    }

    /**
     * Perbarui data pengguna & opsi reset password.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'username'       => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone'          => ['nullable', 'string', 'max:30'],
            'role'           => ['required', 'in:superadmin,pengurus_upz,akuntan,baznas_supervisor'],
            'upz_profile_id' => ['nullable', 'exists:upz_profiles,id'],
            'status'         => ['required', 'in:pending,active,rejected'],
            'password'       => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username ini sudah digunakan pengguna lain.',
            'email.required'    => 'Alamat email wajib diisi.',
            'email.unique'      => 'Email ini sudah digunakan pengguna lain.',
            'password.min'      => 'Password baru minimal 8 karakter.',
            'password.confirmed'=> 'Konfirmasi password baru tidak cocok.',
        ]);

        $userData = [
            'name'           => $validated['name'],
            'username'       => $validated['username'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'] ?? null,
            'role'           => $validated['role'],
            'upz_profile_id' => $validated['upz_profile_id'] ?? null,
            'status'         => $validated['status'],
        ];

        if ($validated['status'] === 'active' && !$user->verified_at) {
            $userData['verified_at'] = now();
            $userData['rejection_reason'] = null;
        }

        if (!empty($validated['password'])) {
            $userData['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')->with(
            'success',
            "Data akun '{$user->name}' berhasil diperbarui" . (!empty($validated['password']) ? " beserta kata sandi baru." : ".")
        );
    }

    /**
     * Tandai permohonan reset password selesai diproses.
     */
    public function resolveResetRequest(Request $request, \App\Models\PasswordResetRequest $resetRequest)
    {
        $resetRequest->update([
            'status'      => 'resolved',
            'admin_notes' => $request->input('admin_notes', 'Sudah diproses oleh administrator.'),
            'resolved_at' => now(),
        ]);

        return back()->with('success', "Permohonan reset password dari '{$resetRequest->name}' telah ditandai selesai.");
    }
}
