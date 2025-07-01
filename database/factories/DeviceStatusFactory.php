<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeviceStatusFactory extends Factory
{
    protected $model = \App\Models\DeviceStatus::class;

    public function definition()
    {
        $extraFields = [
            'firmwareVersion' => $this->faker->randomElement(['1.0', '1.2.3', '2.0']),
            'batteryHealth'   => $this->faker->randomElement(['good', 'normal', 'bad']),
            'customFlag'      => $this->faker->boolean(),
            'randomText'      => $this->faker->sentence(),
            'meta'            => [
                'code' => $this->faker->randomNumber(3),
                'desc' => $this->faker->word(),
                'test' => [
                    'nested' => $this->faker->word(),
                    'array' => [
                        $this->faker->word(),
                        $this->faker->word(),
                        $this->faker->word()
                    ]
                ]
            ]
        ];

        return [
            '_id' => Str::random(24),
            'device' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(),
            'uploaderBattery' => $this->faker->numberBetween(20, 100),
            'isCharging' => $this->faker->boolean(),
            'configuration' => [],
            'pump_id' => null,
            'pump' => [],
            'uploader_id' => null,
            'uploader' => [],
            'xdripjs_id' => null,
            'xdripjs' => [],
            'extra_data' => $extraFields, 
        ];
    }
}
