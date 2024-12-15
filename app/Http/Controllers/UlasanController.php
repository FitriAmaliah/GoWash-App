<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanController extends Controller
{
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

        return redirect()->back()->with('success', 'Ulasan Anda berhasil dikirim!');
    }

    public function index()
    {
        // Menampilkan semua ulasan
        $ulasan = Ulasan::all();
        return view('ulasan.index', compact('ulasan'));
    }

    
}

