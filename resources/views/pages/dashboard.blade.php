@extends('layouts.user-app')

@section('content')
    @include('partials.dhome',['latestBooks' => $latestBooks])
@endsection
