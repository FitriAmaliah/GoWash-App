@extends('layouts.layout-karyawan')

@section('title', 'Detail Pesanan-Karyawan')

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
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Detail Pesanan</h5>
            </div>
            
                    <!-- Card Detail Pesanan -->
                    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                        <div class="grid grid-cols-2 gap-4 text-gray-600">
                            <div>
                                <p><span class="font-semibold">Nama Pelanggan:</span> John Doe</p>
                                <p><span class="font-semibold">Jenis Layanan:</span> Cuci & Wax</p>
                                <p><span class="font-semibold">Jenis Kendaraan:</span> Sedan</p>
                            </div>
                            <div>
                                <p><span class="font-semibold">Waktu yang Diharapkan:</span> 11:00 AM</p>
                                <p><span class="font-semibold">Metode Pembayaran:</span> Transfer Bank</p>
                            </div>
                        </div>
                    </div>
            
                    <!-- Card Riwayat Catatan -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Catatan Pengerjaan</h2>
            
                        <!-- List Catatan -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                <p class="font-semibold text-gray-700">10:00 AM - Mulai Pengerjaan</p>
                                <p>Kondisi kendaraan kotor akibat lumpur.</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                <p class="font-semibold text-gray-700">10:30 AM - Proses Wax</p>
                                <p>Kendaraan dalam kondisi baik, permukaan bersih.</p>
                            </div>
                        </div>
            
                        <!-- Form Tambah Catatan -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Tambah Catatan</h3>
                            <textarea
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Tambahkan catatan baru..."
                            ></textarea>
                            <button
                                class="mt-3 px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600"
                            >
                                Simpan Catatan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
@endsection