<?php

// use App\Http\Controllers\Apis\v1\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\Apis\v1\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Apis\v1\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/createPost', [App\Http\Controllers\Apis\v1\PostController::class, 'createPost']);
    Route::resource('products', ProductController::class);
});
