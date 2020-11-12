<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class CreateRoleController extends Controller
{
    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->only('name'));

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
