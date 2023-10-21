<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Product 1',
            'Product 2',
            'Product 3',
        ];

        foreach ($products as $productName)
        {
            Product::create([
                'name' => $productName,
                'slug' => str_replace(' ','-',strtolower($productName)),
                'category_id' => null,
                'price' => random_int(2000,5000),
                'is_active' => 1,
                'image' => null,
            ]);
        }
    }
}
