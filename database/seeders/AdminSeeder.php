<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@app.com',
            'active' => 1,
        ]);
        $admin->assignRole(Role::findById(1, 'admin'));
    }
}
