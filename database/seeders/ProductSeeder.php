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

        Product::create([
            'name' => 'Camisa de Moleton',
            'quantity' => 12,
            'buy_price' => 15.99,
            'sale_price' => 230.59,
            'date' => today(),
            'category_id' => 1,
            'color' => 'Preto',
            'size' => 'M',
            'genre' => 'Masculino',
            'description' => 'Teste'
        ]);

        Product::create([
            'name' => 'Algum Produto',
            'quantity' => 20,
            'buy_price' => 0.99,
            'sale_price' => 2.78,
            'date' => today(),
            'category_id' => 3,
            'description' => 'Teste'
        ]);
    }
}
