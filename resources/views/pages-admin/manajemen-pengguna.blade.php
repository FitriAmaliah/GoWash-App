@extends('layouts.layout-admin')

@section('title', 'Manajemen Pengguna - Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Manajemen Pengguna</h5>
            </div>

            <!-- Search Input -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-admin.manajemen-pengguna') }}" method="GET">
                            <input 
                                id="search-input" 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}" 
                                placeholder="Cari nama pengguna..." 
                                class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                            />
                            <p id="no-data-message" class="text-red-500 text-sm mt-2 hidden">Data tidak ditemukan</p>                    
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </span>
                        </form>
                    </div>
                </div>      
                <a href="{{ route('tambah-pengguna') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Pengguna
                </a>    
            </div>

            <!-- Table -->
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-indigo-500 text-white text-center text-sm font-semibold uppercase">No</th>
                        <th class="px-6 py-3 bg-indigo-500 text-white text-center text-sm font-semibold uppercase">Nama Pengguna</th>
                        <th class="px-6 py-3 bg-indigo-500 text-white text-center text-sm font-semibold uppercase">Hak Akses</th>
                        <th class="px-6 py-3 bg-indigo-500 text-white text-center text-sm font-semibold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        @if ($user->role === 'user') <!-- Hanya tampilkan role user -->
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 text-sm text-gray-900 text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $user->role }}</td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Lihat Detail Button -->
                                    <button 
                                        onclick="openModal({{ $user->id }})" 
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                                        <i class="fa-solid fa-eye mr-1"></i> Lihat
                                    </button>

                                    <!-- Hapus Button -->
                                    <form action="{{ route('hapus.pengguna', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 flex items-center">
                                            <i class="fa-solid fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 px-4 text-gray-500">Tidak ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

           <!-- Link Pagination -->
        <div class="mt-4">
            {{ $users->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>  

<!-- Modal untuk Detail Pengguna -->
@foreach ($users as $user)
<div id="detail-modal-{{ $user->id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Detail Pengguna</h3>
        <p><strong>Nama Pengguna:</strong> {{ $user->name }}</p>
        <p><strong>Hak Akses:</strong> {{ $user->role }}</p>
        <button 
            onclick="closeModal({{ $user->id }})" 
            class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
            Tutup
        </button>
    </div>
</div>
@endforeach

<script>
    function openModal(userId) {
        document.getElementById('detail-modal-' + userId).classList.remove('hidden');
    }

    function closeModal(userId) {
        document.getElementById('detail-modal-' + userId).classList.add('hidden');
    }
</script>

@endsection
