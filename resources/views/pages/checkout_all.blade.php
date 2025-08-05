@extends('layouts.user-app')

@section('content')
    <section class="checkout-section">
        <h2>Checkout All Orders</h2>
        <p>Review and confirm your orders below.</p>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.processAll') }}">
            @csrf
            <input type="hidden" name="order_ids" value="{{ implode(',', $orderIds) }}">

            <div class="order-summary">
                <h3>Order Summary</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Total (KES)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->book->title ?? 'N/A' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ number_format($order->book->price * $order->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total (KES)</strong></td>
                            <td><strong>{{ number_format($orders->sum(function($order) {
                                return $order->book->price * $order->quantity;
                            }), 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ auth()->user()->address ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ auth()->user()->phone ?? '' }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Confirm All Orders</button>
        </form>

        <a href="{{ route('orders.user') }}" class="btn btn-secondary">Back to Orders</a>
    </section>
@endsection