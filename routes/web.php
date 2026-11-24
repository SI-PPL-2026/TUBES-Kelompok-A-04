<?php

use App\Http\Controllers\Admin\SiswaController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('siswa/impor', [SiswaController::class, 'impor'])->name('siswa.impor');
    Route::resource('siswa', SiswaController::class)
        ->except(['create', 'show', 'edit'])
        ->parameters(['siswa' => 'siswa']);
});