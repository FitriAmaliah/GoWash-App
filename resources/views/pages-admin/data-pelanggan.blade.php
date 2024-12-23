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
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID Member</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Total Pemesanan</th> <!-- Changed this column name -->
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status Pemesanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($orders as $index => $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4 text-center">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user->id_member }}</td>
                        <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user ? $order->user->orders->count() : 0 }}</td>
                        <!-- Display total number of orders for each customer -->
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-200 rounded-full 
                            bg-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-200 
                            text-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-800">
                            {{ $order->status }}
                        </span>    
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center">
                                <button 
                                    onclick="openModal({{ $order->id }})" 
                                    class="inline-flex items-center px-4 py-2 text-xs font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition-all w-32">
                                    <i class="fa-solid fa-eye mr-2"></i>
                                    Lihat Detail
                                </button>
                            </div>
                        </td>                                                    

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-3 px-4 text-gray-700">Tidak ada data yang ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Link Pagination -->
            <div class="mt-4">
                {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div> 

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
@endsection
