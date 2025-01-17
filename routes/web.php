<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubdistrictController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ImageUploadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('login');
})->name('auth')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', [AuthController::class, 'getUsers'])->name('users.index');
    Route::post('/users/create', [AuthController::class, 'createUser'])->name('users.create');
    Route::post('/users/{id}/update-password', [AuthController::class, 'updatePasswordByAdmin'])->name('users.update-password');
    Route::delete('/users/{id}/delete', [AuthController::class, 'deleteUser'])->name('users.delete');
    
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
    Route::post("/post", [PostController::class, "store"])->name("post.store");
    Route::get("/post", [PostController::class, "index"])->name("post.index");
    Route::get('/post/guest', [PostController::class, 'guest'])->name('post.guest');
    Route::post('/post/{id}/publish', [PostController::class, 'publish'])->name('post.publish');
    Route::get("/post/{id}/edit", [PostController::class, "edit"])->name("post.edit");
    Route::put("/post/{id}", [PostController::class, "update"])->name("post.update");
    Route::delete("/post/{id}", [PostController::class, "destroy"])->name("post.destroy");
    
    
    // district routes
    Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
    Route::get('/districts/create',[DistrictController::class,'create'])->name('districts.create');
    Route::post('/districts',[DistrictController::class,'store'])->name('districts.store');
    Route::get('/districts/{id}/edit',[DistrictController::class,'edit'])->name('districts.edit');
    Route::put('/districts/{id}',[DistrictController::class,'update'])->name('districts.update');
    Route::delete('/districts/{id}',[DistrictController::class,'destroy'])->name('districts.destroy');
    
    // subdistrict routes
    Route::get('/subdistricts', [SubdistrictController::class, 'index'])->name('subdistricts.index');
    Route::get('/subdistricts/create',[SubdistrictController::class,'create'])->name('subdistricts.create');
    Route::post('/subdistricts',[SubdistrictController::class,'store'])->name('subdistricts.store');
    Route::get('/subdistricts/{id}/edit',[SubdistrictController::class,'edit'])->name('subdistricts.edit');
    Route::put('/subdistricts/{id}',[SubdistrictController::class,'update'])->name('subdistricts.update');
    Route::delete('/subdistricts/{id}',[SubdistrictController::class,'destroy'])->name('subdistricts.destroy');
    
    // json dependency
    Route::get('/get/subcategory/{category_id}', [PostController::class, 'getSubcategory'])->name('get.subcategory');
    Route::get('/get/subdistricts/{district_id}', [PostController::class, 'getSubdistricts'])->name('get.subdistricts');
});

// page controller
// Display all pages
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');;
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');
Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

Route::post('/upload-image', [ImageUploadController::class,'upload']);

Route::get('/cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "Cache is cleared";
});