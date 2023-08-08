<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function CategoryDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::orderBy('id', 'asc')->withCount('books')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = '<form action="' .route('categories.destroy',$data->id) .'" method="Post" >
                    <a href="' . route('categories.edit', $data->id).'" class="green">Edit</a>                    
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="red" onclick="confirmation(event)"> Delete </button>
                    </form>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

}
}
