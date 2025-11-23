<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;

class WeightTargetSeeder extends Seeder
{
    public function run(): void
    {
        WeightTarget::create([
            'user_id'        => 1,      // Test User
            'target_weight'  => 60.0,   // 目標体重（自然で現実的）
        ]);
    }
}
