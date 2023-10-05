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
        Product::create([
            'name' => 'Ponto de Inflexão',
            'quantity' => 2,
            'buy_price' => 5.99,
            'sale_price' => 23.59,
            'date' => today(),
            'category_id' => 2,
            'ISBN' => '9192830',
            'box' => false,
            'description' => 'Teste'
        ]);
    }
}
