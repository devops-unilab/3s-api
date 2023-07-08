<?php

use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/', [OrdersController::class, 'index'])->name('home');
    Route::resources(
        [
            'divisions' => DivisionsController::class,
            'users' => UsersController::class,
            'services' => ServicesController::class,
            'orders' => OrdersController::class
        ]
    );
    Route::post('/change-level', [UsersController::class, 'changeRole'])->name('change-level');
});

require_once __DIR__ . '/auth.php';
