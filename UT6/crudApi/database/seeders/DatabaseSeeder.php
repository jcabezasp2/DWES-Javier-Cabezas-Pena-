<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //Creacion de los usuarios
         $this->call(UserSeeder::class);

        //Creacion de los productos
        $this->call(ProductSeeder::class);
    }
}
