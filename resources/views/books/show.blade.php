@extends('layouts.app')

@section('content')
    <h1>{{ $book->title }}</h1>
    <img src="{{ asset('storage/' . $book->cover_image) }}" style="width: 300px">
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>Genre:</strong> {{ $book->genre }}</p>
    <p><strong>Price:</strong> KES {{ $book->price }}</p>
    <p><strong>Stock:</strong> {{ $book->stock_quantity }}</p>
@endsection
