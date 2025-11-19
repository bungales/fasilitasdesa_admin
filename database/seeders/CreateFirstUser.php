<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Bunga',
            'email' => 'bunga@gmail.com',
            'password' => Hash::make('bunga'),
        ]);
    }
}
