<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReturnProductsController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/logout', [UsersController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UsersController::class);

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
    
    Route::get('/return-products', [ReturnProductsController::class, 'returnProduct'])->name('returnProduct');
    Route::post('/return-products', [ReturnProductsController::class, 'returnProductSubmit'])->name('returnProductSubmit');
    Route::get('/return-products/history', [ReturnProductsController::class, 'history'])->name('returnProductHistory');


});
