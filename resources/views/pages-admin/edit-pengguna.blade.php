@extends('layouts.layout-admin')

@section('title', 'Edit Pengguna-Admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

      <!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->
    <div class="bg-white shadow-md rounded-lg p-5">

        <div class="mb-4">
        </div>

        <div class="container mx-auto">
          <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <div>
                <h5 class="text-2xl font-semibold text-gray-700">Edit Data Pengguna</h5>
                <p class="text-sm text-gray-500 mt-1">Silahkan edit data pengguna pada form ini</p>
            </div>
        </div>

<!-- Form Edit Pengguna -->
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-10">
    <h2 class="text-xl font-semibold text-center mb-4">Edit Pengguna</h2>
    <form action="{{ route('edit.pengguna', ['id' => $user->id]) }}" method="POST" id="edit-user-form">
        @csrf
        @method('PUT')

        <!-- Username Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" 
                value="{{ old('name', $user->name) }}" 
                required 
            />
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
                type="text" 
                id="email" 
                name="email" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" 
                value="{{ old('email', $user->email) }}" 
                required 
            />
        </div>

        <!-- Password Field -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg pr-10" 
                value="{{ old('password') }}" 
            />
            <!-- Icon Mata untuk Menampilkan/Sembunyikan Password -->
            <span 
                class="absolute inset-y-0 right-0 flex items-center justify-center top-1/2 transform -translate-y-1/2 pr-3 cursor-pointer"
                onclick="togglePasswordVisibility()"
            >
                <i id="eye-icon" class="fa fa-eye"></i>
            </span>
        </div>

        <!-- Role Field -->
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Hak Akses</label>
            <select 
                id="role" 
                name="role" 
                class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg" 
                required
            >
                <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Admin" {{ $user->role == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
        </div>

        <div class="flex justify-center mt-6">
            <button type="button" onclick="cancelEdit()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mr-2">Batal</button>
            <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Simpan Perubahan</button>
        </div>
    </form>
</div>

    <script>
        function cancelEdit() {
            // Logic untuk batal edit
            alert('Edit dibatalkan');
        }

   // Fungsi untuk menampilkan dan menyembunyikan password
   function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");

        // Cek apakah password sedang disembunyikan
        if (passwordField.type === "password") {
            passwordField.type = "text";  // Ubah ke teks
            eyeIcon.classList.remove("fa-eye");  // Ganti ikon menjadi mata terbuka
            eyeIcon.classList.add("fa-eye-slash");  // Ganti ikon menjadi mata tertutup
        } else {
            passwordField.type = "password";  // Kembalikan ke password
            eyeIcon.classList.remove("fa-eye-slash");  // Ganti ikon menjadi mata tertutup
            eyeIcon.classList.add("fa-eye");  // Ganti ikon menjadi mata terbuka
        }
    }
    </script>

@endsection