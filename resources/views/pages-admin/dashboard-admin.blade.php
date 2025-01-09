@extends('layouts.layout-admin')

@section('title', 'Dashboard-Admin')

@section('content')

<!-- Tambahkan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Content Area -->
<div class="flex-1 p-3">
    <div class="mb-6">
        <!-- Hallo Icon with container -->
        <div class="flex items-center justify-start mt-4">
            <div class="p-2 bg-gradient-to-r from-blue-400 to-indigo-500 text-white rounded-lg shadow-sm flex items-center space-x-3">
                <span class="text-3xl">👋</span>
                <span class="text-lg font-semibold">Hallo {{ Auth::user()->name }}, Selamat datang di Dashboard!</span>
            </div>
        </div>

        <!-- Statistik Kartu -->
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow-lg p-6 mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Total Pesanan -->
                    <div class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 p-4 rounded shadow flex flex-col sm:flex-row justify-between items-center">
                        <div>
                            <h2 class="text-white font-semibold">Total Pesanan</h2>
                            <p class="text-2xl text-white font-bold">{{ $totalpemesanan }}</p>
                        </div>
                        <i class="fa-solid fa-car-side fa-5x text-white"></i>
                    </div>

                    <!-- Total Pendapatan -->
                    <div class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 p-4 rounded shadow flex flex-col sm:flex-row justify-between items-center">
                        <div>
                            <h2 class="text-white font-semibold">Total Pendapatan</h2>
                            <p class="text-2xl text-white font-bold">Rp {{ number_format($totalpendapatan, 3, ',', '.') }}</p>
                        </div> 
                        <i class="fa-solid fa-money-bill-wave fa-5x text-white"></i>
                    </div>

                    <!-- Jumlah Pelanggan -->
                    <div class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 p-4 rounded shadow flex flex-col sm:flex-row justify-between items-center">
                        <div>
                            <h2 class="text-white font-semibold">Jumlah Pelanggan</h2>
                            <p class="text-2xl text-white font-bold">{{ $jumlahpelanggan }}</p>
                        </div>
                        <i class="fas fa-users fa-5x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

<!-- Diagram Statistik -->
<div class="mt-6">
    <div class="overflow-x-auto">
        <div class="min-w-full w-64">
            <div class="bg-white rounded-lg shadow-lg p-6 mx-auto">
                <h3 class="text-lg font-semibold mb-4 text-center">Statistik Diagram Per Bulan</h3>
                <!-- Chart Responsif -->
                <canvas id="statisticsChart" class="w-full" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script>
    // Data Manual untuk Diagram
    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Pesanan',
                data: [120, 150, 180, 200, 230, 210, 190, 220, 240, 260, 250, 270], // Data Pesanan
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Pendapatan',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3600], // Hanya di bulan Desember
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Pelanggan',
                data: [30, 40, 50, 55, 60, 58, 54, 65, 70, 75, 72, 80], // Data Pelanggan
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.3,
                fill: true
            }
        ]
    };

    // Konfigurasi Chart
    const config = {
        type: 'line', // Menggunakan diagram garis
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render Chart
    const statisticsChart = new Chart(
        document.getElementById('statisticsChart'),
        config
    );
</script>


@endsection
