@section('content')
    <section class="dashboard-section">
        <div class="main-content">
                <div class="header-title">
                    <h2> Hello, {{ $user->name }}!</h2>
                    <p>Discover new reads and manage your collection!</p>
                </div>
        </div>

        <div class="card-container">
            <h3 class="main-title">Today's Data</h3>
            <div class="card-wrapper">
                
                <div class="totalorder-card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Orders</span>
                            <span class="amount-value">{{ $totalOrders }}</span>
                        </div>
                        <i class="fas fa-layer-group fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Order summary to date</span>
                </div>

                <div class="totalorder-card light-blue">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Pending Orders</span>
                            <span class="amount-value">{{ $pendingOrders }}</span>
                        </div>
                        <i class="fa-solid fa-spinner fa-spin fa-spin-reverse icons"></i>
                    </div>
                    <span class="card-detail">Waiting for confirmation</span>
                </div>

                <div class="totalorder-card light-purple">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Completed Orders</span>
                            <span class="amount-value">{{ $completedOrders }}</span>
                        </div>
                        <i class="fa-solid fa-circle-check fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Order fulfilled</span>
                </div>

                 <div class="totalorder-card light-green">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Cart Items</span>
                            <span class="amount-value">{{ $cartItems->count() }}</span>
                        </div>
                        <i class="fa-solid fa-cart-shopping fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Review & Checkout</span>
                </div>
            </div>
        </div>
    </section>
    
@endsection

































{{-- <section class="dashboard-section">
        <div style="container">



            <div class="recommended-books">
                <h2>Recommended for You</h2>
                <div class="book-list">
                    @foreach($latestBooks as $book)
                            <div class="book-card">
                                <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" >
                                <h5>{{ $book->title }}</h5>
                                <p class="text-muted">by {{ $book->author }}</p>
                                <p><strong>KES {{ number_format($book->price, 2) }}</strong></p>
                                <p>{{ $book->genre }}</p>
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i><span> Add to cart</span></a>
                            </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section> --}}