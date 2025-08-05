@extends('layouts.user-app')

@section('content') 
    <section class="checkout-section">

        <div class="checkout-title">
            <h2>Booksy</h2>
            <p>Review your selected books and complete your purchase securely.</p>
        </div>

        <div class="checkout-content">

            <h3 class="checkoutmain-title">Checkout</h3>

            <div class="continue">
                <a href="{{ route('orders.user') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Back to Orders</span></a>    
            </div>

            <div class="checkout-container">
                <div class="check-container1">
                    <div class="book-card">
                        <img src="{{ $order->book->cover_image }}" alt="{{ $order->book->title }}" >  
                        <h5>{{ $order->book->title }}</h5>
                        <p><strong>by {{ $order->book->author }}</strong></p>
                        <p>{{ $order->book->genre }}</p>
                    </div>
                    
                    <div class="checkout-info light-green">
                        <div class="card-header">
                            <div class="amount">
                                <span class="title"><strong>Quantity: </Strong>{{ $order->quantity }}</span>
                                <span class="title"><strong>Price per book:</strong> KES {{ number_format($order->book->price, 2) }}</span>
                                <span class="amount-value"><strong>Total: KES {{ number_format($order->book->price * $order->quantity, 2) }}</strong></span>
                            </div>
                        </div>
                    </div>

                </div>
                <hr style="margin: 20px 0;">
                    
                <div class="check-form">
                    <form method="POST" action="{{ route('checkout.process', $order->id) }}">
                        @csrf
                        <div class="form-row">
                            <label class="plabel"><strong>Shipping Address:</strong></label>
                            <textarea name="address" required class="pinput">{{ old('address', auth()->user()->address) }}</textarea>
                            <label class="plabel"><strong>Phone Number:</strong></label>
                            <textarea  name="phone" required class="pinput">{{ old('phone', auth()->user()->phone) }} </textarea>
                        </div>
                        <button type="submit" class="pbtn">Pay Now</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
