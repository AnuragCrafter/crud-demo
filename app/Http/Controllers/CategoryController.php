<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view("categories.index", ['categories' => $categories]);
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
        $request->validate([
            'name' => 'required|unique:categories|alpha_num',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories)
    {
        return view('categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:books|alpha_num',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('update', 'Category Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `categories` SET `categories`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `categories` AUTO_INCREMENT = 1;");
        return redirect()->route('categories.index')->with('delete', 'category has been deleted successfully');
    }
}
