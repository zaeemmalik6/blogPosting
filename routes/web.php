<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// use App\Http\Middleware\ValidAdmin;

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
    // Route::resource('category', [App\Http\Controllers\CategoryController::class]);
});

Route::prefix('normalUser')->middleware(['auth', 'normalUser'])->group(function () {
    Route::get('/normalUserDashboard', [App\Http\Controllers\NormalUser\NormalUserController::class, 'index'])->name('normalUserDashboard');
});


Route::get('/logout', [HomeController::class, 'logout'])->name('logout.perform');
