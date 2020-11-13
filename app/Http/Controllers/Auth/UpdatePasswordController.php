<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdatePasswordController extends Controller
{
    public function updatePassword(UpdatePasswordRequest $request) 
    {
        $user = Auth::user();
        
        if(!$user->update(['password' => Hash::make($request->password)])) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Operation failed. Try again!'

            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return response([
            'status' => 'success', 
            'code' => 202,
            'message' => 'Password changed successfully.',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_ACCEPTED);
    }    
}
