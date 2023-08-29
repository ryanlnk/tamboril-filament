<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            AccessorySeeder::class,
            AuthorSeeder::class,
            BankAccountSeeder::class,
            BookSeeder::class,
            ClothesSeeder::class,
            CustomerSeeder::class,
            PaymentSeeder::class,
            UserSeeder::class,
            SaleSeeder::class,
        ]);
    }
}
