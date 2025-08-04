@extends('layouts.user-app')

@section('content')
    <section class="genre-section">

        <div class="gheader-title">
            <h2>{{ ucfirst($genre) }} Books</h2>
            <p>Explore top picks in the <strong>{{ ucfirst($genre) }}</strong> genre and add your favorites to the cart.</p>
        </div>

        <div class="genre-content">
            <a href="{{ route('shop.index') }}"><i class="fa-solid fa-circle-arrow-left gicons"></i><span>Back to Genres</span></a>

            @if ($books->isEmpty())
                <p>No books found in this genre.</p>
            @else

                <div class="row">
                    @foreach ($books as $book)
                            <div class="book-card">
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" >
                                <h5>{{ $book->title }}</h5>
                                <p>by {{ $book->author }}</p>
                                <p><strong>KES {{ number_format($book->price) }}</strong></p>
                                <form method="POST" action="{{ route('cart.add', $book->id) }}">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i><span>Add to Cart</span></button>
                                </form>
                            </div>
                    @endforeach
                </div>
                
            @endif
        </div>

    </section>
@endsection
