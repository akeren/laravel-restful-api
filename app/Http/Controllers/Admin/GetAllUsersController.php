<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class GetAllUsersController extends Controller
{
    /**
     * @OA\Get(path="/users",
     *      security={{ "bearerAuth":{} }},
     *      @OA\Response(response="200",
     *          description="User Collection",
     *      )
     * )
     */
    public function index()
    {
        \Gate::authorize('view', 'users');
        
        $users = User::latest()->paginate();

        return UserResource::collection($users);
    }
}
