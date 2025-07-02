<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FoodFactory extends Factory
{
    protected $model = \App\Models\Food::class;

    public function definition(): array
    {
        $foodNames = ['Banana', 'Apple', 'Pizza Margherita', 'Yogurt', 'Rice', 'Chocolate', 'Granola Bar'];
        $categories = ['fruit', 'snack', 'main', 'dessert', 'drink'];

        $extra = [
            'name'       => $this->faker->randomElement($foodNames),
            'category'   => $this->faker->randomElement($categories),
            'carbs'      => $this->faker->numberBetween(5, 120),
            'brand'      => $this->faker->optional()->company(),
            'servingSize'=> $this->faker->optional()->randomElement(['100g', '1 Stück', '250ml', 'Packung']),
        ];

        return [
            '_id'        => Str::random(24),
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s'),
            'extra_data' => $extra,
        ];
    }
}
