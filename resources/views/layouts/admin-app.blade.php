<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booksy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/img/booksylogo.svg') }}">
</head>
<body>

    <nav class="sidebar close">
        <header>
            <div class="image-text">
                {{-- <span class="image">
                    <img src="{{ asset('assets/img/blacklogo.png') }}" alt="logo">
                </span> --}}
                <div class="text header-text">
                    <span class="name">Booksy</span>
                    {{-- <span class="profession">Online Bookstore</span> --}}
                </div>
            </div>

            <i class="fa-solid fa-chevron-right toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                 <li class="search-box">
                    <i class="fa-solid fa-magnifying-glass icon"></i>
                    <input type="text" placeholder="Search...">
                 </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-house icon"></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('admin.books.index') }}">
                            <i class="fa-solid fa-book icon"></i>
                            <span class="text nav-text">Books</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-users icon"></i>
                            <span class="text nav-text">Users</span>
                        </a>
                    </li>

                     <li class="nav-link">
                        <a href="{{ route('admin.orders.index') }}">
                            <i class="fa-solid fa-box icon"></i>
                            <span class="text nav-text">Orders</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('admin.lowstock') }}">
                            <i class="fa-solid fa-triangle-exclamation icon"></i>
                            <span class="text nav-text">Low Stock</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('admin.revenue.index') }}">
                            <i class="fa-solid fa-chart-line icon"></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">

                <li class="nav-link">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-arrow-right-to-bracket icon"></i>
                            <span class="text nav-text">Logout</span>
                        </button>
                    </form>
                </li>

                <li class="mode">
                   <div class="moon-sun">
                        <i class="fa-solid fa-moon icon moon"></i>
                        <i class="fa-solid fa-sun icon sun"></i>
                   </div>

                   <span class="mode-text text">Dark Mode</span>

                   <div class="toggle-switch">
                    <span class="switch"></span>
                   </div>
                </li>
                
            </div>
        </div>
    </nav>


    <div class="container">
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
        {{-- @yield('content') --}}
    </div>

















































 <main>
    @yield('content')        
 </main>
<script>
    // Auto-hide alert after 3 seconds
    setTimeout(function () {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // Remove after fade out
        }
    }, 3000); // 3 seconds

    
    document.getElementById('orderAllForm').addEventListener('submit', function(e) {
        const confirmed = confirm("Are you sure you want to place all orders?");
        if (!confirmed) {
            e.preventDefault(); // Cancel form submission
        }
    });


</script>



<script src="{{ asset('assets/js/scripts.js') }}"></script>
@yield('scripts')
</body>
</html>