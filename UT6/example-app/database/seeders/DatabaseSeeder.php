<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creacion de las categorias
        $this->call(CategorySeeder::class);

        //Creacion de los usuarios
        $this->call(UserSeeder::class);

        //Creacion de los proyectos
        $this->call(ProjectSeeder::class);

        //Creacion de los roles
        $this->call(RoleSeeder::class);

        //Creacion de los permisos
        $this->call(PermissionSeeder::class);

    }
}
