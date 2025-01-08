@extends('layouts.layout-admin')

@section('title', 'Tambah Transaksi-Admin')

@section('content')

{{-- Import script Midtrans --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">

        <div class="mb-4">
        </div>

  <!-- Container utama -->
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">Form Tambah Transaksi</h1>
        </div>

        <!-- Form Tambah Transaksi -->
        <form action="data-transaksi" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
          <!-- Nama Pelanggan -->
        <div>
            <label for="nama-pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
            <select name="user_id" id="nama-pelanggan" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                <option value="">-- Pilih Nama Pelanggan --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>


            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="text" name="tanggal" id="tanggal" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required readonly>
            </div>
           <!-- Jenis Layanan -->
           <div>
            <label for="nama-layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
            <select name="nama-layanan" id="nama-layanan" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach($layanan as $item)
                    <option value="{{ $item->id }}" {{ old('nama-layanan') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_layanan }} - Rp{{ number_format($item->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>   
         
            <!-- Metode Pembayaran -->
            {{-- <div>
                <label for="metode-pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                <select name="metode-pembayaran" id="metode-pembayaran" 
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
                    <option value="Cash">Cash</option>
                    <option value="Digital">Digital</option>
                </select>
            </div> --}}

            <!-- Total Biaya -->
            {{-- <div>
                <label for="total-biaya" class="block text-sm font-medium text-gray-700">Total Biaya</label>
                <input type="number" name="total-biaya" id="total-biaya" 
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div> --}}

           <!-- Status -->
<div>
    <label for="status" class="block text-sm font-medium text-gray-700">Status Pengerjaan</label>
    <select name="status" id="status" 
            class="mt-2 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
        <option value="Belum Selesai">Belum Selesai</option>
        <option value="Proses">Proses</option>
        <option value="Selesai">Selesai</option>
    </select>
</div>

            <!-- Tombol Simpan dan Batal -->
            <div class="col-span-1 md:col-span-2 flex justify-center space-x-4 items-center ">
                <button type="button" onclick="openModal()"
                        class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">Tambah</button>
                <a href="data-transaksi" 
                   class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 transition">Batal</a>
            </div>
        </form>
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

      // Set tanggal otomatis ke tanggal hari ini
      document.getElementById('tanggal').value = new Date().toISOString().split('T')[0];
      
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
            const layananId = document.getElementById("nama-layanan").value; // Get the selected service ID
            alert(`Anda memilih metode pembayaran: ${method}`);

            fetch("{{ route('tambah.transaksibyadmin') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    layanan_id: layananId,
                    tanggal: "{{ date('Y-m-d') }}",
                    waktu: "{{ date('H:i') }}",
                    metode_pembayaran: method
                })
            })
            .then(response => response.json())
            .then(data => {
                if (method === 'digital' && data.snapToken) {
                    snap.pay(data.snapToken, {
                        onSuccess: function (result) {
                            fetch("{{ route('success.transaksi') }}", {
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

    //script status

      document.getElementById('status').addEventListener('change', function () {
        // Ambil nilai yang dipilih
        let selectedStatus = this.value;

        // Kirim data dengan fetch API (gantilah URL dengan endpoint Anda)
        fetch('/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token untuk keamanan
            },
            body: JSON.stringify({
                status: selectedStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status berhasil diperbarui!');
            } else {
                alert('Gagal memperbarui status!');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection
