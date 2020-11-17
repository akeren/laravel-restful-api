<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController extends Controller
{
    public function store(UserCreateRequest $request)
    {
        \Gate::authorize('edit', 'users');

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role_id' => $request->role_id,
        ]);

        if(!$user) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Unable to create account.',
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return response([
            'status' => 'success',
            'code' => 201,
            'message' => 'User created successfully.',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_CREATED);
    }
}
