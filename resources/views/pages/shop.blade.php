@extends('layouts.user-app')

@section('content')
    <section class="shop-section">

        <div class="sheader-title">
            <h2>Booksy</h2>
            <p>Choose a genre and start building your personal library.</p>
        </div>

        <div class="shop-content"> 
            @php
                $colors = ['light-red', 'light-purple','light-blue'];
            @endphp
            <div class="scard-wrapper">
                @foreach ($genres as $index =>$genre)
                    <div class="genre-card {{ $colors[$index % count($colors)] }}">

                        <div class="scard-header">
                            <h4>{{ ucfirst($genre->genre) }}</h4>
                        </div>

                        <div class="ficons">
                            <i class="fa-solid fa-book-open-reader fa-fade"></i>
                        </div>

                        <div class="scard-footer">
                            <a href="{{ route('shop.genre', $genre->genre) }}" >
                                View Books
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection

                