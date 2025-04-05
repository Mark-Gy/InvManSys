<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderby('created_at', 'DESC')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        flash('Category Created Succesfully!')->success();
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
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50|unique:categories,name,' . $id
        ]);        

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        flash('Category Updated Succesfully!')->success();
        return redirect()->route('categories.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category ->delete();

        flash('Category Deleted Succesfully!')->success();
        return redirect()->route('categories.index'); 
    }

    //AJAX Handlers
    public function getCategoriesJson()
    {
        $categories = Category::all();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ], Response::HTTP_OK );
    }
    
}
