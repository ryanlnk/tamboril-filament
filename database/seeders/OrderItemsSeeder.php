<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::create([
            'quantity' => '2',
            'sale_price' => 199.90,
            'order_id' => 1,
            'product_id' => 2,
        ]);

        OrderItem::create([
            'quantity' => '2',
            'sale_price' => 199.90,
            'order_id' => 1,
            'product_id' => 1,
        ]);

        OrderItem::create([
            'quantity' => '2',
            'sale_price' => 199.90,
            'order_id' => 2,
            'product_id' => 1,
        ]);
    }
}
