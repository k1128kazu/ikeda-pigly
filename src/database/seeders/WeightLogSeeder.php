<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightLog;

class WeightLogSeeder extends Seeder
{
    public function run()
    {
        WeightLog::truncate();
        \App\Models\WeightLog::factory()->count(30)->create();
    }
}
