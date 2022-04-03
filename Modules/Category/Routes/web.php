<?php
use Illuminate\Support\FacadesRoute;
use Modules\Category\Http\Controllers\CategoryController;


Route::prefix('category')->name('category.')->group(function() {
    Route::get('index-category',[CategoryController::class,'index'])->name('index');
    Route::get('add-category', [CategoryController::class, 'create']);
    Route::post('add-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('update-category/{id}',[CategoryController::class,'update']);
    Route::post('delete-category/{id}',[CategoryController::class,'destroy']); 
});
