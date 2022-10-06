<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::put('/home/{id}', [HomeController::class, 'index'])->middleware('auth');

Route::get('/', function ()
{
   return redirect('/login');
});

Route::get('/home/{id}', function ()
{
   Auth::logout();
   return redirect('/login')->with('forbidden', 'Not Allowed!!!');
});

Route::get('/login/loginas', [LoginController::class, 'loginas'])->middleware('guest');

Route::get('/login', [LoginController::class, 'loginIndex'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'loginStore']);

Route::get('/register', [LoginController::class, 'registerIndex'])->middleware('guest');

Route::post('/register', [LoginController::class, 'registerStore'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/{transaction}', [DashboardAdminController::class, 'updateDone'])->middleware('auth');

Route::resource('/dashboard/transaction', DashboardAdminController::class)->middleware('role:Admin');
