@extends('layouts.layout-admin')

@section('title', 'Data Pelanggan-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Data Pelanggan</h5>
            </div>
    
             <!-- Search Input -->
             <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-admin.data-pelanggan') }}" method="GET">
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

        <!-- Data Table -->
        <div class="overflow-x-auto scrollbar-hide">
            <div class="min-w-full w-64">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID Member</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Kendaraan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Plat Nomor</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal Pesan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Total Pemesanan</th> <!-- Changed this column name -->
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($orders as $index => $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4 text-center">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user->id_member  ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</td>
                        <td class="py-3 px-4 text-center">{{ $order->plat_nomor ?? 'Tidak Ada'}}</td>
                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user ? $order->user->orders->count() : 0 }}</td>
                        <!-- Display total number of orders for each customer -->
                        <td class="py-3 px-4 text-center">
                              @if(strtolower(trim($order->status_pembayaran)) == 'success')
                            <span class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $order->status_pembayaran }}
                            </span>
                            @else
                            <span class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $order->status_pembayaran }}
                            </span>
                             @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center">
                                <button 
                                onclick="openModal({{ $order->id }})" 
                                class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                                title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>  
                            </div>
                        </td>                                    
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-3 px-4 text-gray-700">Tidak ada data yang ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
            <!-- Link Pagination -->
            <div class="mt-4">
                {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div> 

         <!-- Modal untuk Detail Pesanan -->
@foreach ($orders as $order)
    <div id="detail-modal-{{ $order->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-3/4 md:w-1/2 lg:w-1/3 max-w-lg mx-4 sm:mx-8 md:mx-16">
            <h3 class="text-lg font-semibold mb-4">Detail Pesanan</h3>
            <p><strong>Nama Pelanggan:</strong>{{ optional($order->user)->name ?? 'Tidak diketahui' }}</p>
            <p><strong>ID Member:</strong> {{ $order->user->id_member  ?? 'Tidak Ada' }}</p>
            <p><strong>Jenis Layanan:</strong> {{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</p>
            <p><strong>Jenis Kendaraan:</strong>  {{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</p>
            <p><strong>Plat Nomor:</strong>  {{ $order->plat_nomor ?? 'Tidak Ada'}}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->tanggal }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
            <p><strong>Total Pemesanan:</strong> {{ $order->user ? $order->user->orders->count() : 0 }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $order->status_pembayaran }}</p>
            <button 
                onclick="closeModal({{ $order->id }})" 
                class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
                Tutup
            </button>
        </div>
    </div>
@endforeach


        </div> <!-- End of overflow-x-auto -->
    </div> <!-- End of bg-white shadow-md rounded-lg p-5 -->
</div> <!-- End of flex-1 p-5 -->

<script>
    function openModal(id) {
        // Ambil modal berdasarkan ID
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) {
            // Tampilkan modal dengan menghapus kelas 'hidden'
            modal.classList.remove('hidden');
        }
    }

    function closeModal(id) {
        // Ambil modal berdasarkan ID
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) {
            // Sembunyikan modal dengan menambahkan kelas 'hidden'
            modal.classList.add('hidden');
        }
    }
</script>


<style>
    /* Utility Class to Hide Scrollbar */
.scrollbar-hide::-webkit-scrollbar {
display: none;
}

.scrollbar-hide {
-ms-overflow-style: none; /* IE and Edge */
scrollbar-width: none; /* Firefox */
}
</style>

@endsection
