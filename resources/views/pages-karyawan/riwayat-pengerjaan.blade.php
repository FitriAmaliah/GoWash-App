@extends('layouts.layout-karyawan')

@section('title', 'Riwayat Pengerjaan')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Riwayat Pengerjaan</h5>
            </div>

            <!-- Search Input -->
            <div class="flex justify-between items-center p-4">
                <div class="flex justify-center mb-4">
                    <div class="relative w-full max-w-xs">
                        <form action="{{ route('pages-karyawan.riwayat-pengerjaan') }}" method="GET">
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

                    <!-- Tabel Data Pemesanan -->
                    <div class="overflow-x-auto scrollbar-hide">
                        <div class="min-w-full w-64  mt-4">
                            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden leading-normal">
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
                                <tbody class="text-gray-700 text-center">
                                    @forelse ($orders as $index => $order)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-4">{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td> <!-- Nomor urut berlanjut -->
                                        <td class="py-3 px-4">{{ optional($order->user)->name ?? 'Tidak diketahui' }}</td>
                                        <td class="py-3 px-4 text-center">{{ $order->user->id_member  ?? 'Tidak Ada' }}</td>
                                        <td class="py-3 px-4">{{ $order->layanan->nama_layanan ?? 'Tidak Ada' }}</td>
                                        <td class="py-3 px-4 text-center">{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</td>
                                        <td class="py-3 px-4 text-center">{{ $order->plat_nomor ?? 'Tidak Ada'}}</td>
                                        <td class="py-3 px-4 text-center">{{ $order->tanggal }}</td>
                                        <td class="py-3 px-4">{{ $order->metode_pembayaran }}</td>
                                        <td class="py-3 px-4">
                                             <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-{{ $order->status == 'Selesai' ? 'green' : 'yellow' }}-500 rounded-full">
                                                {{ $order->status == 'Selesai' ? 'Selesai' : 'Belum selesai' }}
                                            </span>
                                        </span>                                  
                                        </td>
                                        <td class="text-center py-4 px-4">
                                            <button 
                                            onclick="openModal({{ $order->id }})" 
                                            class="inline-flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                                            title="Lihat Detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>                                                                                                               
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="">
                                        <td colspan="10" class="items-center justify-center mx-auto text-center py-4 px-4 text-gray-500">Tidak ada riwayat pemesanan.</td>
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

<!-- Tambahkan Modal Popup di Bawah -->
@foreach ($orders as $order)
<div 
    id="detail-modal-{{ $order->id }}" 
    class="detail-modal fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50"
>
    <div class="bg-white rounded-lg shadow-lg max-w-[90%] sm:max-w-md w-full p-6 sm:p-8">
        <!-- Header Modal -->
        <div class="flex justify-between items-center">
            <h2 class="text-lg sm:text-xl font-semibold">Detail Pemesanan</h2>
            <button 
                onclick="closeModal({{ $order->id }})" 
                class="text-gray-500 hover:text-gray-700 text-2xl"
            >
                &times;
            </button>
        </div>
        <!-- Isi Modal -->
        <div class="mt-4">
            <p><strong>Nama Pelanggan:</strong> {{ optional($order->user)->name ?? 'Tidak diketahui' }}</p>
            <p><strong>ID Member:</strong> {{ $order->user->id_member  ?? 'Tidak Ada' }}</p>
            <p><strong>Jenis Layanan:</strong> {{ $order->layanan->nama_layanan }}</p>
            <p><strong>Jenis Kendaraan:</strong>{{ $order->jenis_kendaraan ?? 'Tidak Ada'}}</p>
            <p><strong>Plat Nomor:</strong> {{ $order->plat_nomor ?? 'Tidak Ada'}}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->tanggal }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
            <p><strong>Status Pembayaran:</strong>{{ $order->status_pembayaran }}</p>
            <p>
                <strong>Status Pengerjaan:</strong>
                @if($order->status === 'Selesai')
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-green-500 rounded-full">
                        Selesai
                    </span>
                @else
                    <span class="inline-flex items-center justify-center px-2 py-0.5 text-[10px] font-medium text-white bg-yellow-500 rounded-full">
                        Belum Selesai
                    </span>
                @endif
            </p>
        </div>
        <!-- Tombol Tutup -->
        <div class="mt-6 text-right">
            <button 
                onclick="closeModal({{ $order->id }})" 
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                Tutup
            </button>
        </div>
    </div>
</div>
@endforeach

<script>
    function searchTable() {
        const input = document.getElementById("search-input").value.toLowerCase();
        const tableBody = document.getElementById("table-body");
        const rows = tableBody.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.getElementsByTagName("td");
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? "" : "none";
        }
    }

    function openModal(id) {
        document.querySelectorAll('.detail-modal').forEach(modal => modal.classList.add('hidden'));
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) modal.classList.remove('hidden');
    }

    function closeModal(id) {
        const modal = document.getElementById(`detail-modal-${id}`);
        if (modal) modal.classList.add('hidden');
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
