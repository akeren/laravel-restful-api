<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;

class DeleteRoleController extends Controller
{
    public function destroy($id)
    {
        $role = Role::destroy($id);

        if(!$role) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No result found.'
            ])->setStatusCode(404);
        }

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Role deleted successfully.',
            'data' => null,
        ])->setStatusCode(204);
    }
}
