<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function create($id)
    {
        // Ambil semua layanan untuk dropdown
        $layanans = Layanan::all();

        // Kirim layanan dan ID layanan yang dipilih ke view
        return view('pages-user.form-pemesanan', compact('layanans'))->with('id', $id);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'service' => 'required|exists:layanans,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
        ]);

        // Simpan data pemesanan
        Pemesanan::create([
            'layanan_id' => $request->input('service'),
            'tanggal' => $request->input('tanggal'),
            'waktu' => $request->input('waktu'),
        ]);

        // Redirect ke dashboard atau halaman sukses
        return redirect()->route('dashboard.user')->with('success', 'Pemesanan berhasil!');
    }

    public function updateStatus(Request $request, Pemesanan $order)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'status' => 'required|in:Proses,Selesai',
        ]);

        // Update status pesanan
        $order->status = $request->status;
        $order->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function updatePaymentStatus(Request $request)
    {
        // Validasi input
        $request->validate([
            'layanan_id' => 'required|integer|exists:pemesanan,layanan_id', // Pastikan 'layanan_id' ada di tabel 'pemesanan'
            'status_pembayaran' => 'required|in:pending,success,failure',
        ]);
    
        // Cari pesanan berdasarkan layanan_id
        $order = Pemesanan::where('layanan_id', $request->layanan_id)->first();
    
        // Jika pesanan tidak ditemukan, kembalikan respons error
        if (!$order) {
            return response()->json([
                'error' => 'Pesanan tidak ditemukan. Pastikan ID layanan valid.'
            ], 404);
        }
    
        // Perbarui status pembayaran hanya jika berbeda
        if ($order->status_pembayaran !== $request->status_pembayaran) {
            $order->status_pembayaran = $request->status_pembayaran;
            $order->save();
    
            return response()->json([
                'message' => 'Status pembayaran berhasil diperbarui.',
                'status_pesanan' => $order->status_pembayaran
            ], 200);
        }
    
        // Jika status tidak berubah, kembalikan pesan bahwa tidak ada pembaruan
        return response()->json([
            'message' => 'Status pembayaran sudah diperbarui sebelumnya.',
            'status_pesanan' => $order->status_pembayaran
        ], 200);
    }
    
}
