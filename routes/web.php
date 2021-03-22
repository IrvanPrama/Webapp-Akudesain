<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
    return view('index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/signup/client', [AuthController::class, 'client'])->name('signup-client');
Route::get('/signup/designer', [AuthController::class, 'designer'])->name('signup-designer');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');