<?php

use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    Route::resource('divisions', DivisionsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('services', ServicesController::class);
});



require_once __DIR__.'/auth.php';
