<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #receipt {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 320px;
            margin: 0 auto 1.5rem auto;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-gray-700 {
            color: #4a4a4a;
        }

        .text-gray-600 {
            color: #757575;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .border-t {
            border-top: 1px solid #e2e8f0;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .w-80 {
            width: 320px;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-gray-600 {
            color: #4a4a4a;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .text-gray-600 {
            color: #757575;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Struk Pembelian -->
    <div id="receipt">
        <div class="text-center font-bold text-lg mb-2">Struk Layanan Cuci Kendaraan</div>
        <div class="text-center text-gray-700">Tanggal: {{ now()->format('d M Y H:i:s') }}</div>
        <div class="text-center text-gray-700">Waktu: <span id="current-time"></span></div>
        <div class="text-center text-gray-700">GoWash</div>

        <!-- Informasi Transaksi -->
        @if($orders->count() > 0)
            @php
                $order = $orders->first();  // Get the first order
            @endphp
            <div class="mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">No:</span>
                    <span class="font-semibold">1</span>
                </div>
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
                    <span class="font-semibold">{{ $order->biaya }}</span>
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
                    <span>{{ $order->layanan->first()->nama_layanan ?? 'Tidak Ada' }}</span>
                    <span>Rp {{ $order->biaya }}</span>
                </div>
            </div>

            <!-- Total Pembayaran -->
            <div class="border-t pt-2">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>Rp{{ $order->biaya }}</span>
                </div>
                <div class="text-center text-sm text-gray-600 mt-4">Terima Kasih atas Kunjungan Anda!</div>
            </div>
        @else
            <div class="text-center text-gray-700">
                Tidak ada data transaksi yang tersedia.
            </div>
        @endif
    </div>
</body>
</html>
