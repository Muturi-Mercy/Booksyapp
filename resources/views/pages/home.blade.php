@extends('layouts.app')

@section('content')
    @include('partials.hero')
    {{-- @include('partials.booksycollection') --}}
    @include('partials.newarrivals',['latestBooks' => $latestBooks])
    @include('partials.bestsellers',['bestsellers' => $bestsellers])
    @include('partials.offers',['offerBooks'=>$offerBooks])
    @include('partials.popularauthors')
    @include('partials.testimonials')
@endsection

