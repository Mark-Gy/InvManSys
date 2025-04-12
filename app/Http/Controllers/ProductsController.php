<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSizeStock;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->orderby('created_at', 'DESC')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products',//
            'name' => 'required|string|min:2|max:200',//
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',//
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'expiration_date' => 'required|date',//
            'description' => 'required|string|max:200',//
            'status' => 'required|numeric',

        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validate->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product = new Product();
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->expiration_date = $request->expiration_date;
        $product->description = $request->description;
        $product->status = $request->status;

        //Image
        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = Str::random(60).'.' . $image->getClientOriginalExtension();
            $image->storeAs('product_images', $name, 'public');
            $product->image = $name;
        }
        $product->save();

        //Product Size
        if ($request->items) {
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id = $item->size_id;
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                $size_stock->save();
            }
        }

        flash('Product Created Succesfully!')->success();

        if ($validate->fails()) {
            return response()->json([
                'success' => true,
            ], Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'brand', 'product_stocks.size'])
        ->where('id', $id)->first();
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id', $id)->with(['product_stocks'])->first();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products,sku,'.$id,
            'name' => 'required|string|min:2|max:200',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'expiration_date' => 'required|date',
            'description' => 'required|string|max:200',
            'status' => 'required|numeric',
        ]);
    
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validate->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $product = Product::findOrFail($id);
        
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->expiration_date = $request->expiration_date;
        $product->description = $request->description;
        $product->status = $request->status;
    
        //Image
        if ($request->hasFile('image')) {
            $image = $request->image;
            $name = Str::random(60).'.' . $image->getClientOriginalExtension();
            $image->storeAs('product_images', $name, 'public');
            $product->image = $name;
        }
        $product->save();
    
        ProductSizeStock::where('product_id', $id)->delete();
    
        //Product Size
        if ($request->items) {
            foreach (json_decode($request->items) as $item) {
                $size_stock = new ProductSizeStock();
                $size_stock->product_id = $product->id;
                $size_stock->size_id = $item->size_id;
                $size_stock->location = $item->location;
                $size_stock->quantity = $item->quantity;
                $size_stock->save();
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'redirect' => route('products.index') // Add this if you want to redirect
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product ->delete();
        flash('Product Deleted Succesfully!')->success();
        return back();
    }
}
