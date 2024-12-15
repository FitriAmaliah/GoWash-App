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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Data Pelanggan</h5>
            </div>
    
            <!-- Tabel Data Transaksi -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
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
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status Pemesanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($orders as $index => $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user->id_member }}
                        <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="bg-{{ $order->status_pembayaran == 'Selesai' ? 'green' : 'yellow' }}-200 text-{{ $order->status_pembayaran == 'Selesai' ? 'green' : 'yellow' }}-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $order->status_pembayaran }}
                            </span>   
                            <td class="text-center py-3 px-3">
                                <span class="status-label {{ $order->status === 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }} 
                                    text-white font-medium px-1 py-0.5 text-xs rounded-full shadow-md inline-block">
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

                            <!-- Delete Button -->
                             <!--<button title="Hapus" class="bg-red-500 text-white p-2 rounded hover:bg-red-600 flex items-center" onclick="deleteData(this)" data-id="1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-4 h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Pagination -->
             <div class="mt-4">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

@endsection
