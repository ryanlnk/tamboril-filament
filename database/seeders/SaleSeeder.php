<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::create([
            'order' => 'OR-12345',
            'date' => today(),
            'total' => 99.90,
            'bank_account_id' => 1,
            'payment_id' => 1,
            'customer_id' => 1,
            'seller_id' => 1
        ]);

        Sale::create([
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
