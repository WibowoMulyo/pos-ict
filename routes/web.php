<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');
    Route::post('/kasir', [KasirController::class, 'create'])->name('kasir-create');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::post('/barang', [BarangController::class, 'create'])->name('barang-create');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
});

Auth::routes();
