<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

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
        
        $users = QueryBuilder::for(User::class)
        ->allowedFilters(['first_name', 'last_name', 'email'])
        ->jsonPaginate()
        ->appends(request()->query());



        return UserResource::collection($users);
    }
}
