<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController extends Controller
{
    public function destroy(User $user) 
    {
        \Gate::authorize('edit', 'users');
        
        $user->delete();

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'User deleted successfully.',
            'data' => null,
        ])->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
