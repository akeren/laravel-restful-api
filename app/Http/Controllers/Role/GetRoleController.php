<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;

class GetRoleController extends Controller
{
    public function show(Role $role)
    {
        \Gate::authorize('view', 'roles');
        
        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new RoleResource($role),
        ])->setStatusCode(200);
    }
}
