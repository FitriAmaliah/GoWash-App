@extends('layouts.layout-karyawan')

@section('title', 'Dashboard-Karyawan')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Content Area -->
<div class="flex-1 p-3">
    <div class="mb-6"> 
        <!-- Hallo Icon with container -->
        <div class="flex items-center justify-start mt-4">
            <div class="p-2 bg-gradient-to-r from-blue-400 to-indigo-500 text-white rounded-lg shadow-sm flex items-center space-x-3">
                <span class="text-3xl">👋</span> <!-- Mengurangi ukuran ikon -->
                <span class="text-lg font-semibold">Hallo Karyawan, Selamat datang di Dashboard!</span> <!-- Mengurangi ukuran teks -->
            </div>
        </div>

<div class="mt-8">
    
<!-- Container untuk Statistik -->
<div class="bg-white rounded-lg shadow-lg p-6 mx-auto" style="max-width: 1000px; height: auto; display: flex; flex-direction: column; justify-content: center; align-items: center;">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Total Tugas Hari Ini -->
            <div class="bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 p-4 rounded shadow flex justify-between items-center">
                <div>
                    <h2 class="text-white font-semibold">Total Tugas Hari Ini</h2>
                    <p class="text-2xl text-white font-bold">12</p>
                </div>
                <i class="fas fa-tasks fa-5x text-white"></i>
            </div>
            
            <!-- Tugas yang Sudah Dimulai -->
            <div class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 p-4 rounded shadow flex justify-between items-center">
                <div>
                    <h2 class="text-white font-semibold">Tugas Dimulai</h2>
                    <p class="text-2xl text-white font-bold">8</p>
                </div>
                <i class="fas fa-play-circle fa-5x text-white"></i>
            </div>
            
            <!-- Tugas Selesai -->
            <div class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 p-4 rounded shadow flex justify-between items-center">
                <div>
                    <h2 class="text-white font-semibold">Tugas Selesai</h2>
                    <p class="text-2xl text-white font-bold">5</p>
                </div>
                <i class="fas fa-check-circle fa-5x text-white"></i>
            </div>
        </div>
        
   @endsection