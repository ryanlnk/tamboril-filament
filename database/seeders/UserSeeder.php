<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'ryan',
            'email'     => 'ryan@ryan.com',
            'password'  => Hash::make('12345678')
        ]);

        User::create([
            'name'      => 'riquelme',
            'email'     => 'riquelme@gmail.com',
            'password'  => Hash::make('senhariquelme')
        ]);

        User::create([
            'name'      => 'jeiely',
            'email'     => 'jeiely@gmail.com',
            'password'  => Hash::make('senhajeiely')
        ]);
    }
}
