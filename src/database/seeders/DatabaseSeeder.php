<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            WeightTargetSeeder::class,
        ]);

        // WeightLog を35件作成
        \App\Models\WeightLog::factory(35)->create();
    }
}
