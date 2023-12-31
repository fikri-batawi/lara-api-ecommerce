<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CartUserController;
use App\Http\Controllers\Api\UserAdminController;

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

// AUTH
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PRODUCT
Route::resource('products', ProductController::class);

// CART
Route::resource('carts', CartController::class);

// ORDER
Route::resource('orders', OrderController::class);

// USER
Route::resource('users', UserController::class);

// CART USER
Route::resource('cart-users', CartUserController::class);

// USER ADMIN
Route::resource('user-admins', UserAdminController::class);