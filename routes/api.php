<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\GetAllUsersController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * REST API version One (v1) 
 * @author Kater, Akeren
 */
Route::prefix('v1')->group(static function () {
    Route::prefix('users')->name('user')->group(static function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        
        Route::group(['middleware' => 'auth:api'], static function () {
            Route::get('/', [GetAllUsersController::class, 'index'])->name('index');
            Route::get('/{id}', [GetUserController::class, 'show'])->name('show');
            Route::post('/', [CreateUserController::class, 'store'])->name('store');
            Route::patch('/{id}', [UpdateUserController::class, 'update'])->name('update');
            Route::delete('/{id}', [DeleteUserController::class, 'destroy'])->name('destroy');
        });
    });

});
