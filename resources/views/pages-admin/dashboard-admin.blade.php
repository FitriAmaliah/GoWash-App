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
                            <p class="text-2xl text-white font-bold">Rp {{ number_format($totalpendapatan, 0, ',', '.') }}</p>
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
                <!-- Bagian Judul dan Filter -->
                <div class="flex justify-between items-center mb-6">
                    <!-- Judul di Tengah -->
                    <h3 class="text-lg font-semibold text-center flex-grow">Pendapatan per Bulan</h3>
                    <!-- Filter Tahun di Kanan -->
                    <div class="flex items-center ml-4">
                        <label for="yearFilter" class="mr-2 font-semibold">Pilih Tahun:</label>
                        <select id="yearFilter" class="p-2 border rounded">
                            <option value="2025">2025</option>
                            <option value="2024" selected>2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
                <!-- Chart Responsif -->
                <canvas id="statisticsChart" class="w-full" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script Chart.js -->
<script>
    // Data Pendapatan Berdasarkan Tahun
    const statisticsData = {
        2025: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 200000], // Pendapatan hanya untuk Desember 2025
        2024: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 195000], // Pendapatan hanya untuk Desember 2024
        2023: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 180000], // Pendapatan hanya untuk Desember 2023
    };

    // Fungsi untuk Memperbarui Data
    function updateChart(year) {
        // Jika data untuk tahun tidak ada, kosongkan chart
        if (!statisticsData[year]) {
            statisticsChart.data.datasets[0].data = []; // Kosongkan data
            statisticsChart.update();
            return;
        }

        // Update data untuk tahun yang dipilih
        statisticsChart.data.datasets[0].data = statisticsData[year];
        statisticsChart.update();
    }

    // Data Awal untuk Diagram
    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Pendapatan (Rp)',
                data: statisticsData[2024], // Default tahun 2024
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
            },
        ],
    };

    // Konfigurasi Chart
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (Rp)',
                    },
                },
            },
        },
    };

    // Render Chart
    const statisticsChart = new Chart(
        document.getElementById('statisticsChart'),
        config
    );

    // Event Listener untuk Filter Tahun
    document.getElementById('yearFilter').addEventListener('change', (event) => {
        const selectedYear = event.target.value;
        updateChart(selectedYear);
    });
</script>




@endsection
