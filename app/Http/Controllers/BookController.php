<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {

        if (auth()->user()) {
            if ($request->category == "All") {

                $books = Books::orderBy('id', 'asc')->where('user_id', auth()->user()->id)->get();

            } elseif ($request->category) {

                $books = Books::orderBy('id', 'asc')->where('user_id', auth()->user()->id)->where('category_id', $request->category)->get();

                
            } else {

                $books = Books::orderBy('id', 'asc')->where('user_id', auth()->user()->id)->get();

            }
            return view("books", ['books' => $books])->with('categories', Category::all());
        } else {
            return redirect()->route('login');
        }
        
    }

    public function create()
    {
        return view("create")->with('categories', Category::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:books|regex:/[a-zA-Z0-9\s]+/',
            'category' => 'required',
        ],[
            'category' => 'Create category first',
        ]);
        Books::create([
            'id' => $request->title,
            'name' => $request->name,
            'category_id' => $request->category,
            'category_name' => $request->category,
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

    public function update(Request $request, Books $book)
    {
        $request->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
            'category' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('update', 'Book Has Been updated successfully');
    }

    public function destroy(Books $book)
    {

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book has been deleted successfully');
    }
}
