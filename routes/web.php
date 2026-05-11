<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BarangController::class, 'index']);

Route::resource('kategori', CategoryController::class);
Route::resource('barang', BarangController::class);

Route::view('/bantuan', 'bantuan');
