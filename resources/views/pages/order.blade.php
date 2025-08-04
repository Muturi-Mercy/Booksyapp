@extends('layouts.user-app')

@section('content')
   @include('partials.orders', [
    'orders' => $orders,
    'recommendations' => $recommendations
]) 
@endsection
