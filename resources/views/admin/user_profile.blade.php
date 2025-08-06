@extends('layouts.admin-app')

@section('content')

<section class="orderlisting-section">

    <div class="orderlisting-title">
        <h2>Booksy Admin</h2>
        <p>Review detailed information and recent activity for this user.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">User Info</h3>

        <div class="user-profile">

            <h3><strong>Name:</strong><span>  {{ $user->name }}</span></h3>
            <p><strong>Email:</strong> <span>  {{ $user->email }}</span></p>
            <p><strong>Phone:</strong> <span>  {{ $user->phone ?? 'N/A' }}</span></p>
            <p><strong>Address:</strong> <span>  {{ $user->address ?? 'N/A' }}</span></p>
            <p><strong>Registered on:</strong><span>  {{ $user->created_at->format('F d, Y') }}</span></p>

        </div>

    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Order History</h3>

        <div class="continue">
            <a href="{{ route('admin.users.index') }}"><i class="fa-solid fa-circle-arrow-left cicons"></i><span>Back to User List</span></a>    
        </div>

        <div class="table-container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Book</th>
                        <th>Qty</th>
                        <th>Price(KES)</th>
                        <th>Subtotal(KES)</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead> 

                <tbody>
                    @foreach($user->orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <strong>{{ $order->book->title }}</strong><br>
                                @if($order->book->cover_image)
                                    <img src="{{ asset( $order->book->cover_image) }}" alt="Cover" width="40">
                                @endif
                            </td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ number_format($order->book->price, 2) }}</td>
                            <td>{{ number_format($order->book->price * $order->quantity, 2) }}</td>
                            <td style="color: {{ $order->payment_status === 'paid' ? 'green' : 'red' }};">{{ $order->payment_status }}</td>
                            <td style="color: {{ $order->status === 'pending' ? 'orange' : 'green' }};">{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                            <form method="POST" action="{{ route('admin.orders.markComplete', $order->id) }}">
                                @csrf <button class="cart-btn order-btn">Complete</button>
                            </form>
                            <form method="POST" action="{{ route('admin.orders.cancel', $order->id) }}" >
                                @csrf <button class="cart-btn remove-btn" >Cancel</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</section>
@endsection
