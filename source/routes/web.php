<?php

use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('divisions', DivisionsController::class);
});



require_once __DIR__.'/auth.php';
