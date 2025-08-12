<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookCatalogController extends Controller
{
    public function index(){
       $books = Book::latest()->get();
        return view('pages.books', compact('books')); 
    }

    // public function show($id){
    //     $book =Book::findOrFail($id);
    //     return view('pages.book_detail',compact('book'));
    // }
   
    public function shop($genre = null)
{
    $query = Book::query();

    if ($genre) {
        
        $query->where('genre', ucfirst($genre));

    }

    $books = $query->latest()->get();

    return view('pages.books', compact('books', 'genre'));
}

}
