@extends('layouts.layout-admin')

@section('title', 'Data Layanan-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Data Layanan</h5>
            </div>

            <!-- Search Input -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-admin.data-layanan') }}" method="GET">
                            <input 
                                id="search-input" 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}" 
                                placeholder="Cari nama layanan..." 
                                class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                            />
                            <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p>                    
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </span>
                        </form>
                    </div>
                </div>         
                <a href="tambah-layanan" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Layanan
                </a>    
            </div>

       <!-- Table -->
       <div class="overflow-x-auto">
           <table id="services-table" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
               <thead>
                   <tr>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           No
                       </th>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           Nama Layanan
                       </th>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           Deskripsi
                       </th>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           Foto
                       </th>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           Harga
                       </th>
                       <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                           Aksi
                       </th>
                   </tr>
               </thead>
               <tbody class="divide-y divide-gray-200">
                   <!-- Baris Layanan -->
                   @forelse($layanans as $key => $layanan)
                   <tr class="hover:bg-gray-100">
                       <td class="px-6 py-4 text-sm text-gray-900 text-center">
                           {{ $layanans->firstItem() + $loop->index }}
                       </td>
                       <td class="px-6 py-4 text-sm text-gray-600">{{ $layanan->nama_layanan }}</td>
                       <td class="px-6 py-4 text-sm text-gray-600">{{ $layanan->deskripsi }}</td>
                       <td class="px-6 py-4 text-sm text-gray-900">
                           @if ($layanan->foto)
                               <img src="{{ asset('storage/' . $layanan->foto) }}" 
                                    alt="{{ $layanan->nama_layanan }}" 
                                    class="w-20 h-auto object-cover">
                           @else
                               <p>Foto tidak tersedia</p>
                           @endif
                       </td>
                       <td class="px-6 py-4 text-sm text-gray-900">{{ 'Rp ' . number_format($layanan->harga, 3, ',', '.') }}</td>
                       <td class="px-6 py-4 text-sm">
                           <div class="flex justify-center space-x-2">
                               <!-- Tombol Edit -->
                               <a href="{{ route('edit.layanan', $layanan->id) }}">
                                   <button
                                       title="Edit" 
                                       class="bg-yellow-500 text-white p-2 rounded hover:bg-yellow-600 flex items-center"
                                   >
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                       </svg>
                                   </button>
                               </a>
                               <!-- Tombol Hapus -->
                               <form action="{{ route('layanan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                   @csrf
                                   @method('DELETE')
                                   <button 
                                       title="Hapus" 
                                       class="bg-red-500 text-white p-2 rounded hover:bg-red-600 flex items-center"
                                   >
                                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-4 h-4 text-white">
                                           <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                       </svg>
                                   </button>
                               </form>
                           </div>
                       </td> 
                   </tr>
                   @empty
                       <tr>
                           <td colspan="6" class="text-center py-4 px-4 text-gray-500">Tidak ada data pemesanan.</td>
                       </tr>
                   @endforelse
               </tbody>
           </table>

           <!-- Link Pagination -->
           <div class="mt-4">
               {{ $layanans->appends(['search' => request('search')])->links('pagination::tailwind') }}
           </div>   
       </div>
@endsection
