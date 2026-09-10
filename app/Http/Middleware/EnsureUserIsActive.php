<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     * Pastikan user yang sudah login memiliki status 'active' (sudah diverifikasi admin).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->isPending()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('pending-approval')
                ->with('info', 'Akun Anda masih menunggu verifikasi dari administrator. Silakan coba lagi setelah mendapat konfirmasi.');
        }

        if ($user->isRejected()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors([
                    'username' => 'Pendaftaran akun Anda ditolak oleh administrator.' .
                        ($user->rejection_reason ? ' Alasan: ' . $user->rejection_reason : ''),
                ]);
        }

        return $next($request);
    }
}
