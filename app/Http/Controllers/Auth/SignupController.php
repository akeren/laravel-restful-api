<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\Welcome;
use Hash;
use Symfony\Component\HttpFoundation\Response;

class SignupController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "role_id" => $request->role_id,
        ]);

        if(!$user) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Unable to create account.Try again!',
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        // send a welcome message via email

        return response([
            'status' => 'success',
            'code' => 201,
            'message' => 'Account created successfully',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_CREATED);
    }
}
