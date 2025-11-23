<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email'          => 'test@example.com',
            'password'       => bcrypt('password'),  // ← ログイン時は password
            'height'         => 170,
            'initial_weight' => 65.0,
        ]);
    }
}
