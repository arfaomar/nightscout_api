<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StatusFactory extends Factory
{
    protected $model = \App\Models\Status::class;

    public function definition()
    {
        return [
            '_id' => Str::random(24),
            'apiEnabled' => $this->faker->boolean(),
            'carePortalEnabled' => $this->faker->boolean(),
            'head' => $this->faker->sha1(),
            'name' => 'nightscout',
            'version' => $this->faker->randomElement(['14.0.6', '15.1.1', '13.0.0']),
            'settings' => [
                'units' => $this->faker->randomElement(['mg/dl', 'mmol/l']),
                'theme' => $this->faker->randomElement(['default', 'color', 'dark']),
                'language' => $this->faker->randomElement(['de', 'en', 'fr']),
                'customTitle' => $this->faker->sentence(2),
                'nightMode' => $this->faker->boolean(),
                'thresholds' => [
                    'bg_high' => $this->faker->numberBetween(180, 250),
                    'bg_target_top' => $this->faker->numberBetween(140, 179),
                    'bg_target_bottom' => $this->faker->numberBetween(80, 139),
                    'bg_low' => $this->faker->numberBetween(40, 79),
                ],
            ],
            'extended_settings' => [
                'showRawbg' => $this->faker->randomElement(['always', 'never']),
                'alarmUrgentHigh' => $this->faker->boolean(),
                'alarmHigh' => $this->faker->boolean(),
            ],
            'extra_data' => [
                'meta' => [
                    'created_by' => $this->faker->userName(),
                    'updated_at' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                ],
            ],
        ];
    }
}
