<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <style>
        /* Set margin dan padding untuk mencetak */
        @page {
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Menjamin konten berada di tengah vertikal */
            flex-direction: column;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .table-container {
            width: 90%; /* Lebar 90% dari halaman */
            max-width: 1000px; /* Maksimal lebar tabel */
            margin: 0 auto;
            border-top: 2px solid #4f46e5;
            padding-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #4f46e5;
            color: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            font-size: 12px;
        }

        th {
            text-transform: uppercase;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .status-label {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
        }

        .bg-green-500 {
            background-color: #22c55e;
        }

        .bg-yellow-500 {
            background-color: #facc15;
        }

        .text-gray-700 {
            color: #374151;
        }

        .border-b {
            border-bottom: 1px solid #e5e7eb;
        }

    </style>
</head>
<body>

    <!-- Keterangan Laporan -->
    <h1>Laporan Transaksi</h1>
    <p>Berikut adalah laporan transaksi pelanggan yang mencakup informasi tentang ID member, jenis layanan, dan status pembayaran.</p>

    <!-- Tabel Laporan -->
           <!-- Data Table -->
           <div class="overflow-x-auto mb-10">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID Member Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal Pemesanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Total Biaya</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Status</th>
                    </tr>
                </thead>  
                <tbody class="text-gray-700">
                    @foreach ($orders as $index => $order)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->user->id_member ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                        <td class="py-3 px-4 text-center">{{ $order->biaya }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="bg-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-200 text-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

</body>
</html>
