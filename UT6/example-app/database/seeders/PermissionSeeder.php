<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                //Seleccion de los usuarios
                $admin = Role::where('name','admin')->first();
                $guest = Role::where('name','guest')->first();

                //Permisos sobre usuarios
                Permission::create(['name'=>'list_users'])->syncRoles([$admin]);
                Permission::create(['name'=>'delete_users'])->syncRoles([$admin]);

                //Permisos sobre proyectos
                Permission::create(['name'=>'list_projects'])->syncRoles([$admin,$guest]);
                Permission::create(['name'=>'delete_projects'])->syncRoles([$admin,$guest]);
                Permission::create(['name'=>'create_projects'])->syncRoles([$guest]);
                Permission::create(['name'=>'modify_projects'])->syncRoles([$guest]);

    }
}
