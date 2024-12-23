@extends('layouts.layout-admin')

@section('title', 'Data Pemesanan-Admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">

        <div class="mb-4">
        </div>

        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Riwayat Pemesanan</h5>
            </div>
    
           
              <!-- Search Input -->
              <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-admin.data-pemesanan') }}" method="GET">
                            <input 
                                id="search-input" 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}" 
                                placeholder="Cari nama pelanggan..." 
                                class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                            />
                            <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p> <!-- Pesan tidak ditemukan -->                    
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </span>
                        </form>
                    </div>
                </div>  
            </div>
                
            <!-- Tabel Data Pemesanan -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                    <thead class="bg-indigo-500 text-white">
                        <tr>
                            <th class="w-1/12 text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                            <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                            <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                            <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal Pesan</th>
                            <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                            <th class="w-1/12 text-center py-3 px-4 uppercase font-semibold text-sm">Status Pengerjaan</th>
                            <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-center">
                        @forelse ($orders as $index => $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td> <!-- Nomor urut berlanjut -->
                            <td class="py-3 px-4">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                            <td class="py-3 px-4">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                            <td class="py-3 px-4">{{ $order->tanggal }}</td>
                            <td class="py-3 px-4">{{ $order->metode_pembayaran }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-200 rounded-full 
                                bg-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-200 
                                text-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-800">
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                        </tr>
                    @endforelse
                    </tbody>              
                </table>
                   
        <!-- Link Pagination -->
        <div class="mt-4">
            {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>  

<!-- Modal untuk Detail Pesanan -->
@foreach ($orders as $order)
    <div id="detail-modal-{{ $order->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h3 class="text-lg font-semibold mb-4">Detail Pesanan</h3>
            <p><strong>Nama Pelanggan:</strong> {{ optional($order->user)->name ?? 'Tidak diketahui' }}</p>
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
@endforeach

<script>

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
