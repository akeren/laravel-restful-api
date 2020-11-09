<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
   public function login(LoginRequest $request)
   {
       if(!Auth::attempt($request->only('email', 'password'))) {
           return response([
               'status' => 'fail',
               'code' => 401,
               'message' => 'Invalid Login Credentials',
           ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
       }

       $user = Auth::user();
       $token = $user->createToken('admin')->accessToken;

       return response([
           'status' => 'success',
           'code' => 200,
           'data' => new UserResource($user),
           'token' => $token,
       ])->setStatusCode(Response::HTTP_OK);

   }
}
