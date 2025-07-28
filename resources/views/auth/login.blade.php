@extends('layouts.app')

@section('content')
    <section class="login-section">
        <div class="container">
            <h2 class="text-lg"><strong>Login to Booksy</strong></h2>

            @if ($errors->any())
                <div class="error-l">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>Email:</label>
                <input type="email" name="email" required class="email-l">

                <label>Password:</label>
                <input type="password" name="password" required class="password-l">

                <button type="submit" class="button-l btn-block">
                    Login
                </button>
            </form>

            <p>
                Don't have an account? <a href="{{ route('register') }}">Register</a>
            </p>
        </div>
    </section>
@endsection 
