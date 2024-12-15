@extends('layouts.layout-admin')

@section('title', 'Edit Transaksi-Admin')

@section('content')

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
                <h5 class="text-2xl font-semibold text-gray-700">Edit Data Transaksi</h5>
                <p class="text-sm text-gray-500 mt-1">Silahkan edit data transaksi pada form ini</p>
            </div>
        </div>

    <!-- Edit Data Form -->
    <div class="flex flex-col items-center justify-center mt-10">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">

    <!-- Form Edit Transaksi -->
<div class="container mx-auto px-4 py-6">

    <!-- Form Edit Transaksi -->
    <form action="data-transaksi" method="POST">
        <!-- ID Transaksi (Tidak dapat diubah) -->
        <div class="mb-4">
            <label for="transactionID" class="block text-gray-700 font-medium mb-2">ID Transaksi</label>
            <input type="text" id="transactionID" name="transactionID" value="TXN001" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" disabled>
        </div>

        <!-- Tanggal Transaksi -->
        <div class="mb-4">
            <label for="transactionDate" class="block text-gray-700 font-medium mb-2">Tanggal</label>
            <input type="date" id="transactionDate" name="transactionDate" value="2024-10-28" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Nama Pelanggan -->
        <div class="mb-4">
            <label for="customerName" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
            <input type="text" id="customerName" name="customerName" value="John Doe" placeholder="Masukkan nama pelanggan" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Jenis Kendaraan -->
        <div class="mb-4">
            <label for="vehicleType" class="block text-gray-700 font-medium mb-2">Jenis Kendaraan</label>
            <select id="vehicleType" name="vehicleType" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                <option value="Motor" selected>Motor</option>
                <option value="Mobil">Mobil</option>
            </select>
        </div>

       <!-- Metode Pembayaran -->
<div class="mb-4">
    <label for="metodePembayaran" class="block text-gray-700 font-medium mb-2">Metode Pembayaran</label>

    <!-- Menampilkan metode pembayaran yang hanya satu, misalnya "Transfer Bank" -->
    <input type="text" id="metodePembayaran" name="metodePembayaran" value="Transfer Bank" placeholder="Metode Pembayaran: Transfer Bank" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" readonly required>
</div>


        <!-- Biaya -->
        <div class="mb-4">
            <label for="cost" class="block text-gray-700 font-medium mb-2">Biaya</label>
            <input type="number" id="cost" name="cost" value="150000" placeholder="Masukkan biaya transaksi" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end">
            <button type="button" onclick="cancelEdit()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mr-2">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Simpan Perubahan</button>
        </div>
    </form>

<script>
    function cancelEdit() {
        alert("Edit layanan dibatalkan.");
        window.location.href = "data-transaksi"; // Sesuaikan dengan halaman tujuan
    }
</script>

@endsection

