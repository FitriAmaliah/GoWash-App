@extends('layouts.layout-karyawan')

@section('title', 'Profile-Karyawan')

@section('content')

<!-- Content Area -->
<div class="flex-1 p-5 flex justify-center">
    <!-- White Container with Gradient Border -->
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg border border-transparent bg-gradient-to-br from-blue-100 to-indigo-100">
        
        <!-- Profile Header -->
        <div class="text-center">
            <!-- Profile Image -->
            <img 
                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}" 
                alt="Foto Profil" 
                class="w-28 h-28 mx-auto rounded-full border-4 border-indigo-400 shadow-lg cursor-pointer"
                onclick="openModal('{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}')">
            <h2 class="text-3xl font-bold text-gray-800 mt-4">{{ Auth::user()->name }}</h2>
            <p class="text-gray-600">{{ Auth::user()->email }}</p>
        </div>
        
        <!-- Profile Details -->
        <div class="mt-6 space-y-4">
            @foreach ([
                'Nama Admin' => Auth::user()->name, 
                'Email' => Auth::user()->email, 
                'Nomor Telepon' => Auth::user()->phone ?? 'Belum Ditambahkan', 
                'Alamat' => Auth::user()->address ?? 'Belum Ditambahkan', 
                'Tanggal Bergabung' => Auth::user()->created_at->format('d M Y')
            ] as $title => $value)  
                <div class="flex items-center bg-gradient-to-r from-indigo-50 to-blue-50 p-4 rounded-lg shadow-md">
                    <div class="flex-shrink-0 bg-indigo-500 text-white p-2 rounded-lg">
                        <i class="fas fa-info-circle"></i> <!-- Update icon accordingly -->
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-700">{{ $title }}</h4>
                        <p class="text-gray-600">{{ $value }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-20">
            <div class="relative">
                <img id="modalImage" src="" alt="Foto Profil" class="max-w-[20rem] max-h-[20rem] rounded-lg shadow-lg">
                <button 
                    class="absolute top-2 right-2 bg-white text-black rounded-full p-2 shadow hover:bg-gray-200"
                    onclick="closeModal()"
                >
                    &times;
                </button>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <div class="text-center mt-8">
            <a href="{{ route('edit.profil') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-600 transition duration-300">
                Edit Profil
            </a>
        </div>
    </div>
</div>

<script>
    function openModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl; // Set image URL
        document.getElementById('imageModal').classList.remove('hidden'); // Show modal
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden'); // Hide modal
    }
</script>
       
  @endsection