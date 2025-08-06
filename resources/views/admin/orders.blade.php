@extends('layouts.admin-app')

@section('content')
<section class="orderlisting-section">

    <div class="orderlisting-title">
        <h2>Booksy Admin</h2>
        <p>View, approve, and manage all customer orders from one central place.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Order List</h3>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->book->title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td style="color: {{ $order->status === 'pending' ? 'orange' : 'green' }};">{{ $order->status }}</td>
                        <td style="color: {{ $order->payment_status === 'paid' ? 'green' : 'red' }};">{{ $order->payment_status }}</td>
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
