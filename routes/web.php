<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/loginUser', [App\Http\Controllers\Auth\LoginController::class, 'loginUser'])->name('loginUser');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/adminDashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('adminDashboard');
    Route::resource('/users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/posts', App\Http\Controllers\Admin\PostController::class);
    Route::get('/trashUsers', [App\Http\Controllers\Admin\UserController::class, 'trashUsers'])->name('trashUsers');
    Route::get('/restoreUser/{user}', [App\Http\Controllers\Admin\UserController::class, 'restoreUser'])->name('restoreUser');
    Route::get('/trashPosts', [App\Http\Controllers\Admin\PostController::class, 'trashPosts'])->name('trashPosts');
    Route::get('/restorePost/{post}', [App\Http\Controllers\Admin\PostController::class, 'restorePost'])->name('restorePost');
    Route::get('/trashCategories', [App\Http\Controllers\Admin\CategoryController::class, 'trashCategories'])->name('trashCategories');
    Route::get('/restoreCategory/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'restoreCategory'])->name('restoreCategory');
});

Route::prefix('normalUser')->middleware(['auth', 'normalUser'])->group(function () {
    Route::get('/normalUserDashboard', [App\Http\Controllers\NormalUser\NormalUserController::class, 'index'])->name('normalUserDashboard');
});


Route::get('/logout', [HomeController::class, 'logout'])->name('logout.perform');
