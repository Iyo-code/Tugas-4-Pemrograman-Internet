<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kampus.test'],
            [
                'name' => 'Admin Kampus',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
