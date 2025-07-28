@extends('layouts.app')

@section('content')
    <section class="reg-section">
        <div class="container">
            <h2 class="text-lg"><strong>Create an Account</strong></h2>

            @if ($errors->any())
                <div class="error-r">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label>Name:</label>
                <input type="text" name="name" required class="name-r">

                <label>Email:</label>
                <input type="email" name="email" required class="email-r">

                <label>Password:</label>
                <input type="password" name="password" required class="password-r">

                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation" required class="password-cr">

                <button type="submit" class="button-r btn-block">
                    Register
                </button>
            </form>

            <p>
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </p>
        </div>
    </section>
@endsection
