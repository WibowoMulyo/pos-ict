<?php

use App\Http\Controllers\Api\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/barang', [BarangController::class, 'getAllBarangs']);
Route::get('/barang/{id}', [BarangController::class, 'getBarangById']);
Route::post('/barang', [BarangController::class, 'createBarang']);
