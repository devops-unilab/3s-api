<?php

use Illuminate\Support\Facades\Route;
use app3s\controller\MainIndex;

Route::get('/', function () {
    $main = new MainIndex();
    $main->main();
})->name('root');

Route::post('/', function () {
    $main = new MainIndex();
    $main->main();
})->name('root-post');



