<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori', KategoriController::class)->except(['create', 'edit', 'show']);
});
