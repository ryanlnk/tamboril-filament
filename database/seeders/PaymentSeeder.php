<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create(['name' => 'Cartão de Crédito']);
        Payment::create(['name' => 'Cartão de Débito']);
        Payment::create(['name' => 'Pix']);
        Payment::create(['name' => 'Dinheiro']);
    }
}
