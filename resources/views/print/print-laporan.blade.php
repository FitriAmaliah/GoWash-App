<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <style>
        /* Margin dan pengaturan halaman cetak */
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
            flex-direction: column;
            background-color: #f8f9fa;
        }

        h1, p {
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin: 20px 0;
        }

        p {
            font-size: 14px;
            margin: 10px 0 20px 0;
        }

        .table-container {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 20px;
        }

        thead {
            background-color: #4f46e5;
            color: white;
        }

        th, td {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            word-wrap: break-word;
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

        /* Gaya status */
        .status-label {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
        }

        .bg-green-500 {
            background-color: #22c55e;
            color: white;
        }

        .bg-yellow-500 {
            background-color: #facc15;
            color: #374151;
        }

        /* Menghindari tabel terpotong saat dicetak */
        @media print {
            table, tr, td, th {
                page-break-inside: avoid;
            }
            body {
                background-color: white;
            }
        }

        /* Total Keseluruhan Styling */
        .total-row td {
            font-weight: bold;
            background-color: #f1f1f1;
            color: #333;
        }

        .total-row td:first-child {
            text-align: right;
        }

    </style>
</head>
<body>

    <!-- Keterangan Laporan -->
    <h1>Laporan Transaksi</h1>
    <p>Berikut adalah laporan transaksi pelanggan yang mencakup informasi tentang ID member, jenis layanan, dan status pembayaran.</p>

    <!-- Tabel Laporan -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>ID Member</th>
                    <th>Jenis Layanan</th>
                    <th>Jenis Kendaraan</th>
                    <th>Plat Nomor</th>
                    <th>Tanggal Pesan</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Biaya</th>
                    <th>Status Pengerjaan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBiayaPerHalaman = 0;
                @endphp
                @foreach ($orders as $index => $order)
                @php
                    $totalBiayaPerHalaman += $order->biaya;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                    <td>{{ $order->user->id_member ?? 'Tidak Ada' }}</td>
                    <td>{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                    <td>{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</td>
                    <td>{{ $order->plat_nomor ?? 'Tidak Ada'}}</td>
                    <td>{{ $order->tanggal }}</td>
                    <td>{{ $order->metode_pembayaran }}</td>
                    <td>Rp {{ number_format($order->biaya, 0, ',', '.') }}</td>
                    <td>
                        <span class="status-label {{ $order->status == 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="6">Total :</td>
                    <td>Rp {{ number_format($totalBiayaPerHalaman, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

</body>
</html>
