<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(1)->create([
            'user_id'    => 1,
            'created_at' => now()->subDays(2),
            'date'       => now()->subDays(2)
        ]);
    }
}
