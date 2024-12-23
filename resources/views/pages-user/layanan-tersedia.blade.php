@extends('layouts.layout-user')

@section('title', 'Layanan Tersedia - User')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Layanan Pencucian Kendaraan</h5>
            </div>

                <!-- Search Input -->
                <div class="flex items-center w-full sm:w-auto">
                    <form action="{{ route('pages-user.layanan-tersedia') }}" method="GET" class="relative w-full max-w-xs">
                        <input 
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

            <!-- Layanan Tersedia -->
            <div class="mt-8">
                <h6 class="text-xl font-semibold text-gray-700 mb-4">Layanan Tersedia</h6>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($layanans as $layanan)
                        <div class="bg-white shadow-xl rounded-lg overflow-hidden hover:shadow-2xl transform hover:scale-105 transition-all duration-300 ease-in-out">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $layanan->foto) }}" 
                                     alt="{{ $layanan->nama_layanan }}" 
                                     class="w-full h-40 object-contain rounded-t-lg">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $layanan->nama_layanan }}</h3>
                                <p class="text-gray-600 mb-4">{{ $layanan->deskripsi }}</p>
                                <p class="font-bold text-lg mb-4">Harga: Rp {{ number_format($layanan->harga, 3, ',', '.') }}</p>
                                <div class="flex space-x-4 justify-center">
                                    <a href="{{ route('form.pemesanan', $layanan->id) }}" 
                                       class="bg-gradient-to-r from-green-400 to-green-600 text-white py-2 px-4 rounded-lg hover:from-green-500 hover:to-green-700 transition-all text-center">
                                        Pesan
                                    </a>
                                    <a href="{{ route('dashboard.user') }}" 
                                       class="bg-gradient-to-r from-red-400 to-red-600 text-white py-2 px-4 rounded-lg hover:from-red-500 hover:to-red-700 transition-all text-center">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

          <!-- Link Pagination -->
            <div class="mt-4">
        {{ $layanans->appends(['search' => request('search')])->links('pagination::tailwind') }}
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
</script>

@endsection
