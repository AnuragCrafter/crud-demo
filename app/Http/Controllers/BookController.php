<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Books;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()) {

            $query = Books::query();
            $query1 = Category::query();

            if ($request->ajax()) {

                if ($request->category == "Null") {
                    $books = $query->where('user_id', auth()->user()->id)->get();
                    return response()->json(['books' => $books, 'categories' => Category::all()]);
                } else {
                    $books = $query->where('user_id', auth()->user()->id)->where(['category_id' => $request->category])->get();
                    $categories = $query1->where('id', $request->category)->get();
                    return response()->json(['books' => $books, 'categories' => $categories]);
                }
            } else {
                $books = $query->where('user_id', auth()->user()->id)->get();
            }

            $books = $query->get();
            $categories = $query1->get();
            return view('books', compact('categories', 'books'));

        } else {
            return redirect()->route('login');
        }

    }

    public function create()
    {
        return view("create")->with('categories', Category::all());
    }

    public function store(CategoryRequest $request)
    {
        $request->validate([]);
        Books::create([
            'id' => $request->title,
            'name' => $request->name,
            'category_id' => $request->category,
        ]);
        return redirect()->route('books.index')->with('success', 'Book has been created successfully');

    }

    public function show(Books $books)
    {
        return view('books.show', compact('books'));
    }

    public function edit(Books $book)
    {
        return view('edit', compact('book'))->with('categories', Category::all());
    }

    public function update(CategoryRequest $request, Books $book)
    {
        $request->validate([]);
        $book->update([
            'name' => $request->name,
            'category_id' => $request->category,
        ]);

        return redirect()->route('books.index')->with('update', 'Book Has Been updated successfully');
    }

    public function destroy(Books $book)
    {

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book has been deleted successfully');
    }
}
