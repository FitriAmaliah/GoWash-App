<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManajemenPenggunaController extends Controller
{
// Menampilkan daftar pengguna dengan role 'user' dengan pagination
public function index()
{
    // Mengambil data pengguna dengan role 'user' dan paginasi
    $users = User::where('role', 'user')->paginate(5); // Menampilkan 10 pengguna per halaman
    return view('pages-admin.manajemen-pengguna', compact('users')); // Menampilkan tampilan dengan data pengguna
}

    // Menampilkan form untuk menambah pengguna baru
    public function create()
    {
        return view('pages-admin.tambah-pengguna'); // Menampilkan form untuk menambah pengguna
    }

        // Menampilkan form untuk menambah pengguna baru
        public function tambahpengguna()
        {
            return view('pages-admin.tambah-pengguna'); // Menampilkan form untuk menambah pengguna
        }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|', // Menambahkan konfirmasi password
        ]);

        // Menyimpan data pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => 'user', // Menentukan role sebagai 'user'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('manajemen-pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        return view('pages-admin.edit-pengguna', compact('user')); // Menampilkan form edit
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Mengupdate data pengguna
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Pastikan password hanya diubah jika diisi
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('manajemen-pengguna')->with('success', 'Pengguna berhasil diperbarui');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manajemen-pengguna')->with('success', 'Pengguna berhasil dihapus');
    }
}
