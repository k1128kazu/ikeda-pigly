<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;

class WeightTargetSeeder extends Seeder
{
    public function run()
    {
        WeightTarget::truncate();

        for ($i = 1; $i <= 3; $i++) {
            WeightTarget::create([
                'user_id' => $i,
                'target_weight' => rand(50, 70),
            ]);
        }
    }
}
