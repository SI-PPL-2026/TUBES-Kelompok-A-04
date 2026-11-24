<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ItemBukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\JenisDendaController;

Route::resource('buku', BukuController::class)->parameters([
    'buku' => 'buku:id_buku',
]);

Route::post('buku/{buku:id_buku}/items', [ItemBukuController::class, 'store'])
    ->name('buku.items.store');
Route::put('item-buku/{itemBuku:id_item_buku}', [ItemBukuController::class, 'update'])
    ->name('item-buku.update');
Route::delete('item-buku/{itemBuku:id_item_buku}', [ItemBukuController::class, 'destroy'])
    ->name('item-buku.destroy');
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
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('jenis-denda', JenisDendaController::class)->except(['create', 'edit', 'show']);
});
