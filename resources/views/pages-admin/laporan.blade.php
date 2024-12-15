@extends('layouts.layout-admin')

@section('title', 'Laporan-Admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-6">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-6">

        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Laporan Transaksi</h5>
            </div>
    
            <!-- Filter dan Search -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0 sm:space-x-6">
                
                <!-- Search Bar -->
                <div class="relative w-full sm:max-w-xs">
                    <input 
                        id="search-input" 
                        type="text" 
                        placeholder="Cari nama pelanggan..." 
                        class="block w-full pl-10 pr-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                        onkeyup="searchTable()"
                    />
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </span>
                </div>

                <!-- Filter Tanggal -->
                <div class="flex space-x-4 w-full sm:max-w-sm">
                    <div class="w-full">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Pemesanan</label>
                        <input 
                            type="date" 
                            id="start_date" 
                            name="start_date"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                    </div>
                </div>

                <!-- Button Filter -->
                <button 
                    id="filterButton" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center"
                >
                    Filter Laporan
                </button>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto mb-8">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                    <thead class="bg-indigo-500 text-white">
                        <tr>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID Member Pelanggan</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal Pemesanan</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Total Biaya</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        </tr>
                    </thead>  
                    <tbody class="text-gray-700">
                        @foreach ($orders as $index => $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->user->id_member ?? 'Tidak Ada' }}</td>
                            <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->biaya }}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="bg-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-200 text-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           <!-- Tombol Cetak PDF -->
        <div class="flex justify-end mb-4 mt-8">
            <a href="{{ route('laporan.cetak-pdf') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                <i class="fa-solid fa-file-pdf mr-2"></i>
                Cetak PDF
            </a>
        </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        const startDate = document.getElementById('start_date').value;

        if (!startDate) {
            alert('Silakan pilih tanggal untuk filter.');
            return;
        }

        // Mengirimkan data filter ke backend menggunakan AJAX
        filterLaporan(startDate);
    });

    function filterLaporan(startDate) {
        // Kirim permintaan ke backend untuk mendapatkan data yang difilter
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `/laporan/filter?start_date=${startDate}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Memperbarui tabel dengan data yang difilter
                const data = JSON.parse(xhr.responseText);
                updateTable(data);
            } else {
                alert('Terjadi kesalahan dalam memfilter data.');
            }
        };
        xhr.send();
    }

    function updateTable(data) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = ''; // Hapus data tabel lama

        if (data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center py-3 px-4">Tidak ada data yang ditemukan</td></tr>`;
            return;
        }

        data.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.classList.add('border-b', 'border-gray-200', 'hover:bg-gray-100');
            
            tr.innerHTML = `
                <td class="py-3 px-4 text-center">${index + 1}</td>
                <td class="py-3 px-4 text-center">${row.id_member}</td>
                <td class="py-3 px-4 text-center">${row.nama_pelanggan}</td>
                <td class="py-3 px-4 text-center">${row.jenis_layanan}</td>
                <td class="py-3 px-4 text-center">${row.tanggal_pemesanan}</td>
                <td class="py-3 px-4 text-center">${row.metode_pembayaran}</td>
                <td class="py-3 px-4 text-vcenter">${row.total_biaya}</td>
                <td class="py-3 px-4 text-center">${row.status}</td>
            `;

            tableBody.appendChild(tr);
        });
    }
</script>

@endsection
