@extends('layouts.layout-user')

@section('title', 'Form Pemesanan-User')

@section('content')

{{-- Import script Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-2xl font-semibold text-gray-700">Form Tambah Pemesanan</h5>
            </div>

                    <!-- Form Container -->
            <div class="max-w-4xl mx-auto p-6 bg-gray-50 rounded-lg shadow-md">
                <form id="form-pemesanan" method="POST">
                    @csrf
                 <!-- Jenis Layanan -->
                    <div class="flex flex-col space-y-4 mb-6">
                        <label for="service" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                        <input type="text" id="service" name="service" value="{{ $layanan->nama_layanan }}" class="block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" readonly>
                    </div>

                   <!-- ID Member -->
            <div class="flex flex-col space-y-4 mb-6">
                <label for="id_member" class="block text-sm font-medium text-gray-700">ID Member</label>
                <input 
                    type="text" 
                    id="user_id" 
                    name="user_id" 
                    value="{{ $user->id_member  ?? 'Tidak Ada'}}"  
                    class="block w-full border border-gray-300 rounded-md shadow-sm p-3 bg-gray-100 focus:outline-none" 
                    readonly>
            </div>

                <!-- Jenis Kendaraan -->
                <div class="flex flex-col space-y-4 mb-6">
                    <label for="jenis_kendaraan" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
                    <input 
                        type="text" 
                        id="jenis_kendaraan" 
                        name="jenis_kendaraan" 
                        placeholder="Masukkan jenis kendaraan" 
                        class="block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Nomor Plat -->
                <div class="flex flex-col space-y-4 mb-6">
                    <label for="plat_nomor" class="block text-sm font-medium text-gray-700">Nomor Plat</label>
                    <input 
                        type="text" 
                        id="plat_nomor" 
                        name="plat_nomor" 
                        placeholder="Masukkan plat nomor" 
                        class="block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>               
                    
                    <!-- Tanggal -->
                    <div class="flex flex-col space-y-4 mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input 
                            type="date" 
                            id="date" 
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-3 bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                            value="{{ date('Y-m-d') }}" 
                            readonly 
                            required>
                    </div>

                    <!-- Waktu -->
                    <div class="flex flex-col space-y-4 mb-6">
                        <label for="time" class="block text-sm font-medium text-gray-700">Waktu</label>
                        <input 
                            type="time" 
                            id="time" 
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-3 bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                            value="{{ date('H:i') }}" 
                            readonly 
                            required>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-center space-x-4 mb-6">
                        <button type="button" onclick="openModal()" class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-md shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">Pesan Sekarang</button>
                        <button type="button" onclick="window.location.href='{{ route('layanan.tersedia') }}'" class="bg-red-500 text-white font-semibold px-6 py-2 rounded-md shadow-md hover:bg-red-600 focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                            Batal
                        </button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Metode Pembayaran -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Pilih Metode Pembayaran</h2>
        <div class="flex justify-between space-x-4">
            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md" onclick="selectPayment('cash')">
                Cash
            </button>
            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md" onclick="selectPayment('digital')">
                Digital Payment
            </button>
        </div>
        <button onclick="closeModal()" class="mt-4 text-sm text-gray-500 hover:underline">Tutup</button>
    </div>
</div>



<script>

     // Fungsi untuk memperbarui tanggal dan waktu secara otomatis
     function updateDateTime() {
        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');
        
        // Mendapatkan tanggal dan waktu saat ini
        const today = new Date();
        let year = today.getFullYear();
        let month = (today.getMonth() + 1).toString().padStart(2, '0');  // Menambahkan 0 di depan bulan
        let day = today.getDate().toString().padStart(2, '0');  // Menambahkan 0 di depan tanggal
        let hours = today.getHours().toString().padStart(2, '0');  // Menambahkan 0 di depan jam
        let minutes = today.getMinutes().toString().padStart(2, '0');  // Menambahkan 0 di depan menit
        
        // Menetapkan nilai tanggal dan waktu
        dateInput.value = `${year}-${month}-${day}`;
        timeInput.value = `${hours}:${minutes}`;
    }

    // Memperbarui tanggal dan waktu saat halaman pertama kali dimuat
    updateDateTime();
    
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('paymentModal');

        function openModal() {
            modal?.classList.remove('hidden');
        }

        function closeModal() {
            modal?.classList.add('hidden');
        }

        modal?.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        window.openModal = openModal;
        window.closeModal = closeModal;
 
        window.selectPayment = function (method) {
            alert(`Anda memilih metode pembayaran: ${method}`);

            fetch("{{ route('checkout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    layanan_id: "{{ $layanan->id }}",  // Ambil ID dari layanan pertama
                    id_member: "{{ $user->id_member }}",  // ID member user
                    tanggal: "{{ date('Y-m-d') }}",  // Tanggal saat ini
                    waktu: "{{ date('H:i') }}",  // Waktu saat ini
                    metode_pembayaran: method,  // Metode pembayaran (input dari user)
                    plat_nomor: document.getElementById('plat_nomor').value,  // Input plat nomor
                    jenis_kendaraan: document.getElementById('jenis_kendaraan').value  // Input jenis kendaraan
                })
            })
            .then(response => response.json())
            .then(data => {
                if (method === 'digital' && data.snapToken) {
                    snap.pay(data.snapToken, {
                        onSuccess: function (result) {
                            fetch("{{ route('payment.success') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    "order_id": data.pemesanan.id,
                                })
                            }).then(() => {
                                alert('Pembayaran berhasil!');
                                location.reload();
                            })
                        },
                        onPending: function () {
                            alert('Menunggu pembayaran...');
                        },
                        onError: function () {
                            alert('Pembayaran gagal!');
                        }
                    });
                } else if (method === 'cash') {
                    alert(data.message || 'Pemesanan berhasil dengan metode cash.');
                    location.reload();
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error.message);
            });
        };
    });

</script>

@endsection
