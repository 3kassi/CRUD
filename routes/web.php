<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCardController;
use Illuminate\Support\Facades\URL;



Route::get('/test', function() {
    return 'Test Route is working!';
});

// Specific Routes
Route::get('/', [ProductCardController::class, 'index'])->name('product_cards.index');
Route::get('/product_cards/create', [ProductCardController::class, 'create'])->name('product_cards.create');
Route::post('/product_cards', [ProductCardController::class, 'store'])->name('product_cards.store');
Route::delete('/product_cards/bulk-delete', [ProductCardController::class, 'bulkDelete'])->name('product_cards.bulk_delete');
Route::post('/product_cards/export-selected', [ProductCardController::class, 'exportSelectedToCSV'])->name('product_cards.export_selected');

// Dynamic Routes
Route::get('/product_cards/{id}/edit', [ProductCardController::class, 'edit'])->name('product_cards.edit');
Route::put('/product_cards/{id}', [ProductCardController::class, 'update'])->name('product_cards.update');
Route::delete('/product_cards/{id}', [ProductCardController::class, 'destroy'])->name('product_cards.destroy');
Route::get('/product_cards/{id}', [ProductCardController::class, 'show'])->name('product_cards.show');

