<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=> 'guest',
            'guard_name' => "web"
        ]);
        Role::create([
            'name'=> 'admin',
            'guard_name' => "web"
        ]);
    }
}
