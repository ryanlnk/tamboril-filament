<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BankAccount::create(['name' => 'Banco do Brasil']);
        BankAccount::create(['name' => 'Bradesco']);
        BankAccount::create(['name' => 'Itaú']);
    }
}
