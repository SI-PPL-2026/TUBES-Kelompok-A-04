<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ItemBukuController;
use Illuminate\Support\Facades\Route;

Route::resource('buku', BukuController::class)->parameters([
    'buku' => 'buku:id_buku',
]);

Route::post('buku/{buku:id_buku}/items', [ItemBukuController::class, 'store'])
    ->name('buku.items.store');
Route::put('item-buku/{itemBuku:id_item_buku}', [ItemBukuController::class, 'update'])
    ->name('item-buku.update');
Route::delete('item-buku/{itemBuku:id_item_buku}', [ItemBukuController::class, 'destroy'])
    ->name('item-buku.destroy');