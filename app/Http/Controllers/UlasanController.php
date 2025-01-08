<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
    public function index()
    {
        // Menampilkan ulasan dengan paginasi 10 ulasan per halaman
        $ulasan = Ulasan::paginate(2);
        return view('pages-user.ulasan', compact('ulasan'));
    }
    public function ulasanLandingPage()
    {
        // Menampilkan ulasan dengan paginasi 10 ulasan per halaman
        $ulasan = Ulasan::paginate(6);
        return view('landing-page', compact('ulasan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Ulasan::create([
            'nama_pengguna' => $validated['nama_pengguna'],
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
            'tanggal_ulasan' => now(),
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan!');
    }
    
      // Menampilkan form edit ulasan
      public function edit($id)
      {
          $ulasan = Ulasan::findOrFail($id); // Ambil ulasan berdasarkan ID
          return view('pages-user.ulasan', compact('ulasan')); // Tampilkan form edit
      }
  
      // Memperbarui ulasan
      public function updateulasan(Request $request, $id)
      {
          $ulasan = Ulasan::findOrFail($id); // Ambil ulasan berdasarkan ID
          
          // Validasi data yang diterima
          $request->validate([
              'rating' => 'required|integer|min:1|max:5',
              'komentar' => 'required|string',
          ]);
          
          // Perbarui ulasan
          $ulasan->update([
              'rating' => $request->rating,
              'komentar' => $request->komentar,
          ]);
  
          // Redirect setelah pembaruan
          return redirect()->route('ulasan.update')->with('success', 'Ulasan berhasil diperbarui.');
      }

      public function update(Request $request, $id)
{
    // Mencari ulasan berdasarkan ID yang diterima
    $ulasan = Ulasan::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'rating' => 'required|integer|between:1,5',
        'komentar' => 'required|string|max:1000',
    ]);

    // Update data ulasan
    $ulasan->update([
        'rating' => $request->input('rating'),
        'komentar' => $request->input('komentar'),
    ]);

    // Redirect setelah berhasil
    return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui!');
}
public function destroy($id)
{
    $ulasan = Ulasan::findOrFail($id); // Cari ulasan berdasarkan ID
    $ulasan->delete(); // Hapus ulasan

    return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
}

}

