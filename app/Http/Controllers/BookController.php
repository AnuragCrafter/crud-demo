<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Books::where('user_id', auth()->user()->id)->get();
        $categories = Category::orderBy('id', 'asc')->get();
        return view('books', compact('categories', 'books'));
    }

    public function create()
    {
        return view("create")->with('categories', Category::all());
    }

    public function store(BookRequest $request)
    {
        $request->validate([]);
        Books::create([
            'id' => $request->title,
            'name' => $request->name,
            'category_id' => $request->category,
        ]);
        return redirect()->route('books.index')
            ->with('success', 'Book has been created successfully');

    }

    public function show(Books $books)
    {
        return view('books.show', compact('books'));
    }

    public function edit(Books $book)
    {
        return view('edit', compact('book'))->with('categories', Category::all());
    }

    public function update(BookRequest $request, Books $book)
    {
        $request->validate([]);

        $book->update([
            'name' => $request->name,
            'category_id' => $request->category,
        ]);

        return redirect()->route('books.index')
            ->with('update', 'Book Has Been updated successfully');
    }

    public function destroy(Books $book)
    {

        $book->delete();
        return redirect()->route('books.index')
            ->with('success', 'Book has been deleted successfully');
    }

    public function CategoryFilter(Request $request)
    {
        $book = Books::query();
        $category = Category::query();

        if ($request->ajax()) {

            $books = $book->when($request->category != "", function ($book) use ($request) {
                return $book
                    ->where('user_id', auth()->user()->id)
                    ->where('category_id', $request->category)
                    ->join('categories', 'books.category_id', '=', 'categories.id')
                    ->select('books.name as book_name', 'categories.name as category_name')
                    ->get();
            }, function ($book) {
                return $book
                    ->where('user_id', auth()->user()->id)
                    ->join('categories', 'books.category_id', '=', 'categories.id')
                    ->select('books.name as book_name', 'categories.name as category_name')
                    ->get();
            });
            return response()->json(['categories' => $books]);

        } else {
            $books = $book->where('user_id', auth()->user()->id)->get();
        }

        $books = $book->get();
        $categories = $category->get();
        return view('books', compact('categories', 'books'));
    }
}
