@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.booksycollection')
    @include('partials.newarrivals')
    @include('partials.bestsellers')
    @include('partials.offers')
    @include('partials.popularauthors')
    @include('partials.testimonials')
@endsection

