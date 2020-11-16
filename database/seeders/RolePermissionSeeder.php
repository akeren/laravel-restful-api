<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $adminRole = Role::whereName('Admin')->first();

        foreach($permissions as $permission) {
            RolePermission::insert([
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id,
            ]);
        }

        $editorRole = Role::whereName('Editor')->first();
        
        foreach($permissions as $permission) {
            if(!in_array($permission->name, ['edit_roles'])) {
                RolePermission::insert([
                    'role_id' => $editorRole->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }

        $viewerRole = Role::whereName('Viewer')->first();
        $viewerPermissions = [
            'view_users',
            'view_roles',
            'view_products',
            'view_orders',
        ];

        foreach($permissions as $permission) {
            if(in_array($permission->name, $viewerPermissions)) {
                RolePermission::insert([
                    'role_id' => $viewerRole->id,
                    'permission_id' => $permission->id,
                ]);
            }
        }
    }
}
