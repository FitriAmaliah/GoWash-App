@extends('layouts.layout-karyawan')

@section('title', 'Update Status - Karyawan')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex-1 p-6 bg-gray-100 min-h-screen">
    <!-- White Container -->
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Update Status pengerjaan</h1>
        </div>

       <!-- Informational Notice -->
        <div class="flex items-center bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-6 shadow-sm">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
            <p><span class="font-semibold">Info:</span> Klik "Proses" saat dikerjakan dan "Selesai" setelah selesai. Perbarui status untuk kelancaran proses pemesanan.</p>
        </div>

            <!-- Search Input -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-karyawan.update-status') }}" method="GET">
                            <input 
                                id="search-input" 
                                type="text" 
                                name="search"
                                value="{{ request('search') }}" 
                                placeholder="Cari nama pelanggan..." 
                                class="block w-full pl-10 pr-4 py-3 text-base text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                            />
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                            </span>
                        </form>
                    </div>
                </div>      
            </div>    
        <!-- Table -->
        <div class="overflow-x-auto scrollbar-hide">
            <div class="min-w-full w-64">
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="w-1/12 text-center py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">ID Member</th>
                        <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Layanan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jenis Kendaraan</th>
                        <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Plat Nomor</th>
                        <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Tanggal Pesan</th>
                        <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Metode Pembayaran</th>
                        <th class="w-1/12 text-center py-3 px-4 uppercase font-semibold text-sm">Status Pengerjaan</th>
                        <th class="w-2/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @forelse($orders->where('status', '!=', 'Selesai') as $index => $order)
                        <tr class="border-t">
                            <td class="py-3 px-4">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td> <!-- Nomor urut berlanjut -->
                            <td class="py-3 px-4">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->user->id_member  ?? 'Tidak Ada' }}</td>
                            <td class="py-3 px-4">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</td>
                            <td class="py-3 px-4 text-center">{{ $order->plat_nomor ?? 'Tidak Ada'}}</td>
                            <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                            <td class="py-3 px-4 text-center">{{ $order->metode_pembayaran }}</td>
                            <td class="text-center py-3 px-3">
                                <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-500 rounded-full {{ $order->status === 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-center py-4 px-4">
                                <div class="flex justify-between items-center space-x-4">
                                    <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            name="status" 
                                            value="Proses" 
                                            class="flex-1 px-6 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 {{ $order->status === 'Proses' ? 'cursor-not-allowed opacity-50' : '' }}" 
                                            {{ $order->status === 'Proses' ? 'disabled' : '' }}>
                                            Proses
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('orders.setSelesai', $order->id) }}">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            class="flex-1 px-6 py-2 text-sm text-white bg-green-500 rounded hover:bg-green-600 {{ $order->status === 'Selesai' ? 'cursor-not-allowed opacity-50' : '' }}" 
                                            {{ $order->status === 'Selesai' ? 'disabled' : '' }}>
                                            Selesai
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">Tidak ada data tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

               <!-- Link Pagination -->
        <div class="mt-4">
            {{ $orders->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>

<!-- Popup Notification -->
@if(session('success'))
    <div id="popup-success" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-lg font-bold text-green-500 mb-4">Berhasil!</h3>
            <p>{{ session('success') }}</p>
            <button 
                class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                onclick="document.getElementById('popup-success').style.display='none';">
                Tutup
            </button>
        </div>
    </div>
@endif

<script>
    function searchTable() {
        const input = document.getElementById("search-input").value.toLowerCase();
        const rows = document.querySelectorAll("#table-body tr");
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>

<style>
    /* Utility Class to Hide Scrollbar */
.scrollbar-hide::-webkit-scrollbar {
display: none;
}

.scrollbar-hide {
-ms-overflow-style: none; /* IE and Edge */
scrollbar-width: none; /* Firefox */
}
</style>


@endsection
