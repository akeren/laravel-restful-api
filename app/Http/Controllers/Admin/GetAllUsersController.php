<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class GetAllUsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate();

        return UserResource::collection($users);
    }
}
