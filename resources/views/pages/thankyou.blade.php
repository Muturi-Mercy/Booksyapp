{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div style="max-width: 600px; margin: auto; background: white; padding: 40px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h1 style="font-size: 28px; color: green;">✅ Thank You for Your Purchase!</h1>
    <p style="margin: 20px 0;">Your payment was successful and your order has been completed.</p>
    
    <a href="{{ route('orders.user') }}"
       style="display: inline-block; padding: 12px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 6px;">
        View My Orders
    </a>
</div>
{{-- @endsection --}}
