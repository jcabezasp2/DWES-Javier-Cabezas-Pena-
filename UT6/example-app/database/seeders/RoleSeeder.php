<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;


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

        $admin=Role::create(['name'=>'admin']);
        $guest=Role::create(['name'=>'guest']);

        //Asignar el rol admin al usuario admin
        $administrator = User::where('name', 'admin')->first();
        $administrator->assignRole($admin);

        //Asignar el rol guest al resto de usuarios
        $users = User::where('name', '!=', 'admin')->get();
        foreach ($users as $user) {
            $user->assignRole($guest);
        }
    }
}
