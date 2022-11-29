<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
            'type'        => $optionsType[0],
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
