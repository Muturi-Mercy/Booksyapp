<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookAdminController extends Controller
{
     public function index()
    {
        $books = Book::orderBy('genre')->get();
        return view('admin.books', compact('books'));
    }

    public function create()
    {
        return view('admin.books_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'cover_image' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);
        return redirect()->route('admin.books.index')->with('success', 'Book added.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books_edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'required',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Book updated.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return back()->with('success', 'Book deleted.');
    }
}
