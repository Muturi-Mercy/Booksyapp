@extends('layouts.app')

@section('content')
    <h1>All Books</h1>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">

        @foreach ($books as $book)
            <div style="width: 250px; background: white; padding: 15px; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://via.placeholder.com/150' }}"
                     alt="{{ $book->title }}"
                     style="width: 100%; height: 200px; object-fit: cover; margin-bottom: 10px; border-radius: 3px;">

                <h2 style="font-size: 18px; margin: 0 0 5px;">{{ $book->title }}</h2>
                <p style="margin: 0; font-size: 14px; color: #555;">Author: {{ $book->author }}</p>
                <p style="margin: 5px 0; font-size: 14px; color: #777;">Genre: {{ $book->genre }}</p>
                <p style="font-weight: bold; color: #007bff;">${{ number_format($book->price, 2) }}</p>

                <a href="{{ route('books.show', $book->id) }}" style="display: block; text-align: center; margin-top: 10px; background: #007bff; color: white; padding: 8px; border-radius: 4px; text-decoration: none;">
                    View Details
                </a>
            </div>
        @endforeach

    </div>
@endsection
