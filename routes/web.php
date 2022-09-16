<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::put('/home/{id}', [HomeController::class, 'index'])->middleware('role:admin');

Route::get('/login', [LoginController::class, 'loginIndex'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'loginStore']);

Route::get('/register', [LoginController::class, 'registerIndex'])->middleware('guest');

Route::post('/register', [LoginController::class, 'registerStore'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout']);

Route::resource('/dashboard/admin', DashboardAdminController::class)->middleware('auth');
