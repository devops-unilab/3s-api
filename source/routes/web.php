<?php

use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\OrderMessagesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderStatusLogsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use app3s\controller\MainIndex;
use Illuminate\Support\Facades\Route;







Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $main = new MainIndex();
        $main->main();
    })->name('root');

    Route::post('/', function () {
        $main = new MainIndex();
        $main->main();
    })->name('root-post');

    Route::resource('divisions', DivisionsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('order_status_logs', OrderStatusLogsController::class);
    Route::resource('order_messages', OrderMessagesController::class);

});



require_once __DIR__.'/auth.php';
