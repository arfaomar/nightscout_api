<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    public function definition(): array
    {
        $directions = ['Flat', 'SingleUp', 'SingleDown', 'DoubleUp', 'DoubleDown', 'FortyFiveUp', 'FortyFiveDown', 'NONE'];

        return [
            '_id' => $this->faker->unique()->regexify('[a-z0-9]{24}'),
            'type' => $this->faker->randomElement(['sgv', 'mbg', 'cal']),
            'dateString' => $this->faker->dateTimeBetween('-2 days', 'now'),
            'date' => $this->faker->dateTimeBetween('-2 days', 'now')->getTimestamp() * 1000,
            'sgv' => $this->faker->numberBetween(40, 400),
            'direction' => $this->faker->optional()->randomElement($directions),
            'noise' => $this->faker->optional()->numberBetween(0, 3),
            'filtered' => $this->faker->optional()->randomFloat(2, 60, 400),
            'unfiltered' => $this->faker->optional()->randomFloat(2, 60, 400),
            'rssi' => $this->faker->optional()->numberBetween(10, 40),
            'extra_data' => [
                'device' => $this->faker->randomElement(['xdrip', 'Libre', 'G6', 'Simulated']),
                'rawbg' => $this->faker->optional()->numberBetween(40, 400),
                'customFlag' => $this->faker->optional()->boolean(),

            ],
        ];
    }
}
