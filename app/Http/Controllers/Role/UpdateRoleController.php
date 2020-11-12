<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function update(Request $request,$id)
    {
        $role = Role::find($id);

        if(!$role) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No result found.',
            ])->setStatusCode(404);
        }

        if(!$role->update($request->only('name'))) {
            return response([
                'status' => 'fail',
                'code' => 304,
                'message' => 'Unable to process request. Try again!'
            ])->setStatusCode(304);
        }

        return response([
            'status' => 'success',
            'code' => 202,
            'message' => 'Changes made successfully.',
            'data' => new RoleResource($role),
        ])->setStatusCode(202);
    }
}
