<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index']);

Route::get('/paket/{slug}', [PaketController::class, 'detail']);

Route::post('/pesan', [PesananController::class, 'pesan']);
Route::get('/pesan/detail/{id}', [PesananController::class, 'detail']);

Route::post('/transaction/notification', [PembayaranController::class, 'handleNotification']);


// auth
Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'registered'])->middleware('guest')->name('register');

Route::middleware('auth')->group(function() {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/pesan/bayar', [PembayaranController::class, 'bayar']);
    Route::get('/pesan/riwayat', [PesananController::class, 'riwayat']);

});
