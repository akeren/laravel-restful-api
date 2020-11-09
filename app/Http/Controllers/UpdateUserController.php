<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController extends Controller
{
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

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
