<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Permission::create(['name'=>'Read-','guard_name'=>'']);
        // Permission::create(['name'=>'Create-','guard_name'=>'']);
        // Permission::create(['name'=>'Update-','guard_name'=>'']);
        // Permission::create(['name'=>'Delete-','guard_name'=>'']);

        Permission::create(['name'=>'Read-Admins','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Admins','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Admins','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Admins','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Users','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Users','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Users','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Users','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Roles','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Roles','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Roles','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Roles','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Permissions','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Permissions','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Permissions','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Permissions','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Category','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Category','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Category','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Category','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-City','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-City','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-City','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-City','guard_name'=>'admin']);

        Permission::create(['name'=>'Read-Category','guard_name'=>'user']);
        Permission::create(['name'=>'Create-Category','guard_name'=>'user']);
        Permission::create(['name'=>'Update-Category','guard_name'=>'user']);
        Permission::create(['name'=>'Delete-Category','guard_name'=>'user']);
    }
}
