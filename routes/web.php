<?php

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

Route::middleware('auth')->group(function() {

    Route::post('/pesan/bayar', [PembayaranController::class, 'bayar']);
    Route::get('/pesan/riwayat', [PesananController::class, 'riwayat']);

});
