<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'         => 1,
            'date'            => $this->faker->dateTimeBetween('-35 days', 'now')->format('Y-m-d'),
            'weight'          => $this->faker->randomFloat(1, 60, 70),

            // ★ カラム名を正しいものに修正！
            'calories'        => $this->faker->numberBetween(1200, 2500),
            'exercise_time'   => $this->faker->time('H:i', '01:30'),
            'exercise_content' => $this->faker->randomElement([
                'ウォーキング',
                'ストレッチ',
                '筋トレ',
                '軽い運動',
                '足上げ運動'
            ]),
        ];
    }
}
