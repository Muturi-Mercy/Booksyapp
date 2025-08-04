@extends('layouts.user-app')

@section('content')
    @include('partials.cart', [
    'recommendations' => $recommendations,
    'total' => $total
    ])

@endsection


