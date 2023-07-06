<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Member\HomeController::class, 'index'])->name('home');
Route::match(['post', 'get'],'/login', [\App\Http\Controllers\Member\AuthController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Member\AuthController::class, 'logout'])->name('logout');
Route::match(['post', 'get'],'/register', [\App\Http\Controllers\Member\AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function (){

    Route::group(['prefix' => 'pesan-paket'], function (){
        Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\Member\PesananController::class, 'paket'])->name('pesan-paket.id');
    });

    Route::group(['prefix' => 'pesanan'], function (){
        Route::get('/', [\App\Http\Controllers\Member\PesananController::class, 'index'])->name('pesanan');
    });

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'pengguna'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('pengguna');
        Route::post('/{id}', [\App\Http\Controllers\Admin\PenggunaController::class, 'patch'])->name('pengguna.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('pengguna.delete');
    });

    Route::group(['prefix' => 'paket'], function () {
        Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PaketController::class, 'index'])->name('paket');
        Route::post('/{id}', [\App\Http\Controllers\Admin\PaketController::class, 'patch'])->name('paket.update');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PaketController::class, 'destroy'])->name('paket.delete');
    });
});

