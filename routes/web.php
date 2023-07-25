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
Route::match(['post', 'get'],'/login-admin', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
Route::get('/logout', [\App\Http\Controllers\Member\AuthController::class, 'logout'])->name('logout');
Route::get('/logout-admin', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
Route::match(['post', 'get'],'/register', [\App\Http\Controllers\Member\AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function (){

    Route::group(['prefix' => 'pesan-paket'], function (){
        Route::match(['post', 'get'], '/{id}', [\App\Http\Controllers\Member\PesananController::class, 'paket'])->name('pesan-paket.id');
    });

    Route::group(['prefix' => 'pesanan'], function (){
        Route::get('/', [\App\Http\Controllers\Member\PesananController::class, 'index'])->name('pesanan');
    });

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'admin'], function (){

        Route::group(['prefix' => 'pengguna'], function () {
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('admin.pengguna');
            Route::post('/{id}', [\App\Http\Controllers\Admin\PenggunaController::class, 'patch'])->name('admin.pengguna.update');
            Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('admin.pengguna.delete');
        });

        Route::group(['prefix' => 'pelanggan'], function () {
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PelangganController::class, 'index'])->name('admin.pelanggan');
        });

        Route::group(['prefix' => 'paket'], function () {
            Route::match(['get', 'post'], '/', [\App\Http\Controllers\Admin\PaketController::class, 'index'])->name('admin.paket');
            Route::post('/{id}', [\App\Http\Controllers\Admin\PaketController::class, 'patch'])->name('admin.paket.update');
            Route::post('/{id}/delete', [\App\Http\Controllers\Admin\PaketController::class, 'destroy'])->name('admin.paket.delete');
        });

        Route::group(['prefix' => 'pesanan'], function () {
            Route::match(['get', 'post'], '/menunggu', [\App\Http\Controllers\Admin\PesananController::class, 'menunggu'])->name('admin.pesanan.menunggu');
            Route::match(['get', 'post'], '/proses', [\App\Http\Controllers\Admin\PesananController::class, 'proses'])->name('admin.pesanan.proses');
            Route::match(['get', 'post'], '/selesai', [\App\Http\Controllers\Admin\PesananController::class, 'selesai'])->name('admin.pesanan.selesai');
            Route::match(['get', 'post'], '/kirim', [\App\Http\Controllers\Admin\PesananController::class, 'kirim'])->name('admin.pesanan.kirim');
            Route::match(['get', 'post'], '/terima', [\App\Http\Controllers\Admin\PesananController::class, 'terima'])->name('admin.pesanan.terima');
        });

        Route::group(['prefix' => 'laporan'], function () {
            Route::get( '/pesanan', [\App\Http\Controllers\Admin\LaporanController::class, 'pesanan'])->name('admin.laporan.pesanan');
            Route::get( '/pendapatan', [\App\Http\Controllers\Admin\LaporanController::class, 'pendapatan'])->name('admin.laporan.pendapatan');
            Route::get( '/pesanan/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak_pesanan'])->name('admin.laporan.pesanan.cetak');
            Route::get( '/pendapatan/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak_pendapatan'])->name('admin.laporan.pendapatan.cetak');
        });
    });

});

