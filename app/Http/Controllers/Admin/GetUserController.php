<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class GetUserController extends Controller
{
    public function show($id)
    {
        \Gate::authorize('view', 'users');
        
        $user = User::find($id);

        if(!$user) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No user associated with that ID found!'
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_OK);
    }
}
