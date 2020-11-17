<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function update(Request $request,$id)
    {
        \Gate::authorize('edit','roles');
        
        $role = Role::find($id);

        if(!$role->update($request->only('name'))) {
            return response([
                'status' => 'fail',
                'code' => 304,
                'message' => 'Unable to process request. Try again!'
            ])->setStatusCode(304);
        }

        RolePermission::whereRoleId($role->id)->delete();
        
        if($permissions = $request->permissions) {
            foreach($permissions as $permissionId) {
                RolePermission::insert([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        return response([
            'status' => 'success',
            'code' => 202,
            'message' => 'Changes made successfully.',
            'data' => new RoleResource($role),
        ])->setStatusCode(202);
    }
}
