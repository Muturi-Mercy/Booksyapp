@extends('layouts.app')

@section('content')
     @include('partials.shopbooks',['books' =>$books])
@endsection
