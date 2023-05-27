<?php

use App\Http\Controllers\AutheticationController;
use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\HomePage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', HomePage::class)->name('home');
    Route::post('/logout', [AutheticationController::class, 'logout'])->name('logout');
    Route::resource('divisions', DivisionsController::class);
});

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AutheticationController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [AutheticationController::class, 'login'])->name('login');
});
