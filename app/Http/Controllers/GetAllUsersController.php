<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate();

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully',
            'result' => $users->count(),
            'data' => $users
        ])->setStatusCode(Response::HTTP_OK);
    }
}
