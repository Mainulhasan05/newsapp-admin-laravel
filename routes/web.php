<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
// ->middleware(['auth'])->name('dashboard');

// 
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('category.create'); // This is the new route
Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
Route::post('/categories/{id}', [CategoriesController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');


// contact us
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact_us.index');
Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact_us.destroy');

// news

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');

Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

// Post routes
Route::get("/post/create", [PostController::class, "create"])->name("post.create");

