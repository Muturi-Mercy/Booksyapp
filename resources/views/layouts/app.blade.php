
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booksy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
                     {{-- remixicons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                {{-- swipercss --}}
    
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
</head>
<body>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

{{-- <HEADER SECTION> --}}
    <header class="header">
        <div class="container">
            <div class="logo">
               <img src="{{ asset('assets/img/logoblue.png') }}" alt="logo" height="155px" width="155px">  
            </div>

            <nav class="menu">
               <div class="head">
                <div class="logo">
                    <img src="{{ asset('assets/img/logoblue.png') }}" alt="logo" height="80px" width="80px">  
                    <button type="button" class="close-menu-btn" ></button>
                </div>
               </div>
               <ul>
                    <li>
                    <a href="">Home</a>  
                    </li>

                    <li class="dropdown">
                        <a href="">Shop</a> 
                        <i class="fa-solid fa-chevron-down"></i>
                        <ul class="sub-menu">
                           <li><a href="#"><span>Books</span></a></li>
                           <li><a href="#"><span>Cart</span></a></li>
                           <li><a href="#"><span>Checkout</span></a></li>
                        </ul>
                    </li>

                    <li  class="dropdown">
                        <a href="">Categories</a> 
                        <i class="fa-solid fa-chevron-down"></i> 
                        <ul class="sub-menu">
                           <li><a href="#"><span>Action</span></a></li>
                           <li><a href="#"><span>Adventure</span></a></li>
                           <li><a href="#"><span>Romance</span></a></li>
                        </ul>
                    </li>

                    {{-- <li  class="dropdown">
                        <a href="">Dashboard</a> 
                        <i class="fa-solid fa-chevron-down"></i> 
                        <ul class="sub-menu">
                           <li><a href="#"><span>User Profile</span></a></li>
                           <li><a href="#"><span>Orders</span></a></li>
                           <li><a href="#"><span>Wishlist</span></a></li>
                        </ul>
                    </li> --}}

                    <li class="dropdown">
                        <a href="">Pages</a>  
                         <i class="fa-solid fa-chevron-down"></i> 
                         <ul class="sub-menu">
                           <li><a href="#"><span>Blog</span></a></li>
                           <li><a href="#"><span>About</span></a></li>
                           <li><a href="#"><span>FAQ</span></a></li>
                        </ul>
                    </li>
                
                    <li>
                        <a href="">Contact</a>  
                    </li>
               </ul>
            </nav>

            <div class="header-right">
                {{-- <button type="button" class="search-btn icon-btn"><i class="fa-solid fa-magnifying-glass fa-xl" style="color: #000000;"></i></i></button> --}}
                <button type="button" class="cart-btn icon-btn"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #000000;"></i></button>
                <a href="{{ route('login') }}" class="btn">
                <i class="fa-solid fa-user fa-xl" style="color: #000000;"></i>
                <span>Login / Register</span>
                </a>
                <button type="button" class="open-menu-btn">
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </button>
            </div>
        </div>
    </header>

{{-- <END HEADER SECTION> --}}

    <main>
        @yield('content')        
    </main>






































    {{-- <div class="container">
       @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert .alert-error">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div> --}}

{{-- <FOOTER SECTION> --}}
    <footer class="footer bg-black">
      <div class="container">
            <div class="footer-grid">
                <div>
                    
                    <div class="card">
                    <h4>Subscribe to Newsletter</h4>
                    <p class="text-sm">
                       Subscribe now to get book updates, reading tips, and exclusive offers sent to you.
                    </p>
                    <form>
                        <input type="email" id="email" placeholder="Enter your email">
                        <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                    </form>
                    </div>
                   
                </div>
                <div>
                    <h4>Company</h4>
                    <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact us </a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Author</a></li>
                    <li><a href="#">Books</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Services</h4>
                    <ul>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Order</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Checkout</a></li>
                    <li><a href="#">Wishlist</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Contact</h4>
                    <ul>
                    <li><a href="#">hello@booksyapp.com</a></li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="footer-grid1">
                    <div>
                        <a href="index.html">
                        <img src="{{ asset('assets/img/logoblue.png') }}"  alt="logo" height="200px" width="200px">
                        </a>
                    </div>
                    
                    <div>
                        <h4>Follow Us:  
                            <i class="fab fa-linkedin"></i>
                            <i class="fab fa-twitter"></i>
                            <i class="fab fa-instagram"></i>
                            <i class="fab fa-youtube"></i>
                        </h4>
                        
                    </div>
                        
                    <div>
                        <a href="3"><p>Terms of Services | Privacy Policy</p></a>
                    </div>
                </div>

                <div class="copyright">
                <p class="text-sm"><i class="fa-regular fa-copyright fa-sm" style="color: #ffffff;"></i>2025 Booksy.All Rights Reserved</p>
                </div>

            </div>
      </div>
    </footer>

    
{{-- <END FOOTER SECTION> --}}








  <script>
    // Auto-dismiss success message
    const successAlert = document.getElementById('flash-success');
    const errorAlert = document.getElementById('flash-error');

    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000); // 5000ms = 5 seconds
    }

    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 5000);
    }
</script>

           {{-- swiper js --}}

<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

@yield('scripts')
</body>
</html>
