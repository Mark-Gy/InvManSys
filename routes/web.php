<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StocksController;
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
    Route::put('api/products/{id}', [ProductsController::class, 'update']);
    Route::get('api/products', [ProductsController::class, 'getProductsJson']);
    
    Route::get('/stocks', [StocksController::class, 'stock'])->name('stock');
    Route::post('/stocks', [StocksController::class, 'stockSubmit'])->name('stockSubmit');
    Route::get('/stocks/history', [StocksController::class, 'history'])->name('stockHistory');


});
