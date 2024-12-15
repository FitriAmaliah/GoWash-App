@extends('layouts.layout-admin')

@section('title', 'Tambah Karyawan-Admin')

@section('content')

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">

        <div class="mb-4">
        </div>

        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Tambah Karyawan</h5>
            </div>

<!-- Form Tambah Pengguna -->
<div class="max-w-lg mx-auto p-6 bg-white border border-gray-300 rounded-lg shadow-md">
    <form action="{{ route('tambah-karyawan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Pengguna -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Karyawan</label>
            <input type="text" id="name" name="name" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama karyawan" required />
        </div>

        <!-- Email -->
        <div class="mb-4 relative">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="email" name="email" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10" placeholder="Masukkan email karyawan" required />
            <span class="absolute inset-y-0 right-3 flex items-center top-1/2 transform -translate-y-1/2 cursor-pointer" onclick="togglePasswordVisibility()">
                </i>
            </span>
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="password" name="password" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-10" placeholder="Masukkan password" required />
            <span class="absolute inset-y-0 right-3 flex items-center top-1/2 transform -translate-y-1/2 cursor-pointer" onclick="togglePasswordVisibility()">
            </span>
        </div>

        {{-- <div class="mb-6">
            <label for="hakAkses" class="block text-gray-700 font-medium mb-2">Hak Akses</label>
            <input 
                type="text" 
                id="hakAkses" 
                name="hakAkses" 
                value="karyawan" 
                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                readonly 
            />
        </div> --}}
        
            <!-- Tombol Tambah Layanan dan Batal -->
            <div class="flex justify-center space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Pengguna</button>
            <a href="{{ route('manajemen-karyawan') }}"class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</a>
        </div>
    </form>
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
