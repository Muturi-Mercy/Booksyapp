@section('content')

    <section class="dashboard-section">

        <div class="main-content">
            <div class="header-title">
                <h2>Welcome back {{ auth()->user()->name }}!</h2>
                <p>Monitor orders, manage books, and oversee system activity.</p>
            </div>
        </div>

        <div class="card-container">
            <h3 class="main-title">Today's Data</h3>
            <div class="card-wrapper">

                <div class="totalorder-card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Books</span>
                            <span class="amount-value">{{ $totalBooks }}</span>
                        </div>
                        <i class="fa-solid fa-book-open-reader fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Books available in catalog</span>
                </div>

                <div class="totalorder-card light-blue">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Customers</span>
                            <span class="amount-value">{{ $totalCustomers }}</span>
                        </div>
                        <i class="fa-solid fa-users fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Registered users in the system</span>
                </div>

                <div class="totalorder-card light-green">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Orders</span>
                            <span class="amount-value">{{ $totalOrders }}</span>
                        </div>
                        <i class="fas fa-layer-group fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Placed orders to date</span>
                </div>

                <div class="totalorder-card light-purple">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Pending Orders</span>
                            <span class="amount-value">{{ $pendingOrders }}</span>
                        </div>
                        <i class="fa-solid fa-spinner fa-spin fa-spin-reverse icons"></i>
                    </div>
                    <span class="card-detail">Waiting for confirmation</span>
                </div>

                <div class="totalorder-card light-red">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Revenue</span>
                            <span class="amount-value">KES {{ number_format($totalRevenue, 2) }}</span>
                        </div>
                        <i class="fa-solid fa-sack-dollar fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Revenue from completed orders</span>
                </div>

                <div class="totalorder-card light-blue">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Low Stock Books</span>
                            <span class="amount-value">{{ $lowStock }}</span>
                        </div>
                        <i class="fa-solid fa-triangle-exclamation fa-beat icons"></i>
                    </div>
                    <span class="card-detail">Books running out of stock</span>
                </div>

            </div>
        </div>
                
    </section>
@endsection