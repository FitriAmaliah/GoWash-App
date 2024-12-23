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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($ulasan as $item)
            <div id="ulasan-{{ $item->id }}" class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition duration-300 ease-in-out transform hover:bg-gray-50">
                <div class="flex items-center mb-3">
                    <img 
                        src="{{ $item->profile_picture ? asset('storage/' . $item->profile_picture) :'/assets/profile.png' }}" 
                        alt="Foto Profil" 
                        class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h3 class="font-semibold text-base text-gray-800">{{ $item->nama_pengguna }}</h3>
                        <span class="text-gray-500 text-xs">{{ $item->created_at->format('d F Y') }}</span>
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="text-lg {{ $i <= $item->rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm mb-4">{{ $item->komentar }}</p>
                <div class="flex justify-end space-x-4 text-sm">
                    <!--<form <button onclick="editUlasan({{ $item->id }})" class="text-blue-500 hover:text-blue-700">Edit</button> -->
                    <!--<form action="{{ route('ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>-->
                    </form>
                </div>
            </div>
            @empty
                <p class="text-center text-gray-500 col-span-2">Belum ada ulasan.</p>
            @endforelse
        </div>
    </div>
          
    <div class="pagination">
        {{ $ulasan->links('pagination::tailwind') }} <!-- Gunakan pagination::tailwind jika menggunakan Tailwind CSS -->
    </div>
</div>

<!-- Modal Edit Ulasan -->
<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Ulasan</h2>
        <form id="editForm" action="{{ route('ulasan.update', ['id' => $item->id]) }}" method="POST">
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
    // Function to open edit modal with the review data
    function editUlasan(id) {
        // Get the review data (rating and comment)
        const ulasan = document.querySelector(`#ulasan-${id}`);
        const komentar = ulasan.querySelector('p').textContent.trim(); // Comment text
        const rating = ulasan.querySelectorAll('.text-yellow-500').length; // Rating based on yellow stars

        // Populate the modal fields
        document.querySelector('#editForm').action = `/ulasan/${id}`; // Set form action to the correct URL for PUT request
        document.querySelector('#rating').value = rating; // Set rating value
        document.querySelector('#komentar').value = komentar; // Set comment value

        // Show the modal
        document.querySelector('#editModal').classList.remove('hidden');
    }

    // Function to close the modal
    function closeEditModal() {
        document.querySelector('#editModal').classList.add('hidden');
    }
</script>

@endsection
