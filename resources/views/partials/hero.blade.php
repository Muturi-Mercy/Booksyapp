<section class="hero-section">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
      
    <div class="container">
        
        <div class="hero-details">
            <h2 class="title text-xxl">A World of Words Awaits</h2>
            {{-- <h3 class="subtitle text-xl">
            Fuel Your Mind.<br> Feed Your Soul.
            </h3> --}}
            <p class="description text-md">
            From bestselling novels to undiscovered treasures — explore books that matter.
            Start your next chapter today — your perfect read is just a click away.
            </p>

            <div class="hero-button">
                <a href="{{ route('books.index') }}" class="h-btn shop-now">SHOP NOW</a> 
                <a href="#new-arrivals" class="h-btn tour">TAKE A TOUR</a>  
            </div>
        </div>

        <div class="hero-image-wrapper">
            <img src="{{ asset('assets/img/book-bg1.png') }}" alt="imghero" class="hero-image">
            {{-- <img src="{{ asset('assets/img/shooting.png') }}" alt="imghero" class="hero-image" width="60px" height="60px">
            <img src="{{ asset('assets/img/shooting.png') }}" alt="imghero" class="hero-image" width="60px" height="60px"> --}}

        </div>
        
    </div>
</section>