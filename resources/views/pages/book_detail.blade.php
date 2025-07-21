@extends('layouts.app')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 900px; margin: auto; display: flex; gap: 30px;">

    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://via.placeholder.com/200' }}"
         alt="{{ $book->title }}"
         style="width: 300px; height: 400px; object-fit: cover; border-radius: 5px;">

    <div style="flex: 1;">
        <h1 style="font-size: 26px; margin-bottom: 10px;">{{ $book->title }}</h1>
        <p style="font-size: 16px; margin-bottom: 5px;"><strong>Author:</strong> {{ $book->author }}</p>
        <p style="font-size: 16px; margin-bottom: 5px;"><strong>Genre:</strong> {{ $book->genre }}</p>
        <p style="font-size: 16px; margin-bottom: 5px;"><strong>Stock:</strong> {{ $book->stock_quantity }}</p>
        <p style="font-size: 20px; margin-top: 10px; color: #007bff;"><strong>${{ number_format($book->price, 2) }}</strong></p>

        <p style="margin-top: 20px; font-size: 15px; line-height: 1.6;">{{ $book->description }}</p>

        @auth
        <form method="POST" action="{{ route('orders.store') }}" style="margin-top: 30px;">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" min="1" max="{{ $book->stock_quantity }}" value="1"
                   style="width: 60px; padding: 5px; margin-left: 10px;">

            <button type="submit"
                    style="display: inline-block; margin-left: 20px; padding: 8px 15px; background-color: green; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Add to Order
            </button>
        </form>
        @else
        <p style="margin-top: 20px;">
            <a href="{{ route('login') }}" style="color: #007bff;">Login</a> to place an order.
        </p>
        @endauth
    </div>
</div>
@endsection
