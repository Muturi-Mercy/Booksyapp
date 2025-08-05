<section class="cart-section">
    
    <div class="cart-title">
        <h2>Booksy</h2>
        <p>Almost there! These books are waiting to be yours.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Cart</h3>
        
        <div class="continue">
            <a href="{{ route('shop.index') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Continue Shopping</span></a>    
        </div>
    
        <div class="table-container">
            <table>

                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Price (KES)</th>
                        <th>Quantity</th>
                        <th>Subtotal (KES)</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->book->cover_image }}" alt="{{ $item->book->title }}" width="70px">
                            </td>
                            <td>{{ $item->book->title }}</td>
                            <td>{{ number_format($item->book->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" >
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"  style="width: 60px;" class="update-input">
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                            </td>

                            <td>{{ number_format($item->book->price * $item->quantity, 2) }}</td>
                            <td>
                                <!-- Order Button -->
                                <form method="POST" action="{{ route('orders.cart') }}" onsubmit="return confirm('Place order for this book?');">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $item->book->id }}">
                                    <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                                    <button class="cart-btn order-btn">Order</button>
                                </form>

                                <!-- Remove Button -->
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    <button class="cart-btn remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" ><strong>Total (KES)</strong></td>
                        <td><strong> {{ number_format($total, 2) }}</strong></td>
                        <td>
                            <form action="{{ route('cart.orderAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to place all orders?');">
                                @csrf
                                <button type="submit" class="all-btn">Place All Orders</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>
    
    </div>

    <!-- Recommendations -->

    <div class="recommendation-content">
    
        @if($recommendations->count() > 0)
            <div class="rec-title">
                <h2>Recommended for you</h2>
                <p>Curated just for you—explore what's trending now.</p>
            </div>

            <div class="row">
                @foreach($recommendations as $book)
                    <div class="book-card">
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" >  
                        <h5>{{ $book->title }}</h5>
                        <p>by {{ $book->author }}</p>
                        <p>{{ $book->genre }}</p>
                        <p><strong>KES {{ number_format($book->price, 2) }}</strong></p>
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
