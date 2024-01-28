<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'register'])->name('register');

// Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profiles', [UserController::class, 'profile'])->name('profiles');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// });
