<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function me()
    {
        $user = Auth::user();

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Profile info',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_OK);
    }
}
