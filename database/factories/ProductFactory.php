<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        $optionsType = [
            'eletronicos', 
            'livros', 
            'jogos', 
            'acessorios', 
            'brinquedos', 
            'games', 
            'roupas', 
            'perfumaria'
        ];
    
        shuffle($optionsType);

        return [
            'user_id'                => User::factory(),
            'name'                   => $this->faker->name(),
            'description'            => $this->faker->sentence(50),
            'type'                   => $optionsType[0],
            'image'                  => 'https://source.unsplash.com/random',
            'price'                  => $this->faker->numberBetween(0, 500),
            'quantity_inventory'     => $this->faker->numberBetween(0, 30),
        ];
    }
}
