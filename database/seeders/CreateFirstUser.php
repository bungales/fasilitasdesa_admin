<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        // === 1. Buat Super Admin utama ===
        if (!User::where('email', 'bunga@gmail.com')->exists()) {
            User::create([
                'name' => 'Bunga',
                'email' => 'bunga@gmail.com',
                'password' => Hash::make('bunga12345'),
                'role' => 'Super Admin',
                'email_verified_at' => now(),
            ]);
        }

        // === 2. Buat Administrator ===
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12345'),
                'role' => 'Administrator',
                'email_verified_at' => now(),
            ]);
        }

        // === 3. Buat 100 user tambahan (Pelanggan & Mitra) ===
        for ($i = 1; $i <= 100; $i++) {
            $email = "user$i@example.com";

            if (User::where('email', $email)->exists()) {
                continue;
            }

            // Acak role antara Pelanggan dan Mitra
            $role = $i % 2 == 0 ? 'Pelanggan' : 'Mitra';

            User::create([
                'name' => "User $i",
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => $role,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
