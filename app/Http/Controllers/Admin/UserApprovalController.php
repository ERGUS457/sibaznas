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

        return view('admin.users.index', compact(
            'users',
            'pendingCount',
            'activeCount',
            'rejectedCount',
            'organizations'
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
}
