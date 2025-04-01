<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductImageController;
use App\Http\Controllers\Admin\AdminAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('dashboard', AdminDashboardController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('product-images', AdminProductImageController::class);
    });
});


//Route::post('/admin/products/store', [AdminProductController::class, 'store'])->name('admin.products.store');
//Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit']);
//Route::put('/admin/products/{product}', [AdminProductController::class, 'update']);
//Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy']);
//Route::get('admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');

//////////////////// categories

//Route::get('admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
//Route::post('admin/categories/store', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
//Route::put('admin/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
//Route::delete('admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

