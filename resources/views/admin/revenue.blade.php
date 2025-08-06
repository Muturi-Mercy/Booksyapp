@extends('layouts.admin-app')

@section('content')
    @include('partials.revenue',[
        'totalRevenue' => $totalRevenue,
        'totalOrders' => $totalOrders,
        'monthlyRevenue' => $monthlyRevenue
    ])

    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                datasets: [{
                    label: 'Revenue (KES)',
                    data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    pointBackgroundColor: '#388E3C',
                    pointBorderColor: '#2E7D32',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#4891ff',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#4891ff',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#4891ff',
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return 'KES ' + value;
                            }
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    }
                }
            }
        });
    </script>
    @endsection
@endsection


