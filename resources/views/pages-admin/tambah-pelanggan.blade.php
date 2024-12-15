@extends('layouts.layout-admin')

@section('title', 'Tambah Pelanggan-Admin')

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
                <h5 class="text-lg font-semibold text-gray-700 text-bold mb-4">Tambah Pelanggan</h5>
            </div>

            <div class="max-w-3xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-center text-black">Tambah Data Pelanggan</h2>
                
                <form action="submit-pelanggan" method="POST" class="space-y-4">
                    <!-- ID Pelanggan -->
                    <div>
                        <label for="id_pelanggan" class="block text-sm font-medium text-gray-700">ID Pelanggan</label>
                        <input 
                            id="id_pelanggan" 
                            type="text" 
                            name="id_pelanggan" 
                            required
                            placeholder="Masukkan ID pelanggan (contoh: CUST001)"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>

                    <!-- NISN -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                        <input 
                            id="nisn" 
                            type="text" 
                            name="nisn" 
                            required
                            placeholder="Masukkan NISN pelanggan"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>

                    <!-- Nama Pelanggan -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                        <input 
                            id="nama" 
                            type="text" 
                            name="nama" 
                            required
                            placeholder="Masukkan nama pelanggan"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
            
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            required
                            placeholder="Masukkan email pelanggan"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
            
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input 
                            id="telepon" 
                            type="tel" 
                            name="telepon" 
                            required
                            placeholder="Masukkan nomor telepon pelanggan"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
            
                    <!-- Jumlah Transaksi -->
                    <div>
                        <label for="transaksi" class="block text-sm font-medium text-gray-700">Jumlah Transaksi</label>
                        <input 
                            id="transaksi" 
                            type="number" 
                            name="transaksi" 
                            required
                            placeholder="Masukkan jumlah transaksi"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
            
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select 
                            id="status" 
                            name="status" 
                            required
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="aktif">Aktif</option>
                            <option value="non-aktif">Non-Aktif</option>
                        </select>
                    </div>
            
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50"
                        >
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection