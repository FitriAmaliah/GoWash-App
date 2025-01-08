@extends('layouts.layout-admin')

@section('title', 'Tambah Layanan-Admin')

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
            <h5 class="text-lg font-semibold text-gray-700text-bold mb-4">Tambah Layanan</h5>
            </div>


<!-- Form Pengisian Data Layanan -->
<form id="serviceForm" method="POST" action="{{ route('tambah-layanan') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="nama_layanan" class="block text-sm font-medium text-gray-600">Nama Layanan</label>
        <input type="text" id="nama_layanan" name="nama_layanan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" placeholder="Masukkan nama layanan">
    </div>
    <div class="mb-4">
        <label for="deskripsi" class="block text-sm font-medium text-gray-600">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" placeholder="Masukkan deskripsi layanan"></textarea>
    </div>
    <div class="mb-4">
        <label for="harga" class="block text-sm font-medium text-gray-600">Harga</label>
        <input type="number" id="harga" name="harga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2" placeholder="Masukkan harga layanan">
    </div>
    <div class="mb-4">
        <label for="foto" class="block text-sm font-medium text-gray-600">Foto Layanan</label>
        <input type="file" id="foto" name="foto" accept="image/*" required class="mt-1 block w-full text-gray-600 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
    </div>
    <div class="flex justify-end space-x-4">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Layanan</button>
        <a href="{{ route('data-layanan') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Batal</a>
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
    

