<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TreatmentFactory extends Factory
{
    public function definition(): array
    {
        $eventTypes = ['Bolus', 'Meal', 'Correction', 'Exercise', 'Note'];

        return [
            '_id' => Str::random(24),
            'eventType' => $this->faker->randomElement($eventTypes),
            'created_at' => $this->faker->dateTimeBetween('-5 days', 'now'),
            'glucose' => $this->faker->optional()->randomFloat(1, 60, 400),
            'glucoseType' => $this->faker->optional()->randomElement(['Finger', 'Sensor']),
            'carbs' => $this->faker->optional()->randomFloat(1, 0, 150),
            'protein' => $this->faker->optional()->randomFloat(1, 0, 50),
            'fat' => $this->faker->optional()->randomFloat(1, 0, 60),
            'insulin' => $this->faker->optional()->randomFloat(2, 0, 25),
            'units' => $this->faker->optional()->randomElement(['U', 'IU']),
            'transmitterId' => $this->faker->optional()->regexify('[A-Z0-9]{6}'),
            'sensorCode' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'notes' => $this->faker->optional()->sentence(),
            'enteredBy' => $this->faker->randomElement(['AndroidAPS', 'Nightscout Web', 'Manual']),
            'extra_data' => [
                'appVersion' => $this->faker->randomElement(['3.2.0', '3.1.1']),
                'source' => $this->faker->optional()->randomElement(['auto', 'user']),
                'customFlag' => $this->faker->boolean(),
                'tags' => $this->faker->optional()->words(2, false),
            ],
        ];
    }
}
