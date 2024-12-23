<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        // Menampilkan data layanan dengan 10 item per halaman
        $layanans = Layanan::paginate(2); 
        return view('pages-admin.data-layanan', compact('layanans'));
    }

    public function show(Request $request)
    {
        // Bangun query untuk mengambil data layanan
        $query = Layanan::query();

        // Jika ada query pencarian, filter layanan berdasarkan nama atau deskripsi
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // Pencarian berdasarkan nama_layanan atau deskripsi
            $query->where('nama_layanan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        // Ambil data layanan setelah difilter
        $layanans = $query->get();

        // Kembalikan tampilan dengan data layanan
        return view('pages-admin.data-layanan', compact('layanans'));
    }

    public function create()
    {
        return view('pages-admin.tambah-layanan'); // Nama view sesuai dengan file Anda
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $fotoPath = null;
    
        // Periksa apakah ada file yang diunggah
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('layanan', 'public'); // Simpan di 'storage/app/public/layanan'
        }
    
        // Simpan data ke database
        Layanan::create([
            'nama_layanan' => $request->nama_layanan, // Mengambil input dari field 'nama_layanan'
            'deskripsi' => $request->deskripsi,      // Mengambil input dari field 'deskripsi'
            'harga' => $request->harga,              // Mengambil input dari field 'harga'
            'foto' => $fotoPath,                     // Path gambar
        ]);
    
        return redirect()->route('data-layanan')->with('success', 'Layanan berhasil ditambahkan');
    }    

    public function destroy($id)
    {
        try {
            // Cari layanan berdasarkan ID
            $layanan = Layanan::findOrFail($id);
            
            // Hapus layanan
            $layanan->delete();
            
            // Mengalihkan ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('pages-admin.data-layanan')->with('success', 'Data layanan berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi error, mengalihkan dengan pesan gagal
            return redirect()->route('pages-admin.data-layanan')->with('error', 'Gagal menghapus data.');
        }
    }

    public function edit($id)
    {
        // Ambil data layanan berdasarkan ID
        $layanan = Layanan::findOrFail($id);
    
        // Kembalikan tampilan edit dengan data layanan
        return view('pages-admin.edit-layanan', compact('layanan'));
    }

      // Metode untuk memperbarui data layanan
      public function update(Request $request, $id)
      {
          $layanan = Layanan::findOrFail($id);
  
          // Validasi data
          $request->validate([
              'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
              'nama_layanan' => 'required|string|max:255',
              'deskripsi' => 'required',
              'harga' => 'required|numeric',
          ]);
  
          // Proses jika ada file baru
          if ($request->hasFile('foto')) {
              // Hapus foto lama jika ada
              if ($layanan->foto) {
                  Storage::delete('public/' . $layanan->foto);
              }
  
              // Simpan foto baru
              $filePath = $request->file('foto')->store('layanan', 'public');
              $layanan->foto = $filePath;
          }
  
          // Perbarui data layanan lainnya
          $layanan->nama_layanan = $request->nama_layanan;
          $layanan->deskripsi = $request->deskripsi;
          $layanan->harga = $request->harga;
          $layanan->save();
  
          // Redirect ke halaman daftar layanan
          return redirect()->route('pages-admin.data-layanan')->with('success', 'Layanan berhasil diperbarui');
      }
  }