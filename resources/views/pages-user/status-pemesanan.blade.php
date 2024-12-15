@extends('layouts.layout-user')

@section('title', 'Status Pemesanan-User')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Status Pemesanan</h5>
            </div>

            <!-- Input Pencarian -->
            <div class="relative w-full max-w-xs mb-6">
                <input 
                    id="search-input" 
                    type="text" 
                    placeholder="Cari status pemesanan..." 
                    class="block w-full pl-10 pr-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-300 transition duration-200 ease-in-out hover:border-blue-400"
                    onkeyup="searchTable()"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>       

            <!-- Table -->
            <div class="max-w-4xl mx-auto mt-10">
                <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg shadow-md">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">No</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Jenis Layanan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Tanggal Pesan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Metode Pembayaran</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Status Pemesanan</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Status Pengerjaan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @forelse($orders->where('status', '!=', 'Selesai') as $index => $order)
                                <tr id="order-{{ $order->id }}" class="border-t">
                                    <td class="text-center py-4 px-4">{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->layanan->nama_layanan }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->tanggal }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->metode_pembayaran }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->status_pembayaran }}</td>
                                    <td class="text-center py-3 px-3">
                                        <span class="status-label {{ $order->status === 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }} 
                                            text-white font-medium px-1 py-0.5 text-xs rounded-full shadow-md inline-block">
                                            {{ $order->status }}
                                        </span>                                                                                           
                                    </td>
                                    <td class="text-center py-4 px-4">
                                        <button 
                                            onclick="openModal({{ $order->id }})" 
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                                            <i class="fa-solid fa-eye mr-1"></i>Lihat Detail
                                        </button>                                    
                                    </td>
                                </tr>

                                <!-- Modal untuk Detail Pesanan -->
                                <div id="detail-modal-{{ $order->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
                                    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                                        <h3 class="text-lg font-semibold mb-4">Detail Pesanan</h3>
                                        <p><strong>No:</strong>{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</p>
                                        <p><strong>Jenis Layanan:</strong> {{ $order->layanan->nama_layanan }}</p>
                                        <p><strong>Tanggal Pesan:</strong> {{ $order->tanggal }}</p>
                                        <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
                                        <p><strong>Status Pemesanan:</strong> {{ $order->status }}</p>
                                        <button 
                                            onclick="closeModal({{ $order->id }})" 
                                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function searchTable() {
        const input = document.getElementById("search-input").value.toLowerCase();
        const tableBody = document.getElementById("table-body");
        const rows = tableBody.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? "" : "none";
        }
    }

    function openModal(id) {
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>

@endsection
