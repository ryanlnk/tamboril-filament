<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'order' => 'OR-12346',
            'date' => today(),
            'total' => 199.90,
            'bank_account_id' => 2,
            'payment_id' => 3,
            'customer_id' => 2,
            'seller_id' => 2
        ]);
    }
}
