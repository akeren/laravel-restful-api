<?php

use App\Http\Controllers\Admin\CreateUserController;
use App\Http\Controllers\Admin\DeleteUserController;
use App\Http\Controllers\Admin\GetAllUsersController;
use App\Http\Controllers\Admin\GetUserController;
use App\Http\Controllers\Admin\UpdateUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\UpdateInfoController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Order\ChartOrderController;
use App\Http\Controllers\Order\ExportOrdersController;
use App\Http\Controllers\Order\GetAllOrdersController;
use App\Http\Controllers\Order\GetOrderController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;
use App\Http\Controllers\Product\GetAllProductsController;
use App\Http\Controllers\Product\GetProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Role\CreateRoleController;
use App\Http\Controllers\Role\DeleteRoleController;
use App\Http\Controllers\Role\GetAllRolesController;
use App\Http\Controllers\Role\GetRoleController;
use App\Http\Controllers\Role\UpdateRoleController;
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
    Route::prefix('users')->name('user.')->group(static function () {
        Route::post('/signup', [SignupController::class, 'signup'])->name('signup');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    
    Route::group(['middleware' => 'auth:api'], static function () {
        Route::prefix('roles')->group(static function () {
            Route::get('/', [GetAllRolesController::class, 'index'])->name('index');
            Route::post('/', [CreateRoleController::class, 'store'])->name('store');
            Route::get('/{role}', [GetRoleController::class, 'show'])->name('show');
            Route::patch('/{role}', [UpdateRoleController::class, 'update'])->name('update');
            Route::delete('/{role}', [DeleteRoleController::class, 'destroy'])->name('destroy');
        });
        
        Route::prefix('uploads')->group(static function () {
            Route::post('/', [ImageController::class, 'upload'])->name('image');
        });

        Route::prefix('products')->group(static function () {
            Route::get('/', [GetAllProductsController::class, 'index'])->name('index');
            Route::post('/', [CreateProductController::class, 'store'])->name('store');
            Route::get('/{product}', [GetProductController::class, 'show'])->name('show');
            Route::patch('/{product}', [UpdateProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [DeleteProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('orders')->group(static function () {
            Route::get('/', [GetAllOrdersController::class, 'index'])->name('index');
            Route::get('/{id}', [GetOrderController::class, 'show'])->name('show');
        });
        
        Route::get('/charts', [ChartOrderController::class, 'chart'])->name('chart');
        Route::get('/exportOrders', [ExportOrdersController::class, 'exportOrdersToCSV'])->name('export');

        
        Route::prefix('users')->group(static function () {
            Route::get('/me', [ProfileController::class, 'me'])->name('me');
            Route::patch('/me', [UpdateInfoController::class, 'updateInfo'] )->name('updateInfo');
            Route::patch('/updatePassword', [UpdatePasswordController::class, 'updatePassword'])->name('updatePassword');
            
            Route::get('/', [GetAllUsersController::class, 'index'])->name('index');
            Route::get('/{user}', [GetUserController::class, 'show'])->name('show');
            Route::post('/', [CreateUserController::class, 'store'])->name('store');
            Route::patch('/{user}', [UpdateUserController::class, 'update'])->name('update');
            Route::delete('/{user}', [DeleteUserController::class, 'destroy'])->name('destroy');
        });
    });

});