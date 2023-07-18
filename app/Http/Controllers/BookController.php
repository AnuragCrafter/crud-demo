<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index() {
        $books=Books::orderBy('id','asc')->paginate(100);

        return view("books",['books'=>$books]);
}

public function create()
    {
        return view("create");
    }

public function store(Request $request) {

        $request->validate([
            'name'=>'required',
        ]);
            DB::statement("SET @count = 0;");
            DB::statement("UPDATE `books` SET `books`.`id` = @count:= @count + 1;");
            DB::statement("ALTER TABLE `books` AUTO_INCREMENT = 1;");
            Books::create($request->all());
            return redirect()->route('books.index')->with('success','Book has been created successfully');

}

public function show(Books $books)
    {
        return view('books.show',compact('books'));
    }

    public function edit(Books $book)
    {
        return view('edit',compact('book'));
    }

    public function update(Request $request, Books $book)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        $book->update($request->all());

        return redirect()->route('books.index')->with('success','Book Has Been updated successfully');
    } 

public function destroy(Books $book)
    {
            
        $book->delete();
        return redirect()->route('books.index')->with('success','Book has been deleted successfully');
    }
}