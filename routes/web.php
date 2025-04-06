<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ProductsController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::resource('categories', CategoriesController::class);
    Route::get('api/categories', [CategoriesController::class, 'getCategoriesJson']);

    Route::resource('brands', BrandsController::class);
    Route::get('api/brands', [BrandsController::class, 'getBrandsJson']);

    Route::resource('sizes', SizesController::class);
    Route::get('api/sizes', [SizesController::class, 'getSizesJson']);

    Route::resource('products', ProductsController::class);
    Route::post('api/products', [ProductsController::class, 'store']);
});

