<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActivityFactory extends Factory
{
    protected $model = \App\Models\Activity::class;

    public function definition(): array
    {
        return [
            '_id' => Str::random(24),
            'eventType' => 'Exercise',
            'duration' => $this->faker->numberBetween(10, 120),
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now')->format('Y-m-d H:i:s'),
            'notes' => $this->faker->optional()->sentence(),
            'enteredBy' => $this->faker->userName(),
            'extra_data' => [
                'intensity' => $this->faker->randomElement(['light', 'moderate', 'heavy']),
                'type' => $this->faker->randomElement(['run', 'bike', 'swim']),
            ],
        ];
    }
}
