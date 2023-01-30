<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Creacion del usuario administrador
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        User::factory(10)->create();

        User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

    }
}
