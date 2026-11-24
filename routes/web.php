<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('kategori', KategoriController::class)->except(['create', 'edit', 'show']);
    Route::post('siswa/impor', [SiswaController::class, 'impor'])->name('siswa.impor');
    Route::resource('siswa', SiswaController::class)->except(['create', 'edit', 'show']);
});

Route::post('/logout', function () {
    return redirect('/');
})->name('logout');