<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
     public function index()
    {
        $latestBooks = Book::latest()->take(6)->get();
        $offerBooks =Book::orderBy('price','asc')->take(9)->get();
        $bestsellers = Book::withCount('orders')->orderBy('orders_count', 'desc')->take(9)->get(); 
        return view('pages.home', compact('latestBooks', 'offerBooks', 'bestsellers'));
       
        
    }
}
