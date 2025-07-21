@extends('layouts.app')

@section('content')
    <h1>Welcome to Booksy 📖</h1>
    <p>Discover your next great read.</p>
    <p><a href="{{ route('books.index') }}">Browse All Books</a></p>
@endsection

