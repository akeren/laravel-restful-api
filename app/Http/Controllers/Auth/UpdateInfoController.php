<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateInfoController extends Controller
{
    public function updateInfo(UpdateUserRequest $request)
    {
        $user = Auth::user();

        if(!$user->update($request->only('first_name', 'last_name', 'email'))) {
            return response([
                'status' => 'fail',
                'code' => 304,
                'message' => 'Operation failed. Try again!',
            ])->setStatusCode(Response::HTTP_NOT_MODIFIED);
        }

        return response([
            'status' => 'success',
            'code' => 202,
            'message' => 'Changes made successfully.',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_ACCEPTED);

    }
}
