<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'img' => 'dummy/items/sample.jpg',
            'price' => $this->faker->numberBetween(100, 10000),
            'stock' => 1,
            'brand' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'stripe_price_id' => 'test_price_id',
        ];
    }

    public function outOfStock()
    {
        return $this->state(fn () => ['stock' => 0]);
    }
}
