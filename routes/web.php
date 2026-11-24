<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\JenisDendaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('logout', function () {
    return redirect('/');
})->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori', KategoriController::class)->except(['create', 'edit', 'show']);
    Route::resource('jenis-denda', JenisDendaController::class)->except(['create', 'edit', 'show'])->parameters(['jenis-denda' => 'jenisDenda']);;
});
