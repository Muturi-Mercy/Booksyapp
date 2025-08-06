<section class="orderlisting-section">
    <div class="orderlisting-title">
        <h2>Booksy Admin</h2>
        <p>Track total revenue, monitor monthly trends, and gain insights from book sales performance.</p>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Revenue Dashboard</h3>

        <div class="card-wrapper">

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

        </div>
    </div>

    <div class="tabular-wrapper">

        <h3 class="cartmain-title">Monthly Revenue</h3>

         <div class="chart-section">
            <canvas id="revenueChart"></canvas>
        </div>

    </div>

</section>   

   

   

