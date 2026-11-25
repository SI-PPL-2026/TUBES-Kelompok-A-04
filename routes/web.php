<?php

use App\Http\Controllers\Admin\AturanController;
use App\Http\Controllers\Admin\JenisDendaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::post('logout', function () {
    return redirect('/');
})->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('kategori', KategoriController::class)->except(['create', 'edit', 'show']);
    Route::resource('jenis-denda', JenisDendaController::class)->except(['create', 'edit', 'show']);
    Route::resource('aturan', AturanController::class)->except(['create', 'edit', 'show']);

    Route::post('siswa/impor', [SiswaController::class, 'impor'])->name('siswa.impor');
    Route::resource('siswa', SiswaController::class)->except(['create', 'edit', 'show']);
});