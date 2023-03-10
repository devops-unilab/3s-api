<?php

use app3s\controller\MainIndex;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    $main = new MainIndex();
    $main->main();
})->name('root');

Route::post('/', function () {
    $main = new MainIndex();
    $main->main();
})->name('root-post');