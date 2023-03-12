<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use app3s\controller\MainIndex;

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

//rota de migração
Route::get('migrate',function(){
   Artisan::call('migrate');
//    return \Artisan::output();
});

//rota de rollback
Route::get('rollback',function(){
   Artisan::call('migrate:rollback');
});

//rota de visualizacao e limpeza
Route::get('vr-clear',function(){
   Artisan::call('route:clear');
   Artisan::call('view:clear');
});

//rota de reinicializacao e limpeza de cache
Route::get('reboot',function(){
  Artisan::call('view:clear');
  Artisan::call('route:clear');
  Artisan::call('route:cache');
  Artisan::call('config:clear');
  Artisan::call('cache:clear');
  Artisan::call('key:generate');
});

