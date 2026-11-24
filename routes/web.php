<?php

use App\Http\Controllers\Admin\AturanController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/aturan');
Route::post('logout', fn () => redirect('/'))->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('aturan', AturanController::class)->except(['create', 'edit', 'show']);
});