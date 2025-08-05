<section class="order-section">

    <div class="order-title">
        <h2>Booksy</h2>
        <p>Track, manage, and review all your book orders in one place.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="ordermain-title">Orders</h3> 

        <div class="continue">
        <a href="{{ route('shop.index') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Continue Shopping</span></a>    
        </div>

        <div class="table-container">
            @if ($orders->isEmpty())
                <p>You haven't placed any orders yet.</p>
            @else

                <table>
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Title</th>
                            <th >Quantity</th>
                            <th >Total(KES)</th>
                            <th >Status</th>
                            <th >Payment</th>
                            <th >Date</th>
                            <th >Action</th>
                            <th>Payment</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->book->title ?? 'N/A' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->book->price * $order->quantity, 2) }}</td>
                                <td>
                                    <span style="color: {{ $order->status === 'pending' ? 'orange' : 'green' }};">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td >
                                    <span style="color: {{ $order->payment_status === 'paid' ? 'green' : 'red' }};">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                <td>
                                    @if ($order->status === 'pending')
                                        <form method="POST" action="{{ route('orders.cancel', $order->id) }}">
                                            @csrf
                                            <button type="submit" class="order-btn cancel-btn">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif

                                    @if ($order->status === 'completed' || $order->status === 'cancelled')
                                        <form method="POST" action="{{ route('orders.reorder', $order->id) }}">
                                            @csrf
                                            <button type="submit" class="order-btn reorder-btn">
                                                Reorder
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                @if ($order->payment_status === 'unpaid' && $order->status === 'pending')
                                    <a href="{{ route('checkout.show', $order->id) }}"
                                    class="order-btn checkout-btn">
                                        Checkout
                                    </a>
                                @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    @if ($orders->where('payment_status', 'unpaid')->where('status', 'pending')->count() > 0)
                        <tfoot>
                            <tr>
                                <td colspan="3"><strong>Total (KES)</strong></td>
                                <td><strong>{{ number_format($orders->where('payment_status', 'unpaid')->where('status', 'pending')->sum(function($order) {
                                    return $order->book->price * $order->quantity;
                                }), 2) }}</strong></td>
                                <td colspan="4"></td>
                                <td>
                                    <form action="{{ route('orders.placeAll') }}" method="POST" onsubmit="return confirm('Are you sure you want to place all orders?');">
                                        @csrf
                                        <button type="submit" class="all-btn">Checkout All</button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                    
                </table>
            @endif
        </div>
    </div> 
    
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
                        <p><strong>{{ number_format($book->price, 2) }}</strong></p>
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

