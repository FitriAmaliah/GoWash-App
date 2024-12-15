@extends('layouts.layout-karyawan')

@section('title', 'Update Status - Karyawan')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex-1 p-6 bg-gray-100 min-h-screen">
    <!-- White Container -->
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Update Status</h1>
        </div>

        <!-- Informational Notice -->
        <div class="flex items-start bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-6 shadow-sm">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
            <div>
                <p class="font-semibold">Pemberitahuan:</p>
                <p>Perbarui status pesanan dengan klik "Proses" saat mengerjakan dan "Selesai" setelah selesai mengerjakan. Pastikan status diperbarui agar proses lancar.</p>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-4">
            <div class="relative w-full max-w-xs">
            <!-- Tabel Data Transaksi -->
              <input 
                    id="search-input" 
                    type="text" 
                    placeholder="Carinama pelanggan..." 
                    class="block w-full pl-10 pr-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150 ease-in-out" 
                    onkeyup="searchTable()"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </span>
            </div>
        </div>   

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-md">
                <thead class="bg-indigo-500 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center text-sm font-semibold">No</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Nama Pelanggan</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Jenis Layanan</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Tanggal Pesan</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Metode Pembayaran</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Status</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @forelse($orders->where('status', '!=', 'Selesai') as $index => $order)
                        <tr class="border-t">
                            <td class="text-center py-4 px-4">{{ $index + 1 }}</td>
                            <td class="text-center py-4 px-4">{{ $order->user->name ?? 'Tidak diketahui' }}</td>
                            <td class="text-center py-4 px-4">{{ $order->layanan->nama_layanan }}</td>
                            <td class="text-center py-4 px-4">{{ $order->tanggal }}</td>
                            <td class="text-center py-4 px-4">{{ $order->metode_pembayaran }}</td>
                            <td class="text-center py-3 px-3">
                                <span class="px-2 py-1 text-sm text-white rounded-full {{ $order->status === 'Selesai' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-center py-4 px-4">
                                <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}" class="inline-block">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        name="status" 
                                        value="Proses" 
                                        class="px-4 py-2 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 {{ $order->status === 'Proses' ? 'cursor-not-allowed opacity-50' : '' }}" 
                                        {{ $order->status === 'Proses' ? 'disabled' : '' }}>
                                        Proses
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('orders.setSelesai', $order->id) }}" class="inline-block">
                                    @csrf
                                    <button 
                                        type="submit" 
                                        class="px-4 py-2 text-sm text-white bg-green-500 rounded hover:bg-green-600 {{ $order->status === 'Selesai' ? 'cursor-not-allowed opacity-50' : '' }}" 
                                        {{ $order->status === 'Selesai' ? 'disabled' : '' }}>
                                        Selesai
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

              <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links('pagination::tailwind') }}
    </div>
</div>
</div>
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
    </div>
</div>


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

@endsection
