@extends('layouts.user-app')

@section('title', 'Unauthorized')

@section('content')
<div style="text-align: center; padding: 60px;">
    <h1>🚫 403 - Unauthorized</h1>
    <p>You do not have permission to access this page.</p>
    <a href="{{ url('/') }}">Return to Home</a>
</div>
@endsection
