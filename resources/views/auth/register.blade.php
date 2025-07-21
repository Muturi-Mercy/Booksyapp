@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: auto; background: white; padding: 30px; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px;">Create an Account</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

        <label>Email:</label>
        <input type="email" name="email" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

        <label>Password:</label>
        <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;">

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">

        <button type="submit" style="width: 100%; background: #28a745; color: white; padding: 10px; border: none; border-radius: 4px;">
            Register
        </button>
    </form>

    <p style="text-align: center; margin-top: 15px;">
        Already have an account? <a href="{{ route('login') }}" style="color: #007bff;">Login</a>
    </p>
</div>
@endsection
