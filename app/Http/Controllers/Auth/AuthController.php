<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('portal');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = trim($request->input('username'));
        $fieldType  = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $loginInput,
            'password' => $request->input('password'),
        ];

        try {
            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                $request->session()->regenerate();

                $user = Auth::user();

                // Cek status akun
                if ($user->isPending()) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('pending-approval')
                        ->with('info', 'Akun Anda masih menunggu verifikasi dari administrator.');
                }

                if ($user->isRejected()) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return back()->withErrors([
                        'username' => 'Pendaftaran akun Anda ditolak oleh administrator.' .
                            ($user->rejection_reason ? ' Alasan: ' . $user->rejection_reason : ''),
                    ])->onlyInput('username');
                }

                return redirect()->intended(route('portal'))->with(
                    'success',
                    'Selamat datang kembali, ' . $user->name . '!'
                );
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Login error: ' . $e->getMessage());

            return back()->withErrors([
                'username' => 'Gagal menghubungkan ke server database: ' . $e->getMessage(),
            ])->onlyInput('username');
        }

        return back()->withErrors([
            'username' => 'Kombinasi username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Kirim permohonan bantuan lupa password ke administrator.
     */
    public function sendForgotPasswordRequest(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'username_or_email' => ['required', 'string', 'max:255'],
            'phone'             => ['nullable', 'string', 'max:30'],
            'message'           => ['required', 'string', 'max:1000'],
        ], [
            'name.required'              => 'Nama lengkap atau nama pengurus wajib diisi.',
            'username_or_email.required' => 'Username atau email akun wajib diisi.',
            'message.required'           => 'Pesan permohonan wajib diisi.',
        ]);

        \App\Models\PasswordResetRequest::create([
            'name'              => $validated['name'],
            'username_or_email' => $validated['username_or_email'],
            'phone'             => $validated['phone'] ?? null,
            'message'           => $validated['message'],
            'status'            => 'pending',
        ]);

        return back()->with('success', 'Permohonan reset password Anda telah berhasil dikirim ke Administrator. Admin akan segera meninjau permohonan akun Anda.');
    }
}
