<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Http\Response;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderby('created_at', 'DESC')->get();
        return view('brands.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50|unique:brands',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();

        flash('Brand Created Succesfully!')->success();
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
        $brand = Brand::findOrFail($id);

        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50|unique:brands,name,' . $id
        ]);        

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->save();

        flash('Brand Updated Succesfully!')->success();
        return redirect()->route('brands.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand ->delete();

        flash('Brand Deleted Succesfully!')->success();
        return redirect()->route('brands.index'); 
    }

    public function getBrandsJson()
    {
        $brands = Brand::all();
        
        return response()->json([
            'success' => true,
            'data' => $brands
        ], Response::HTTP_OK );
    }
}
