<?php

namespace Database\Seeders;

use App\Models\Upz\UpzProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $upz = UpzProfile::first();

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator UPZ BAZNAS',
                'email' => 'admin@upz.baznas.go.id',
                'password' => Hash::make('admin123'),
                'role' => 'superadmin',
                'phone' => '081234567890',
                'upz_profile_id' => $upz?->id,
            ]
        );
    }
}
