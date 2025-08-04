<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Show all unique genres.
     */
    public function index()
    {
        $genres = Book::select('genre')->distinct()->get();
        return view('pages.shop', compact('genres'));
    }

    /**
     * Show books filtered by genre.
     */
    public function showByGenre($genre)
    {
        $books = Book::where('genre', $genre)->get();
        return view('partials.genre', compact('books', 'genre'));
    }

    /**
     * Add a book to the authenticated user's cart.
     */
    public function addToCart(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $existingItem = $user->cartItems()->where('book_id', $book->id)->first();

        if ($existingItem) {
            // If the book is already in the cart, increment the quantity
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            // Else, create a new cart item
            $user->cartItems()->create([
                'book_id' => $book->id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Book added to cart!');
    }

    /**
     * Show all items in the user's cart.
     */
    public function viewCart()
    {
        $cartItems = Auth::user()->cartItems()->with('book')->get();
        return view('pages.cartitem', compact('cartItems'));
    }
}
 