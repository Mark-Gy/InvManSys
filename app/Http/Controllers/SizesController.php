<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Http\Response;


class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::orderby('created_at', 'DESC')->get();
        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:1|max:50|unique:sizes',
        ]);

        $size = new Size();
        $size->name = $request->name;
        $size->save();

        flash('Size Created Succesfully!')->success();
        return back(); 
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = Size::findOrFail($id);

        return view('sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:1|max:50|unique:sizes,name,' . $id
        ]);        

        $size = Size::findOrFail($id);
        $size->name = $request->name;
        $size->save();

        flash('Size Updated Succesfully!')->success();
        return redirect()->route('sizes.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::findOrFail($id);
        $size ->delete();

        flash('Size Deleted Succesfully!')->success();
        return redirect()->route('sizes.index'); 
    }

    public function getCategoriesJson()
    {
        $sizes = Size::all();
        
        return response()->json([
            'success' => true,
            'data' => $sizes
        ], Response::HTTP_OK );
    }
}
