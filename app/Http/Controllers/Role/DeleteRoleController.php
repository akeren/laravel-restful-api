<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RolePermission;

class DeleteRoleController extends Controller
{
    public function destroy($id)
    {
        \Gate::authorize('edit', 'roles');
        
        $role = Role::destroy($id);
        RolePermission::whereRoleId($id)->delete();

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Role deleted successfully.',
            'data' => null,
        ])->setStatusCode(204);
    }
}
