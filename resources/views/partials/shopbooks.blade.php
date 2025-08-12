<section class="shopbooks-section">
    <div class="container">

        <div class="section-title">
            <h2 class="text-xxl">Explore Our Books</h2>
            <span class="section-separator"></span>
            {{-- <p class="text-md">
                Discover a curated collection of captivating stories, insightful non-fiction, 
                and timeless classics. Browse our selection to find your next great read!
            </p> --}}
        </div>


        <!-- Hidden container with all books -->
        <div class="books-swiper swiper">
            <div class="swiper-wrapper">
                @foreach($books->chunk(15) as $chunk) <!-- 15 books per slide -->
                    <div class="swiper-slide books-swiper-slide">
                        @foreach($chunk as $book)
                            <div class="book-card">
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" >
                                <h5>{{ $book->title }}</h5>
                                <p class="text-muted">by {{ $book->author }}</p>
                                <p><strong>KES {{ number_format($book->price, 2) }}</strong></p>
                                <p>{{ $book->genre }}</p>
                                @auth
                                    <!-- If logged in -->
                                    <form method="POST" action="{{ route('cart.add', $book->id) }}" >
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btn btn-primary"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i><span>Add to Cart</span></button>
                                    </form>
                                @else
                                    <!-- If NOT logged in -->
                                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i>
                                        Add to Cart
                                    </a>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="books-swiper-button-prev swiper-button-prev"></div>
            <div class="books-swiper-button-next swiper-button-next"></div>

            <!-- Pagination -->
            <div class="books-swiper-pagination swiper-pagination"></div>
        </div>

    </div>
</section>
