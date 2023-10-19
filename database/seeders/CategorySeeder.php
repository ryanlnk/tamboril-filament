<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Camiseta']);
        Category::create(['name' => 'Livro']);
        Category::create(['name' => 'Agenda']);
        Category::create(['name' => 'Bolsa']);
        Category::create(['name' => 'Caneca']);
        Category::create(['name' => 'Quadro de Cerâmica']);
    }
}
