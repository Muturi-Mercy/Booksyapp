<section class="new-arrivals-section">
    <div class="container">
        <div class="section-title">
            <h2 class="text-xxl">New Arrivals</h2>
            <span class="section-separator"></span>
            <p class="text-lg">Check out our latest books</p>
        </div>

        <div class="row">
            @foreach($latestBooks as $book)
                    <div class="book-card">
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" >
                        <h5 >{{ $book->title }}</h5>
                        <p>by {{ $book->author }}</p>
                        <p><strong>KES {{ number_format($book->price, 2) }}</strong></p>
                        <p>{{ $book->genre }}</p>
                        <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i><span> Add to cart</span></a>
                    </div>
            @endforeach
        </div>
    </div>
</section>

