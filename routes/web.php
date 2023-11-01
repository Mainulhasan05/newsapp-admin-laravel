<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categories;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('dashboard');
});

// 
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('category.create'); // This is the new route
Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');
