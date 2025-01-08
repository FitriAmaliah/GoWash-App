@extends('layouts.layout-admin')

@section('title', 'Edit Layanan-Admin')

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
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <div>
                <h5 class="text-2xl font-semibold text-gray-700">Edit Data Layanan</h5>
                <p class="text-sm text-gray-500 mt-1">Silahkan edit data layanan pada form dibawah ini</p>
            </div>
        </div>

    <!-- Edit Data Form -->
    <div class="flex flex-col items-center justify-center mt-10">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">

<!-- Form -->
<form action="{{ route('update.layanan', $layanan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Pastikan metode PUT digunakan untuk update -->

    <div class="mb-4">
        <label for="nama_layanan" class="block text-gray-700 font-medium mb-2">Nama Layanan</label>
        <input type="text" id="nama_layanan" name="nama_layanan" value="{{ $layanan->nama_layanan }}" placeholder="Masukkan nama layanan" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
    </div>

    <div class="mb-4">
        <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi Layanan</label>
        <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi layanan" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ $layanan->deskripsi }}</textarea>
    </div>

    <div class="mb-4">
        <label for="harga" class="block text-gray-700 font-medium mb-2">Harga</label>
        <input id="harga" name="harga" value="{{ number_format($layanan->harga, 0, ',', '.') }}" placeholder="Masukkan harga layanan" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
    </div>

    <div class="mb-6">
        <label for="foto" class="block text-gray-700 font-medium mb-2">Foto Layanan</label>
        
        <!-- Tampilkan gambar lama -->
        <div class="mb-4">
            <img id="preview" 
                 src="{{ !empty($layanan->foto) ? asset('storage/' . $layanan->foto) : 'https://via.placeholder.com/150' }}" 
                 alt="Preview Foto Layanan" 
                 class="w-32 h-32 object-cover rounded-md border border-gray-300">
        </div>
    
    <!-- Input file untuk mengganti gambar -->
    <div class="mb-4">
        <label for="foto" class="block text-sm font-medium text-gray-700">Ubah Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*" 
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
               onchange="previewImage(event)">
    </div>

    <div class="flex justify-end">
        <button type="button" onclick="cancelEdit()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mr-2">Batal</button>
        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Simpan Perubahan</button>
    </div>
</form>

    <script>
        function cancelEdit() {
            alert("Edit layanan dibatalkan.");
            window.location.href = "data-layanan"; // Sesuaikan dengan halaman tujuan
        }

    function previewImage(event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
    </script>
    
@endsection
