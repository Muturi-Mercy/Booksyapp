<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::all();  // List all books
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //create a new book
    {
        $data = $request->validate([
            'title'=> 'required',
            'author'=> 'required',
            'genre'=> 'required',
            'price'=> 'required|numeric',
            'stock_quantity'=> 'required|integer',
            'cover_image'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image')){
            $path = $request->file('cover_image')->store('covers','public');
            $data['cover_image']=$path;
        }

        $book =Book::create($data);
        return response()->json($book,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)  //show a single book
    {
        $book =Book::find($id);

        if (!$book) {
            return response()->json(['message'=>'Book not found'],404);
        }
        return $book;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id) //Update an existing book
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes',
            'author' => 'sometimes',
            'genre' => 'sometimes',
            'price' => 'sometimes|numeric',
            'stock_quantity' => 'sometimes|integer',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image'))
        {
            $path = $request->file('cover_image')->store('covers','public');
            $data['cover_image']=$path;
        }
        
        $book->update($data);
        return response()->json($book);
    
    }
    //low stock monitering
    public function lowStock(){
        $lowStockBooks = Book::where('stock_quantity','<=',5)->get();
        
        if($lowStockBooks->isEmpty()){
            return response()->json(['message'=>'All books are well stocked']);
        }
        
        return response()->json(['message'=>'Low stock books','data'=>$lowStockBooks]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)  //Delete a book
    {
         $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }
}
