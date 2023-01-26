<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1=Role::create(['name'=>'admin']);
        $role2=Role::create(['name'=>'guest']);
        $role3=Role::create(['name'=>'mod']);
        Permission::create(['name'=>'admin'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.list_users'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.list_projects'])->syncRoles([$role1,$role2,$role3]);




        //Creacion del usuario administrador
        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $admin->assignRole($role1);
    }
}
