<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 3),
            'date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 40, 95),
            'calories' => $this->faker->numberBetween(1000, 2500),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->realText(30),
        ];
    }
}
