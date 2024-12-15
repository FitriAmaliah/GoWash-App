@extends('layouts.layout-admin')

@section('title', 'Pendapatan-Admin')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Pendapatan</h5>
            </div>

             <!-- Total Pendapatan -->
    <div class="bg-green-100 border border-green-300 text-green-700 rounded-lg p-4 mb-6">
        <h2 class="text-2xl font-semibold">Total Pendapatan</h2>
        <p class="text-xl mt-2">Rp 10,500,000.00</p>
    </div>

    <!-- Form Tambah Pendapatan -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Tambah Pendapatan</h3>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-600">Tanggal</label>
                    <input type="date" id="date" class="border border-gray-300 rounded-lg w-full p-2">
                </div>
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-600">Jumlah (Rp)</label>
                    <input type="number" id="amount" class="border border-gray-300 rounded-lg w-full p-2" placeholder="Masukkan jumlah">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-600">Deskripsi</label>
                    <input type="text" id="description" class="border border-gray-300 rounded-lg w-full p-2" placeholder="Masukkan deskripsi">
                </div>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Tambah</button>
        </form>
    </div>

    <!-- Tabel Pendapatan -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Daftar Pendapatan</h3>
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-3 text-left">Tanggal</th>
                    <th class="border border-gray-300 p-3 text-left">Jumlah</th>
                    <th class="border border-gray-300 p-3 text-left">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Dummy -->
                <tr>
                    <td class="border border-gray-300 p-3">2024-12-01</td>
                    <td class="border border-gray-300 p-3">Rp 1,500,000.00</td>
                    <td class="border border-gray-300 p-3">Pencucian Mobil</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="border border-gray-300 p-3">2024-12-02</td>
                    <td class="border border-gray-300 p-3">Rp 500,000.00</td>
                    <td class="border border-gray-300 p-3">Pencucian Motor</td>
                </tr>
                <!-- Tambahkan data lain di sini -->
            </tbody>
        </table>
    </div>
</div>
@endsection