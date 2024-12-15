@extends('layouts.layout-user')

@section('title', 'Ulasan-User')

@section('content')

<div class="bg-indigo-100 py-8">
    <div class="container mx-auto p-4">
        <h2 class="text-center text-2xl font-extrabold text-indigo-600 mb-6">Berikan Ulasan Anda!</h2>
        <div class="flex justify-end mb-4">
            <a href="{{ route('tulis.ulasan') }}" class="bg-indigo-600 text-white py-2 px-6 rounded-full hover:bg-indigo-700 transition duration-300 transform hover:scale-105 inline-block">
                Tambah Ulasan
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($ulasan as $item) <!-- Gunakan item dalam loop -->
            <div id="ulasan-{{ $item->id }}" class="bg-white shadow-xl rounded-2xl p-4 hover:shadow-2xl hover:scale-105 transition duration-300 ease-in-out transform hover:bg-indigo-50 relative">
                    <div class="flex items-center mb-4">
                        <img 
                        src="{{ $item->profile_picture ? asset('storage/' . $item->profile_picture) :'/assets/profile.png' }}" 
                        alt="Foto Profil" 
                        class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h3 class="font-semibold text-xl text-gray-800">{{ $item->nama_pengguna }}</h3>
                            <span class="text-gray-500 text-sm">Tanggal: {{ $item->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-lg {{ $i <= $item->rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                        @endfor
                    </div>
                    <p class="text-gray-700 text-md mb-6">{{ $item->komentar }}</p>
                    
                    <!-- Tombol Edit dan Hapus -->
                    <div class="absolute top-4 right-4 flex space-x-2">
                        <button 
                            onclick="editUlasan({{ $item->id }})"
                            class="text-blue-500 hover:text-blue-700 text-sm">
                            Edit
                        </button>
                        <form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-2">Belum ada ulasan.</p>
            @endforelse
        </div>
    </div>
</div>


      <div class="flex justify-center mt-6">
    <div class="pagination">
        {{ $ulasan->links('pagination::tailwind') }} <!-- Gunakan pagination::tailwind jika menggunakan Tailwind CSS -->
    </div>
</div>

<!-- Modal Edit Ulasan -->
<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Ulasan</h2>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
            </div>
            <div class="mb-4">
                <label for="komentar" class="block text-sm font-medium text-gray-700">Komentar</label>
                <textarea id="komentar" name="komentar" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeEditModal()" class="py-2 px-4 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">Batal</button>
                <button type="submit" class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Simpan</button>
            </div>
        </form>
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

function editUlasan(id) {
    // Logika untuk membuka modal edit ulasan atau navigasi ke halaman edit
    alert('Fitur edit ulasan dengan ID ' + id + ' sedang dikembangkan.');
}

function editUlasan(id) {
        // Ambil data ulasan dari elemen atau server (opsional jika sudah ada data di frontend)
        const ulasan = document.querySelector(`#ulasan-${id}`);
        const komentar = ulasan.querySelector('.komentar').textContent.trim();
        const rating = ulasan.querySelector('.rating').dataset.rating;

        // Isi form di modal dengan data ulasan
        document.querySelector('#editForm').action = `/ulasan/${id}`;
        document.querySelector('#rating').value = rating;
        document.querySelector('#komentar').value = komentar;

        // Tampilkan modal
        document.querySelector('#editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.querySelector('#editModal').classList.add('hidden');
    }

        </script>
@endsection




