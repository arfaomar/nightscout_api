<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeviceStatusFactory extends Factory
{
    protected $model = \App\Models\DeviceStatus::class;

    public function definition()
    {
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
        ];
    }
}
