<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSizeStock;
use App\Models\SoldItem;

class SoldItemsController extends Controller
{
    public function index()
    {
        $soldItems = SoldItem::with(['product', 'size'])
            ->orderBy('sold_at', 'asc')
            ->get();
    
        return view('sold_items.history', compact('soldItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.size_id' => 'required|exists:sizes,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);
    
        foreach ($validated['items'] as $item) {
            $psq = ProductSizeStock::where('product_id', $validated['product_id'])
                ->where('size_id', $item['size_id'])
                ->first();
    
            if ($psq) {
                $psq->save();
            }
    
            SoldItem::create([
                'product_id' => $validated['product_id'],
                'size_id' => $item['size_id'],
                'quantity' => $item['quantity'],
                'sold_at' => $validated['date']->default(now()),
            ]);
        }
    
        return response()->json(['message' => 'Sold items recorded successfully'])->redirect ('/sold');
    }
    public function create()
    {
        return view('sold_items.sold');
    }
    
}
