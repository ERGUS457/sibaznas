<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form (Organisasi + Akun).
     */
    public function edit()
    {
        $upz = Auth::user()->upzProfile;
        $user = Auth::user();
        return view('profile.edit', compact('upz', 'user'));
    }

    /**
     * Update the organization profile & akun.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
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
            // akun
            'user_name' => ['nullable','string','max:255'],
            'user_email' => ['nullable','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'user_phone' => ['nullable','string','max:20'],
        ]);

        // Update UPZ profile
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

        // Update akun user (jika diisi)
        $userDirty = false;
        if (!empty($validated['user_name']) && $validated['user_name'] !== $user->name) {
            $user->name = $validated['user_name'];
            $userDirty = true;
        }
        if (!empty($validated['user_email']) && $validated['user_email'] !== $user->email) {
            $user->email = $validated['user_email'];
            $userDirty = true;
        }
        if (array_key_exists('user_phone', $validated)) {
            if ($validated['user_phone'] !== $user->phone) {
                $user->phone = $validated['user_phone'];
                $userDirty = true;
            }
        }
        if ($userDirty) $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil organisasi & akun berhasil diperbarui.');
    }
}
