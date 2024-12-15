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

<!-- Tabel Manajemen Pengguna -->
<div class="flex justify-between items-center p-4">
    <div class="flex justify-center mb-4">
        <div class="relative w-full max-w-xs">
            <input 
                id="search-input" 
                type="text" 
                placeholder="Cari karyawan..." 
                class="block w-full pl-10 pr-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                onkeyup="searchTable()"
            />
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </span>
        </div>
    </div> 
    <a href="{{ route('tambah-karyawan') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Tambah Karyawan
    </a>    
</div>
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
        @php $counter = 1; @endphp <!-- Inisialisasi counter -->
        @foreach ($users as $user)
            @if ($user->role === 'karyawan')
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-4 text-sm text-gray-900 text-center">{{ $counter }}</td> <!-- Nomor urut menggunakan counter -->
                    <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 text-center">{{ $user->role }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex justify-center space-x-2">
                            <!-- View Details Button -->
                            <button 
                                onclick="openModal({{ $user->id }})" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
                                <i class="fa-solid fa-eye mr-2"></i>Lihat Detail
                            </button>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('hapus.pengguna', ['id' => $user->id]) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus" class="bg-red-500 text-white p-2 rounded hover:bg-red-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td> 
                </tr>
                @php $counter++; @endphp <!-- Tingkatkan nilai counter -->
            @endif
        @endforeach
    </tbody>
    
    

<!-- Modal untuk Detail Pesanan -->
@foreach ($users as $user)
<div id="detail-modal-{{ $user->id }}" class="detail-modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h3 class="text-lg font-semibold mb-4">Detail Pengguna</h3>
        <p><strong>No:</strong> {{ $loop->iteration }}</p>
        <p><strong>Nama Pengguna:</strong>{{ $user->name }}</p>
        <p><strong>Hak Akses:</strong> {{ $user->role }}</p>
        <button 
            onclick="closeModal({{ $user->id }})" 
            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-400 transition">
            Tutup
        </button>
    </div>
</div>
@endforeach

 {{--<div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
</div> --}}

<script>
    // Fungsi untuk membuka modal
    function openModal(userId) {
        const modal = document.getElementById('detail-modal-' + userId);
        modal.classList.remove("hidden"); // Tampilkan modal
    }

    // Fungsi untuk menutup modal
    function closeModal(userId) {
        const modal = document.getElementById('detail-modal-' + userId);
        modal.classList.add("hidden"); // Sembunyikan modal
    }

    // Fungsi untuk pencarian tabel
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
</script>

@endsection
