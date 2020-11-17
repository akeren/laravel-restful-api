<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class GetRoleController extends Controller
{
    public function show($id)
    {
        \Gate::authorize('view', 'roles');
        
        $role = Role::find($id);

        if(!$role) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No result found.'
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new RoleResource($role),
        ])->setStatusCode(200);
    }
}
