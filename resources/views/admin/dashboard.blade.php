@extends('layouts.admin-app')

@section('content')
    @include('partials.adminhome',[
        'totalBooks' => $totalBooks,
        'totalCustomers' => $totalCustomers,
        'totalOrders' => $totalOrders,
        'pendingOrders' =>$pendingOrders,
        'totalRevenue'=> $totalRevenue,
        'lowStock'=>$lowStock
    ])
@endsection
