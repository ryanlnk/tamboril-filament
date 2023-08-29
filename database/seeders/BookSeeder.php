<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'name' => 'Ponto de Inflexão',
            'ISBN' => '9192830',
            'quantity' => 3,
            'buy_price' => 5.99,
            'sale_price' => 23.59,
            'date' => today(),
            'box' => false,
        ]);

        Book::create([
            'name' => 'Dom Casmurro',
            'ISBN' => '9192894',
            'quantity' => 1,
            'buy_price' => 3.99,
            'sale_price' => 17.59,
            'date' => today(),
            'box' => false,
        ]);
    }
}
