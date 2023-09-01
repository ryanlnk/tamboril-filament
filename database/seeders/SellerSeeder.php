<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::create([
            'name'      => 'Ryan',
        ]);

        Seller::create([
            'name'      => 'Riquelme',
        ]);

        Seller::create([
            'name'      => 'Jeiely',
        ]);
    }
}
