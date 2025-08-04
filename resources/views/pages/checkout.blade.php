@extends('layouts.user-app')

@section('content') 

<div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 25px;">🛒 Checkout</h2>

    <h3>{{ $order->book->title }}</h3>
    <p>Quantity: {{ $order->quantity }}</p>
    <p>Price per book: ${{ number_format($order->book->price, 2) }}</p>
    <p><strong>Total: ${{ number_format($order->book->price * $order->quantity, 2) }}</strong></p>

    <hr style="margin: 20px 0;">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.process', $order->id) }}">
        @csrf

        <label>Shipping Address:</label>
        <textarea name="address" required style="width: 100%; padding: 10px; margin-bottom: 15px;">{{ old('address', auth()->user()->address) }}</textarea>

        <label>Phone Number:</label>
        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" required
               style="width: 100%; padding: 10px; margin-bottom: 20px;">

        <button type="submit"
                style="width: 100%; background-color: green; color: white; padding: 12px; font-size: 16px; border: none; border-radius: 6px;">
            ✅ Pay Now
        </button>
    </form>
</div>
@endsection
