<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index() {
        $books=Books::orderBy('id','asc')->get();

        return view("books",['books'=>$books]);
}

public function create()
    {
        return view("create");
    }

public function store(Request $request) {

        $request->validate([
            'name'=>'required|unique:books|alpha_num',
        ],[
            'name.required' => 'Name is required',
            'name.unique' => 'Name should be unique',
            'name.alpha_num' => 'Name can not include special characters',
            ]
    );
            
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
            'name'=>'required|unique:books|alpha_num',
        ],[
            'name.required' => 'Name is required',
            'name.unique' => 'Name should be unique',
            'name.alpha_num' => 'Name can not include special characters',
            ]);
        
        $book->update($request->all());

        return redirect()->route('books.index')->with('update','Book Has Been updated successfully');
    } 

public function destroy(Books $book)
    {
            
        $book->delete();
        DB::statement("SET @count = 0;");
            DB::statement("UPDATE `books` SET `books`.`id` = @count:= @count + 1;");
            DB::statement("ALTER TABLE `books` AUTO_INCREMENT = 1;");
        return redirect()->route('books.index')->with('success','Book has been deleted successfully');
    }
}