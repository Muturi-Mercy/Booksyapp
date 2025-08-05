@extends('layouts.user-app')
    @section('content')
        <section class="thank-section">
            <h1><span><i class="fa-solid fa-circle-check"></i></span> Thank You for Your Purchase!</h1>
            <p>Your payment was successful and your order is being processed.</p>
            
            <a href="{{ route('orders.user') }}" class="thank-btn">View My Orders</a>
        </section>
    @endsection

