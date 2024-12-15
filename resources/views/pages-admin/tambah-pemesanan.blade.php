@extends('layouts.layout-admin')

@section('title', 'Tambah Pemesanan-Admin')

@section('content')

    <!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">

        <div class="mb-4">
        </div>

  <!-- Container utama -->
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Form Tambah Pemesanan</h1>
        </div>

        <!-- Form Tambah Transaksi -->
        <form action="data-transaksi" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Nama Pelanggan -->
            <div>
                <label for="nama-pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" name="nama-pelanggan" id="nama-pelanggan" 
                       class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            
            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pemesanan</label>
                <input type="text" name="tanggal" id="tanggal" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required readonly>
            </div>
           <!-- Jenis Layanan -->
            <div>
                <label for="jenis-layanan" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                <input type="text" name="jenis-layanan" id="jenis-layanan" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            
            <!-- Metode Pembayaran -->
            <div>
                <label for="metode-pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="metode-pembayaran" id="metode-pembayaran" 
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="Cash">Cash</option>
                    <option value="Digital">Digital</option>
                </select>
            </div>

            <!-- Total Biaya -->
            <div>
                <label for="total-biaya" class="block text-sm font-medium text-gray-700">Total Biaya</label>
                <input type="number" name="total-biaya" id="total-biaya" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Pengerjaaan</label>
                <select name="status" id="status" 
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="Belum Selesai">belum selesai</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="col-span-1 md:col-span-2 flex justify-center space-x-4">
                <button type="submit" 
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Tambah</button>
                <a href="data-transaksi" 
                   class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition">Batal</a>
            </div>
        </form>
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

      // Set tanggal otomatis ke tanggal hari ini
      document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
</script>
@endsection
