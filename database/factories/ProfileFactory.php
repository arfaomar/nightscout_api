<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    protected $model = \App\Models\Profile::class;

    public function definition()
    {
        $profileName = 'LocalProfile'.$this->faker->randomNumber(3);

        return [
            '_id' => Str::random(24),
            'defaultProfile' => $profileName,
            'date' => now()->getTimestampMs(),
            'created_at' => now(),
            'startDate' => now(),
            'store' => [
                $profileName => [
                    'dia' => 5,
                    'carbratio' => [
                        ['time' => '00:00', 'timeAsSeconds' => 0, 'value' => 5],
                    ],
                    'sens' => [
                        ['time' => '00:00', 'timeAsSeconds' => 0, 'value' => 5],
                    ],
                    'basal' => [
                        ['time' => '00:00', 'timeAsSeconds' => 0, 'value' => 5],
                    ],
                    'target_low' => [
                        ['time' => '00:00', 'timeAsSeconds' => 0, 'value' => 80],
                    ],
                    'target_high' => [
                        ['time' => '00:00', 'timeAsSeconds' => 0, 'value' => 108],
                    ],
                    'units' => 'mg/dl',
                    'timezone' => 'GMT',
                ],
            ],
            'extra_data' => [],
        ];
    }
}
