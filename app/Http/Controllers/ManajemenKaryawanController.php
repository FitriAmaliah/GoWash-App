<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManajemenKaryawanController extends Controller
{
    // Menampilkan daftar pengguna dengan role 'user'
    public function index()
    {
        $users = User::where('role', 'karyawan')->get(); // Mengambil data pengguna dengan role 'user'
        return view('pages-admin.manajemen-karyawan', compact('users')); // Menampilkan tampilan dengan data pengguna
    }

    // Menampilkan form untuk menambah pengguna baru
    public function create()
    {
        return view('pages-admin.tambah-karyawan'); // Menampilkan form untuk menambah pengguna
    }

        // Menampilkan form untuk menambah pengguna baru
        public function tambahpengguna()
        {
            return view('pages-admin.tambah-karyawan'); // Menampilkan form untuk menambah pengguna
        }

    // Menyimpan pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // Menambahkan konfirmasi password
        ]);

        // Menyimpan data pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
            'role' => 'karyawan', // Menentukan role sebagai 'user'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('manajemen-karyawan')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        return view('pages-admin.edit-karyawan', compact('user')); // Menampilkan form edit
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

        return redirect()->route('manajemen-karyawan')->with('success', 'Pengguna berhasil diperbarui');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manajemen-karyawan')->with('success', 'Pengguna berhasil dihapus');
    }
}
