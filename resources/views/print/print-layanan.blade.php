<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Layanan Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #receipt {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 360px;
            margin: 2rem auto;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-lg {
            font-size: 1.25rem;
        }

        .text-gray-700 {
            color: #4a4a4a;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .border-t {
            border-top: 1px solid #e5e7eb;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            justify-content: space-between;
        }

        .font-mono {
            font-family: 'Courier New', Courier, monospace;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #e5e7eb;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <!-- Struk Pembelian -->
    <div id="receipt">
        <div class="text-center font-bold text-lg mb-2">Struk Layanan Cuci Kendaraan</div>
        <div class="text-center text-gray-500">GoWash</div>
        <div class="text-center text-gray-700">
            <span id="realTimeClock" data-server-time="{{ now()->format('H:i:s') }}"></span>
                        Waktu: {{ now()->format('H:i:s') }}
                    </span>
                </div>         
        <div class="text-center text-gray-700">GoWash</div>
        <hr>
            <div class="mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-700">Nama Pelanggan:</span>
                    <span class="font-bold">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-700">Metode Pembayaran:</span>
                    <span class="font-bold">{{ $order->metode_pembayaran }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-700">Status:</span>
                    <span class="font-bold">{{ $order->status_pembayaran }}</span>
                </div>
            </div>

            <hr>

            <div class="mb-4">
                <div class="flex justify-between font-bold">
                    <span>Layanan</span>
                    <span>Harga</span>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-gray-700">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</span>
                    <span class="font-mono">Rp {{ number_format($order->biaya, 3, ',', '.') }}
                    </span>
                </div>
            </div>
            <hr>

            <div class="border-t pt-2">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span class="font-mono">Rp {{ number_format($order->biaya, 3, ',', '.') }}
                    </span>
                </div>
                <div class="text-center text-sm text-gray-500 mt-4">Terima Kasih atas Kunjungan Anda!</div>
            </div>
    </div>

     <!-- Script untuk Update Waktu -->
 <script>
    function updateClock() {
    const clockElement = document.getElementById('realTimeClock');
    let serverTime = clockElement.getAttribute('data-server-time') || '00:00:00';
    let [hours, minutes, seconds] = serverTime.split(':').map(Number);

    const now = new Date();
    now.setHours(hours, minutes, seconds);

    // Tambahkan 1 detik setiap pembaruan
    now.setSeconds(now.getSeconds() + 1);

    const hh = String(now.getHours()).padStart(2, '0');
    const mm = String(now.getMinutes()).padStart(2, '0');
    const ss = String(now.getSeconds()).padStart(2, '0');
    const timeString = `${hh}:${mm}:${ss}`;

    clockElement.textContent = 'Waktu: ' + timeString;

    // Simpan waktu terbaru
    serverTime = timeString;
    clockElement.setAttribute('data-server-time', serverTime);
}

// Perbarui waktu setiap detik
setInterval(updateClock, 1000);
updateClock();

</script>
</body>
</html>
