<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\RolePermission;
use Symfony\Component\HttpFoundation\Response;

class CreateRoleController extends Controller
{
    public function store(CreateRoleRequest $request)
    {
        \Gate::authorize('edit', 'roles');
        
        $role = Role::create($request->only('name'));

        if($permissions = $request->permissions) {
            foreach($permissions as $permissionId) {
                RolePermission::insert([
                    'role_id' => $role->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        if(!$role) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Unable to create role. Try again!'
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return response([
            'status' => 'success',
            'code' => 201,
            'message' => 'Role created successfully.',
            'data' => new RoleResource($role),
        ])->setStatusCode(Response::HTTP_CREATED);
    }
}
