<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/product-images', [ProductImageController::class, 'index']);

// filtrage , pagination
Route::get('/public/categories', [PublicController::class, 'categories']);
Route::get('/public/products', [PublicController::class, 'products']);
Route::get('/public/products/{id}', [PublicController::class, 'productDetail']);

  // protection des routes
Route::middleware('auth:sanctum', 'admin')->group(function () {
    // Catégories
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);
  

    // Produits
    Route::post('/admin/products', [ProductController::class, 'store']);
    Route::put('/admin/products/{id}', [ProductController::class, 'update']);
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);
  

    // Images
    Route::post('/admin/product-images', [ProductImageController::class, 'store']);
    Route::delete('/admin/product-images/{id}', [ProductImageController::class, 'destroy']);

});