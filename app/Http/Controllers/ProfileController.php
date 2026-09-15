<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $upz = auth()->user()->upzProfile;
        $user = auth()->user();
        return view('profile.edit', compact('upz', 'user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $upz = $user->upzProfile;

        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'code' => ['required','string','max:50', Rule::unique('upz_profiles','code')->ignore($upz->id)],
            'address' => ['nullable','string'],
            'city' => ['nullable','string','max:100'],
            'province' => ['nullable','string','max:100'],
            'phone' => ['nullable','string','max:20'],
            'email' => ['nullable','email','max:255'],
            'logo' => ['nullable','image','max:2048'],
            // akun — opsional, hanya jika diisi
            'account_name' => ['nullable','string','max:255'],
            'account_username' => ['nullable','string','max:50', Rule::unique('users','username')->ignore($user->id)],
            'account_email' => ['nullable','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'account_phone' => ['nullable','string','max:20'],
            'current_password' => ['nullable','string','required_with:password'],
            'password' => ['nullable','string','min:8','confirmed'],
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'current_password.required_with' => 'Masukkan password saat ini untuk mengganti password.',
        ]);

        // Update organisasi
        $upz->fill([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'province' => $validated['province'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'] ?? null,
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $data = base64_encode(file_get_contents($file->getRealPath()));
            $mime = $file->getMimeType();
            $upz->logo_path = "data:{$mime};base64,{$data}";
        }
        $upz->save();

        // Update akun
        $userDirty = false;
        if (!empty($validated['account_name']) && $validated['account_name'] !== $user->name) {
            $user->name = $validated['account_name'];
            $userDirty = true;
        }
        if (!empty($validated['account_username']) && $validated['account_username'] !== $user->username) {
            $user->username = $validated['account_username'];
            $userDirty = true;
        }
        if (!empty($validated['account_email']) && $validated['account_email'] !== $user->email) {
            $user->email = $validated['account_email'];
            $userDirty = true;
        }
        if (array_key_exists('account_phone', $validated) && $validated['account_phone'] !== $user->phone) {
            $user->phone = $validated['account_phone'];
            $userDirty = true;
        }
        if (!empty($validated['password'])) {
            if (empty($validated['current_password']) || !Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
            }
            $user->password = Hash::make($validated['password']);
            $userDirty = true;
        }
        // backward compat: field lama user_name/user_email masih didukung jika ada
        if (!empty($request->input('user_name')) && empty($validated['account_name'])) {
            $user->name = $request->input('user_name');
            $userDirty = true;
        }
        if ($userDirty) $user->save();

        return redirect()->route('portal')->with('success', 'Profil organisasi & akun berhasil diperbarui.');
    }
}
