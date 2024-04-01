<?php

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\TypeApiController;
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
Route::post('/auth', [AuthApiController::class, 'auth']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);
Route::get('area', [TypeApiController::class, 'area']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserApiController::class, 'index']);
    Route::put('/user-edit/{id}', [UserApiController::class, 'update']);
    Route::get('agents', [UserApiController::class, 'agents']);
    Route::get('orders', [OrderApiController::class, 'index']);
    Route::put('/base-status/{id}', [OrderApiController::class, 'update']);
    Route::post('order-store', [OrderApiController::class, 'store']);
    Route::get('types', [TypeApiController::class, 'index']);
    Route::get('category', [TypeApiController::class, 'category']);
    Route::post('logout', [AuthApiController::class, 'logout']);
});