<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully',
            'result' => $users->count(),
            'data' => UserResource::collection($users)
        ])->setStatusCode(Response::HTTP_OK);
    }
}
