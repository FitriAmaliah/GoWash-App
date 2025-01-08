@extends('layouts.layout-admin')

@section('title', 'Data Transaksi-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Riwayat Transaksi</h5>
            </div>
<!-- Add Service Button and Search (Mobile Only) -->
<div class="p-4">
    <div class="flex flex-col sm:flex-row sm:space-x-4 sm:space-y-0">
        <!-- Search Bar (on Mobile and Desktop) -->
        <div class="relative w-full sm:max-w-xs mb-4 sm:mb-0">
            <form action="{{ route('pages-admin.data-transaksi') }}" method="GET">
                <input 
                    id="search-input" 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Cari nama pelanggan..." 
                    class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                />
                <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p>                    
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </span>
            </form>
        </div>

        <!-- Add Service Button (Aligned to the Right on Desktop) -->
        <a href="tambah-transaksi" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center justify-center w-full sm:w-auto sm:ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Transaksi
        </a>    
    </div>
</div>

        <!-- Data Table -->
        <div class="overflow-x-auto">
            <div class="min-w-full w-64">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Total Biaya</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($orders as $index => $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <!-- Adjusting the numbering to remain sequential across pages -->
                        <td class="py-3 px-4 text-center">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                        <td class="py-3 px-4 text-center">Rp {{ number_format($order->biaya, 3, ',', '.') }}</td>
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
                        <td class="py-3 px-4 text-center flex justify-center space-x-2">
                            <!-- Print Button -->
                            <a href="{{ route('detail.order', $order->id) }}" title="Cetak" class="inline-block">
                                <button class="bg-green-500 text-white p-2 rounded hover:bg-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                    </svg>
                                </button>
                            </a>
                        </td>                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                    </tr>
                    @endforelse    
                </tbody>
            </table>
        </div>
    </div>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div> 

@endsection
