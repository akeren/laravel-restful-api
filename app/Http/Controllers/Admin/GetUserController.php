<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class GetUserController extends Controller
{
    public function show(User $user)
    {
        \Gate::authorize('view', 'users');
        
        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_OK);
    }
}
