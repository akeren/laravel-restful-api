<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function me()
    {
        $user = Auth::user();

        return (new UserResource($user))->additional([
                'data' => [
                    'permissions' => $user->permissions(),
                ],
            ]);

/*         return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Profile info',
            'data' => (new UserResource($user))->additional([
                'data' => [
                    'permissions' => $user->permissions(),
                ],
            ]),
        ])->setStatusCode(Response::HTTP_OK); */
    }
}
