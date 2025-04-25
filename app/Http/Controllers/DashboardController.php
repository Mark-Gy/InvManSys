<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\ReturnProduct;
use App\Models\User;
use App\Models\SoldItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
    $total_products = Product::count();
    $total_users = User::count();
    $total_stocks_in = ProductStock::where('status', ProductStock::STOCK_IN)->count();
    $total_return_products = ReturnProduct::count();
    
    $recent_products = Product::with('category')->latest()->limit(5)->get();
    
    $total_sales = SoldItem::sum('quantity');
    $latest_sales = SoldItem::with(['product', 'size'])
        ->orderBy('sold_at', 'desc')
        ->limit(5)
        ->get();
        
    $top_products = Product::query()
        ->withCount(['soldItems as total_sold'])
        ->withMax('soldItems', 'sold_at')
        ->having('total_sold', '>', 0)
        ->orderByDesc('total_sold')
        ->limit(5)
        ->get();

    return view('dashboard', compact(
        'total_products',
        'total_users',
        'total_stocks_in',
        'total_return_products',
        'recent_products',
        'total_sales',
        'latest_sales',
        'top_products'
    ));
}
}