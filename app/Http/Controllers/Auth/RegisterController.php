<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Upz\UpzProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Step 1: Tampilkan form pendaftaran akun.
     */
    public function showStep1()
    {
        return view('auth.register-step1');
    }

    /**
     * Step 1: Proses validasi dan simpan data akun sementara ke session.
     */
    public function submitStep1(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'username'              => ['required', 'string', 'max:50', 'unique:users,username', 'alpha_dash'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'                 => ['nullable', 'string', 'max:20'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'         => 'Nama lengkap wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'username.alpha_dash'   => 'Username hanya boleh berisi huruf, angka, tanda minus, dan underscore.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        // Simpan sementara ke session (hash password)
        session([
            'register_step1' => [
                'name'     => $validated['name'],
                'username' => $validated['username'],
                'email'    => $validated['email'],
                'phone'    => $validated['phone'] ?? null,
                'password' => Hash::make($validated['password']),
            ],
        ]);

        return redirect()->route('register.step2');
    }

    /**
     * Step 2: Tampilkan form data organisasi/UPZ.
     */
    public function showStep2()
    {
        // Pastikan step 1 sudah diisi
        if (!session('register_step1')) {
            return redirect()->route('register.step1')
                ->with('error', 'Silakan isi data akun terlebih dahulu.');
        }

        return view('auth.register-step2');
    }

    /**
     * Step 2: Proses pembuatan akun User + UpzProfile.
     */
    public function submitStep2(Request $request)
    {
        // Pastikan step 1 sudah diisi
        if (!session('register_step1')) {
            return redirect()->route('register.step1')
                ->with('error', 'Sesi pendaftaran kedaluwarsa. Silakan ulangi dari awal.');
        }

        $validated = $request->validate([
            'upz_name'             => ['required', 'string', 'max:255'],
            'upz_code'             => ['required', 'string', 'max:50', 'unique:upz_profiles,code'],
            'institution_type'     => ['required', 'string'],
            'parent_baznas_level'  => ['required', 'string'],
            'parent_baznas_name'   => ['required', 'string', 'max:255'],
            'sk_number'            => ['nullable', 'string', 'max:100'],
            'sk_date'              => ['nullable', 'date'],
            'sk_valid_until'       => ['nullable', 'date', 'after_or_equal:sk_date'],
            'address'              => ['nullable', 'string'],
            'city'                 => ['nullable', 'string', 'max:100'],
            'province'             => ['nullable', 'string', 'max:100'],
            'phone'                => ['nullable', 'string', 'max:20'],
            'email'                => ['nullable', 'email', 'max:255'],
            'chairman_name'        => ['nullable', 'string', 'max:255'],
            'secretary_name'       => ['nullable', 'string', 'max:255'],
            'treasurer_name'       => ['nullable', 'string', 'max:255'],
            'bank_name'            => ['nullable', 'string', 'max:100'],
            'bank_account_number'  => ['nullable', 'string', 'max:50'],
            'bank_account_name'    => ['nullable', 'string', 'max:255'],
            'amil_share_percentage'=> ['nullable', 'numeric', 'min:0', 'max:12.50'],
        ], [
            'upz_name.required'           => 'Nama UPZ/Organisasi wajib diisi.',
            'upz_code.required'           => 'Kode UPZ wajib diisi.',
            'upz_code.unique'             => 'Kode UPZ sudah digunakan oleh organisasi lain.',
            'institution_type.required'   => 'Jenis lembaga wajib dipilih.',
            'parent_baznas_level.required'=> 'Tingkat BAZNAS induk wajib dipilih.',
            'parent_baznas_name.required' => 'Nama BAZNAS induk wajib diisi.',
        ]);

        $step1 = session('register_step1');
        $upz = null;

        try {
            // Buat UPZ Profile
            $upz = UpzProfile::create([
                'name'                  => $validated['upz_name'],
                'code'                  => strtoupper($validated['upz_code']),
                'institution_type'      => $validated['institution_type'],
                'parent_baznas_level'   => $validated['parent_baznas_level'],
                'parent_baznas_name'    => $validated['parent_baznas_name'],
                'sk_number'             => $validated['sk_number'] ?? null,
                'sk_date'               => $validated['sk_date'] ?? null,
                'sk_valid_until'        => $validated['sk_valid_until'] ?? null,
                'address'               => $validated['address'] ?? null,
                'city'                  => $validated['city'] ?? null,
                'province'              => $validated['province'] ?? null,
                'phone'                 => $validated['phone'] ?? null,
                'email'                 => $validated['email'] ?? null,
                'chairman_name'         => $validated['chairman_name'] ?? null,
                'secretary_name'        => $validated['secretary_name'] ?? null,
                'treasurer_name'        => $validated['treasurer_name'] ?? null,
                'bank_name'             => $validated['bank_name'] ?? null,
                'bank_account_number'   => $validated['bank_account_number'] ?? null,
                'bank_account_name'     => $validated['bank_account_name'] ?? null,
                'amil_share_percentage' => $validated['amil_share_percentage'] ?? 12.50,
                'is_active'             => true,
            ]);

            // Buat User dengan status pending
            User::create([
                'name'           => $step1['name'],
                'username'       => $step1['username'],
                'email'          => $step1['email'],
                'phone'          => $step1['phone'],
                'password'       => $step1['password'],
                'role'           => 'pengurus_upz',
                'upz_profile_id' => $upz->id,
                'status'         => 'pending',
            ]);
        } catch (\Throwable $e) {
            if ($upz && $upz->exists) {
                $upz->delete();
            }
            \Illuminate\Support\Facades\Log::error('Registration error: ' . $e->getMessage());
            return back()->withErrors(['upz_name' => 'Terjadi kesalahan saat menyimpan data pendaftaran: ' . $e->getMessage()])->withInput();
        }

        // Hapus session step 1
        session()->forget('register_step1');

        return redirect()->route('pending-approval')
            ->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi dari administrator.');
    }
}
