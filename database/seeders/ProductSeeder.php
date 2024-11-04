<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Coke',
                'price' => 3.99,
                'available_quantity' => 100,
            ],
            [
                'name' => 'Pepsi',
                'price' => 6.885,
                'available_quantity' => 200,
            ],
            [
                'name' => 'Water',
                'price' => 0.5,
                'available_quantity' => 300,
            ],
            [
                'name' => 'Lemonade',
                'price' => 2,
                'available_quantity' => 400,
            ],
            [
                'name' => 'Lactasoy',
                'price' => 5.25,
                'available_quantity' => 500,
            ],
            [
                'name' => 'Fanta',
                'price' => 4.25,
                'available_quantity' => 600,
            ],
            [
                'name' => 'Monster',
                'price' => 4,
                'available_quantity' => 700,
            ],
            [
                'name' => 'Prime',
                'price' => 9.99,
                'available_quantity' => 800,
            ],
            [
                'name' => 'Red Bull',
                'price' => 4.5,
                'available_quantity' => 900,
            ],
            [
                'name' => 'Dr Pepper',
                'price' => 7.299,
                'available_quantity' => 1000,
            ],
        ];

        // Truncate Table
        DB::table('products')->truncate();

        foreach($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'available_quantity' => $product['available_quantity'],
            ]);
        }
    }
}
