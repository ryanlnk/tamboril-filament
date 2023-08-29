<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accessory::create([
            'name' => 'Agenda de criança',
            'quantity' => 2,
            'buy_price' => 2.90,
            'sale_price' => 8.99,
            'date' => today(),
            'category_id' => 1,
        ]);
    }
}
