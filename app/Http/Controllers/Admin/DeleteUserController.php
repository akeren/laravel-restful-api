<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController extends Controller
{
    public function destroy($id) 
    {
        $user = User::destroy($id);

        if(!$user) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Unable perform delete action.',
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'User deleted successfully.',
            'data' => null,
        ])->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
