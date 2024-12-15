@extends('layouts.layout-admin')

@section('title', 'Edit Pemesanan-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700">Edit Data Pemesanan</h5>
                <p class="text-sm text-gray-500 mt-1">Silahkan edit data pemesanan pada form dibawah ini</p>
            </div>
        </div>

<!-- Form Edit Pemesanan -->
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-xl font-semibold text-center mb-4">Edit Pemesanan</h2>
    <form id="edit-order-form" method="POST" action="{{ route('update.pemesanan', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="customer-name" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
            <input 
                type="text" 
                id="customer-name" 
                name="customer-name" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" 
                value="{{ optional($order->user)->name ?? 'Tidak diketahui' }}" 
                required 
            />
        </div>

        {{-- <div class="mb-4">
            <label for="vehicle-type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
            <select 
                id="vehicle-type" 
                name="vehicle-type" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg"
                required
            >
                <option value="Mobil" selected>Mobil</option>
                <option value="Motor">Motor</option>
                <option value="Truck">Truck</option>
            </select>
        </div> --}}

        <div class="mb-4">
            <label for="service-type" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
            <select 
                id="service-type" 
                name="service-type" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg"
                required
            >
                <option value="Cuci & Wax" selected>Cuci & Wax</option>
                <option value="Cuci Biasa">Cuci Biasa</option>
                <option value="Detailing">Detailing</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="order-date" class="block text-sm font-medium text-gray-700">Tanggal Pesan</label>
            <input 
                type="date" 
                id="order-date" 
                name="order-date" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg"
                value="2024-10-25"
                required
            />
        </div>

        <div class="mb-4">
            <label for="payment-method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select 
                id="payment-method" 
                name="payment-method" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg"
                required
            >
                <option value="Cash" selected>Cash</option>
                <option value="Transfer">Transfer</option>
                <option value="Debit">Debit</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="status_pemesanan" class="block text-sm font-medium text-gray-700">Status</label>
            <select 
                id="status_pemesanan" 
                name="status_pemesanan" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg"
                required
            >
                <option value="Selesai" selected>Selesai</option>
                <option value="Proses">Proses</option>
                <option value="Batal">Belum selesai</option>
            </select>
        </div>

        <div class="flex justify-center mt-6">
            <div class="flex justify-end">
                <button type="button" onclick="cancelEdit()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mr-2">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>


<script>
    function cancelEdit() {
        alert("Edit pemesanan dibatalkan.");
        window.location.href = "data-pemesanan"; // Sesuaikan dengan halaman tujuan
    }
</script>

@endsection
