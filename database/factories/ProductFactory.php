<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'            => User::factory(),
            'name'               => $this->faker->name(),
            'description'        => $this->faker->sentence(50),
            'image'              => 'https://source.unsplash.com/random',
            'price'              => $this->faker->numberBetween(0, 20),
            'quantity_inventory' => $this->faker->numberBetween(0, 30)
        ];
    }
}
