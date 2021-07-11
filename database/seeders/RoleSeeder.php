<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        //Admin
        $roleAdmin = Role::create(['name'=>'admin']);
        $roleAdmin->syncPermissions('store music');

        //User
        $roleUser = Role::create(['name'=>'user']);
    }
}
