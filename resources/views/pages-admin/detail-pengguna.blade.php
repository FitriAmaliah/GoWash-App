@extends('layouts.layout-admin')

@section('title', 'Detail Pengguna-Admin')

@section('content')

<div class="bg-white p-5 rounded-lg shadow-md">
    <h3 class="text-2xl font-semibold mb-4">Detail Pengguna</h3>

    <div class="mb-4">
        <strong>Nama Pengguna:</strong>
        <p>{{ $user->name }}</p>
    </div>

    <div class="mb-4">
        <strong>Email:</strong>
        <p>{{ $user->email }}</p>
    </div>

    <div class="mb-4">
        <strong>Hak Akses:</strong>
        <p>{{ $user->role }}</p>
    </div>

    <div class="mb-4">
        <strong>Created At:</strong>
        <p>{{ $user->created_at->format('d-m-Y') }}</p>
    </div>

    <div class="mb-4">
        <a href="{{ route('edit.pengguna', ['id' => $user->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit Pengguna</a>
    </div>

    <a href="{{ route('manajemen.pengguna') }}" class="text-blue-500">Kembali ke Manajemen Pengguna</a>
</div>

@endsection
