<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::factory(1)->create(['name' => 'Admin']);
        \App\Models\Role::factory(1)->create(['name' => 'Editor']);
        \App\Models\Role::factory(1)->create(['name' => 'Viewer']);
        \App\Models\User::factory(20)->create();

    }
}
