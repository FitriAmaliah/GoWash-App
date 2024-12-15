@extends('layouts.layout-admin')

@section('title', 'Edit Profile-Admin')

@section('content')

<!-- Main Content -->
<main class="flex-1 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg p-5 w-full max-w-md border border-transparent bg-gradient-to-br from-blue-100 to-indigo-100">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit Profil Anda</h2>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Foto Profil -->
            <div class="mb-4">
                <label for="profile-picture" class="block text-gray-600 font-medium">Foto Profil</label>
                <div class="mt-2 flex items-center">
                    <img 
                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}" 
                    alt="Foto Profil" 
                    class="w-10 h-10 rounded-full mr-3">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="name" class="block text-gray-600 font-medium">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-600 font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-600 font-medium">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="address" class="block text-gray-600 font-medium">Alamat</label>
                <textarea id="address" name="address" rows="4" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ Auth::user()->address }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-600 font-medium">Status</label>
                <select id="status" name="is_active" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1" {{ Auth::user()->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !Auth::user()->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <!-- Tanggal Bergabung (Readonly) -->
            <div class="mb-4">
                <label class="block text-gray-600 font-medium">Tanggal Bergabung</label>
                <p class="w-full p-3 border border-gray-300 rounded bg-gray-100">{{ Auth::user()->created_at->format('d M Y') }}</p>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-500 text-white px-6 py-2 rounded-lg focus:outline-none hover:bg-indigo-600">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profile-pic');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
