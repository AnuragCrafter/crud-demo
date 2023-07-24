<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::orderBy('id', 'asc')->get();

        return view("books", ['books' => $books]);
    }

    public function create()
    {
        return view("create")->with('categories',Category::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:books|regex:/[a-zA-Z0-9\s]+/',
            'category' => 'required'
        ]);

        Books::create([
            'id'=> $request->title,
            'name'=> $request->name,
            'category_id'=> $request->category,
        ]);
        return redirect()->route('books.index')->with('success','Book has been created successfully');

    }

    public function show(Books $books)
    {
        return view('books.show', compact('books'));
    }

    public function edit(Books $book)
    {
        return view('edit', compact('book'))->with('categories',Category::all());
    }

    public function update(Request $request, Books $book)
    {
        $request->validate([
            'name' => 'required|unique:books|alpha_num',
            'category' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('update', 'Book Has Been updated successfully');
    }

    public function destroy(Books $book)
    {

        $book->delete();
        DB::statement("SET @count = 0;");
        DB::statement("UPDATE `books` SET `books`.`id` = @count:= @count + 1;");
        DB::statement("ALTER TABLE `books` AUTO_INCREMENT = 1;");
        return redirect()->route('books.index')->with('success', 'Book has been deleted successfully');
    }
}
