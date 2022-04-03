<?php
use Illuminate\Support\FacadesRoute;
use Modules\Product\Http\Controllers\ProductController;


Route::prefix('product')->name('product.')->group(function() {
Route::get('index-product',[ProductController::class,'index'])->name('index');
Route::get('add-product', [ProductController::class, 'create']);
Route::post('add-product', [ProductController::class, 'store']);
Route::get('edit-product/{id}',[ProductController::class,'edit']);
Route::put('update-product/{id}',[ProductController::class,'update']);
Route::post('delete-product/{id}',[ProductController::class,'destroy']);
});
