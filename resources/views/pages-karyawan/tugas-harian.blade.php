@extends('layouts.layout-karyawan')

@section('title', 'Tugas-Harian ')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Tugas Harian Karyawan</h5>
            </div>

            <!-- Search Input -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-karyawan.tugas-harian') }}" method="GET">
                            <input 
                                id="search-input" 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}" 
                                placeholder="Cari nama pelanggan..." 
                                class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                            />
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </span>
                        </form>
                    </div>
                </div>      
            </div>     
            <div class="max-w-4xl mx-auto mt-10">
                <div class="overflow-x-auto">
                    <div class="min-w-full w-64">
                    <table class="w-full bg-white rounded-lg shadow-md">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">No</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Nama Pelanggan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Jenis Layanan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Tanggal Pesan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Metode Pembayaran</th>
                                <th class="w-1/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Status Pengerjaan</th>
                                <th class="w-2/12 text-center py-3 px-4 uppercase bg-indigo-500 font-semibold text-sm text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @forelse($orders as $index => $order)
                                <tr class="border-t">
                                    <td class="text-center py-4 px-4">{{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td class="text-center py-4 px-4">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->layanan->nama_layanan }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->tanggal }}</td>
                                    <td class="text-center py-4 px-4">{{ $order->metode_pembayaran }}</td>
                                    <td class="text-center py-3 px-3">
                                        @if($order->status === 'Selesai')
                                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-green-500 rounded-full">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-500 rounded-full">
                                                Belum Selesai
                                            </span>
                                        @endif
                                        </td>                                                                       
                                    <td class="text-center py-4 px-4">
                                        <button onclick="openModal({{ $order->id }})" class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Lihat Detail</button>
                                    </td>
                                </tr>
                        
               <!-- Modal untuk Detail Pemesanan -->
<div id="detail-modal-{{ $order->id }}" class="etail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg md:w-1/3">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">Detail Pemesanan</h2>
            <button onclick="closeModal({{ $order->id }})" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <div class="mt-4">
            <!-- Menampilkan Nomor Urut -->
            <!-- <p><strong>No:</strong> {{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</p> -->

            <!-- Menampilkan Nama Pelanggan -->
            <p><strong>Nama Pelanggan:</strong> {{ optional($order->user)->name ?? 'Tidak diketahui' }}</p>

            <!-- Menampilkan Jenis Layanan -->
            <p><strong>Jenis Layanan:</strong> {{ $order->layanan->nama_layanan }}</p>

            <!-- Menampilkan Tanggal Pemesanan -->
            <p><strong>Tanggal Pemesanan:</strong> {{ $order->tanggal }}</p>

            <!-- Menampilkan Metode Pembayaran -->
            <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>

            <!-- Menampilkan Status Pemesanan -->
            <p><strong>Status Pemesanan:</strong>
                @if($order->status === 'Selesai')
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-green-500 rounded-full">
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-500 rounded-full">
                        Belum Selesai
                    </span>
                @endif
            </p>
        </div>
        <div class="mt-6 text-right">
            <button onclick="closeModal({{ $order->id }})" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tutup</button>
           </div>
                            </div>
                        </div>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $orders->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
              
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

// Fungsi untuk membuka modal
function openModal(id) {
    // Menyembunyikan semua modal terlebih dahulu
    const modals = document.querySelectorAll('.detail-modal');
    modals.forEach(modal => {
        modal.classList.add('hidden');
    });

    // Menampilkan modal sesuai dengan ID
    const modal = document.getElementById(`detail-modal-${id}`);
    if (modal) {
        modal.classList.remove('hidden');
    }
}

// Fungsi untuk menutup modal
function closeModal(id) {
    const modal = document.getElementById(`detail-modal-${id}`);
    if (modal) {
        modal.classList.add('hidden');
    }
}


    </script>
@endsection
