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
        // === 1. Buat user utama kamu kalau belum ada ===
        if (!User::where('email', 'bunga@gmail.com')->exists()) {
            User::create([
                'name' => 'Bunga',
                'email' => 'bunga@gmail.com',
                'password' => Hash::make('bunga12345'),
            ]);
        }

        // === 2. Buat 100 user tambahan random ===
        for ($i = 1; $i <= 100; $i++) {
            $email = "user$i@example.com";

            // Kalau email sudah ada, skip
            if (User::where('email', $email)->exists()) {
                continue;
            }

            User::create([
                'name' => "User $i",
                'email' => $email,
                'password' => Hash::make('password'),  // password default
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
