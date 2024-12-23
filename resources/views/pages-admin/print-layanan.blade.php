@extends('layouts.layout-admin')

@section('title', 'Print Layanan-Admin')

@section('content')
<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700 mb-4">Cetak Struk Pembelian</h5>
            </div>

            <!-- Struk Pembelian -->
            <div id="receipt" class="bg-white p-6 rounded-lg shadow-lg w-80 mx-auto mb-6">
                <div class="text-center font-bold text-lg mb-2">Struk Layanan Cuci Kendaraan</div>
                <div class="text-center text-gray-700">Tanggal: {{ now()->format('d M Y') }}</div>
                <div class="text-center text-gray-700">Waktu: {{ now()->format('H:i:s') }}</div>
                <div class="text-center text-gray-700">GoWash</div>
        
                <!-- Informasi Transaksi -->
                    <div class="mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama Pelanggan:</span>
                            <span class="font-semibold">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran:</span>
                            <span class="font-semibold">{{ $order->metode_pembayaran }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Biaya:</span>
                            <span class="font-semibold">Rp {{ number_format($order->biaya, 3, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-semibold">{{ $order->status_pembayaran }}</span>
                        </div>
                    </div>

                    <!-- Layanan -->
                    <div class="mb-4">
                        <div class="flex justify-between font-semibold">
                            <span>Layanan</span>
                            <span>Harga</span>
                        </div>
                        <!-- Tampilkan hanya satu layanan untuk contoh -->
                        <div class="flex justify-between mt-2">
                            <span>{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</span>
                            <span>Rp {{ number_format($order->biaya, 3, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="border-t pt-2">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>Rp {{ number_format($order->biaya, 3, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-center text-sm text-gray-600 mt-4">Terima Kasih atas Kunjungan Anda!</div>
                    </div>
            </div>
        
             <!-- Tombol Cetak -->
             <div class="text-center">
                <a href="{{ route('print-receipt', ['id' => $order->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    <i class="fa-solid fa-print"></i>
                    Cetak Struk
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
