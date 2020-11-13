<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::factory(1)->create(['name' => 'Admin']);
        \App\Models\Role::factory(1)->create(['name' => 'Editor']);
        \App\Models\Role::factory(1)->create(['name' => 'Viewer']);
    }
}
