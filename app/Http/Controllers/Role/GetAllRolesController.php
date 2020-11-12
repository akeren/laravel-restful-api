<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class GetAllRolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return response([
            'status' => 'success',
            'code' => 200,
            'result' => $roles->count(),
            'message' => 'Data retrieved successfully.',
            'data' => RoleResource::collection($roles),
        ])->setStatusCode(Response::HTTP_OK);
    }
}
