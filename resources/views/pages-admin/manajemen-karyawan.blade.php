@extends('layouts.layout-admin') 

@section('title', 'Manajemen Karyawan-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Manajemen Karyawan</h5>
            </div>

<!-- Add Service Button and Search (Mobile Only) -->
<div class="p-4">
    <div class="flex flex-col sm:flex-row sm:space-x-4 sm:space-y-0">
        <!-- Search Bar (on Mobile and Desktop) -->
        <div class="relative w-full sm:max-w-xs mb-4 sm:mb-0">
            <form action="{{ route('pages-admin.manajemen-karyawan') }}" method="GET">
                <input 
                    id="search-input" 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Cari nama karyawan..." 
                    class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                />
                <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p>                    
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </span>
            </form>
        </div>

        <!-- Add Service Button (Aligned to the Right on Desktop) -->
        <a href="{{ route('tambah-karyawan') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center justify-center w-full sm:w-auto sm:ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Karyawan
        </a>    
    </div>
</div>

            <!-- Table -->
            <div class="overflow-x-auto">
            <div class="min-w-full w-64">
            <table class="min-w-full leading-normal border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                            No
                        </th>
                        <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                            Nama Karyawan
                        </th>
                        <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                            Hak Akses
                        </th>
                        <th class="px-6 py-3 border-b-2 bg-indigo-500 text-center text-sm font-semibold text-white uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        @if ($user->role === 'karyawan')
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 text-sm text-gray-900 text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-center">{{ $user->role }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Lihat Detail Button -->
                                        <button 
                                            onclick="openModal({{ $user->id }})" 
                                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                                            <i class="fa-solid fa-eye mr-1"></i> Lihat
                                        </button>

                                        <!-- Hapus Button -->
                                        <form action="{{ route('hapus.pengguna', ['id' => $user->id]) }}" method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center">
                                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td> 
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 px-4 text-gray-500">Tidak ada data karyawan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
            
       <!-- Modal untuk Detail Karyawan -->
@foreach ($users as $user)
<div id="detail-modal-{{ $user->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-3/4 md:w-1/2 lg:w-1/3 max-w-lg mx-4 sm:mx-8 md:mx-16">
        <h3 class="text-lg font-semibold mb-4">Detail Pengguna</h3>
        <p><strong>No:</strong> {{ $loop->iteration }}</p>
        <p><strong>Nama Karyawan:</strong> {{ $user->name }}</p>
        <p><strong>Hak Akses:</strong> {{ $user->role }}</p>
        <button 
            onclick="closeModal({{ $user->id }})" 
            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
            Tutup
        </button>
    </div>
</div>
@endforeach

            <!-- Link Pagination -->
            <div class="mt-4">
                {{ $users->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div> 
        </div>
    </div>
</div>

<script>
    function openModal(userId) {
        const modal = document.getElementById('detail-modal-' + userId);
        modal.classList.remove("hidden");
    }

    function closeModal(userId) {
        const modal = document.getElementById('detail-modal-' + userId);
        modal.classList.add("hidden");
    }
</script>

@endsection
