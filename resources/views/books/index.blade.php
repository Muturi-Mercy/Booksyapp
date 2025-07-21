@extends('layouts.app')

@section('content')
    <h1>All Books 📚</h1>
    <div class="book-grid">
        @foreach ($books as $book)
            <div class="book-card">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="book-cover">
                <h3>{{ $book->title }}</h3>
                <p>By {{ $book->author }}</p>
                <p>Genre: {{ $book->genre }}</p>
                <p>KES {{ $book->price }}</p>
                <a href="{{ route('books.show', $book->id) }}">View Book</a>
            </div>
        @endforeach
    </div>
@endsection

