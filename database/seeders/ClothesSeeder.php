<?php

namespace Database\Seeders;

use App\Models\Clothes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clothes::create([
            'name' => 'Camisa Polo Masculina',
            'color' => 'Branca',
            'size' => 'G',
            'genre' => 'Masculino',
            'quantity' => 10,
            'buy_price' => 12.90,
            'sale_price' => 39.99,
            'date' => today()
        ]);

        Clothes::create([
            'name' => 'Camisa Brasil',
            'color' => 'Amarela',
            'size' => 'M',
            'genre' => 'Feminina',
            'quantity' => 10,
            'buy_price' => 69.90,
            'sale_price' => 239.99,
            'date' => today()
        ]);
    }
}
