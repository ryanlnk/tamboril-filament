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
            'date' => today(),
            'total' => 99.90,
            'bank_account_id' => 1,
            'payment_id' => 1,
            'customer_id' => 1,
            'user_id' => 1
        ]);
    }
}
