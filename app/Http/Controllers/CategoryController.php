<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view("categories.index", ['categories' => $categories]);
    }

    
    public function create()
    {
        return view('categories.create');
    }

    
    public function store(CategoryRequest $request)
    {
        $request->validate([]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category has been created successfully');
    }

    
    public function show(Category $categories)
    {
        return view('categories.show', compact('categories'));
    }

    
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    
    public function update(CategoryRequest $request, Category $category)
    {
        $request->validate([]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('update', 'Category Has Been updated successfully');
    }

    
    public function destroy(Category $category)
    {
        $category->books()->delete();
        $category->delete();
        return redirect()->route('categories.index')->with('delete', 'category has been deleted successfully');
    }
}
