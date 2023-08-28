<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
      
        Product::factory()
        ->count(50)
        ->state([
            'image'=>'products/iphone.jpg'
        ])
        ->for(Category::factory()->state([
            'name' => 'Electrónicos',
        ]))
        ->create();

        Product::factory()
        ->count(50)
        ->state([
            'image'=>'products/ropa.jpg'
        ])
        ->for(Category::factory()->state([
            'name' => 'Ropa',
        ]))
        ->create();

        Product::factory()
        ->count(50)
        ->state([
            'image'=>'products/calzado.jpg'
        ])
        ->for(Category::factory()->state([
            'name' => 'Calzado',
        ]))
        ->create();

        Product::factory()
        ->count(50)
        ->state([
            'image'=>'products/lineablanca.jpg'
        ])
        ->for(Category::factory()->state([
            'name' => 'Línea Blanca',
        ]))
        ->create();        
    }
}
