<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Pemesanan;

class KaryawanController extends Controller
{
    public function dashboard()
    {
        return view('pages-karyawan.dashboard-karyawan'); // Pastikan Anda memiliki file view bernama 'dashboard.blade.php'
    }
    
    public function index()
    {
        $orders = Pemesanan::with('karyawan')->paginate(10); // Gunakan paginate
        return view('pages-karyawan.tugas-harian', compact('orders'));
    }
    
    public function tugasharian()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-karyawan.tugas-harian', compact('orders'));
    }

    public function updatestatus()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-karyawan.update-status', compact('orders'));
    }

    public function ordersupdateStatus(Request $request, $id)
    {
        $order = Pemesanan::findOrFail($id);

        if ($request->status === 'Proses' && $order->status !== 'Proses') {
            $order->status = 'Proses';
        } elseif ($request->status === 'Selesai' && $order->status !== 'Selesai') {
            $order->status = 'Selesai';
        }

        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
 
public function setOrderToSelesai($id)
{
    // Temukan pesanan berdasarkan ID
    $order = Pemesanan::find($id);

    // Cek jika pesanan tidak ditemukan
    if (!$order) {
        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    // Ubah status pesanan menjadi "Selesai"
    $order->status = 'Selesai';
    
    // Cek apakah perubahan status berhasil disimpan
    if ($order->save()) {
        // Hapus pesanan setelah status diperbarui
        $order->delete(); // Menghapus data setelah status menjadi selesai

        // Redirect ke halaman riwayat pengerjaan dengan pesan sukses
        return redirect()->route('riwayat.pengerjaan')->with('success', 'Pesanan telah selesai dan data dihapus.');
    } else {
        // Jika status tidak berhasil disimpan
        return redirect()->back()->with('error', 'Gagal memperbarui status pesanan.');
    }
}
    
    public function detailpesanan()
    {
        return view('pages-karyawan.detail-pesanan'); // Pastikan Anda memiliki file view bernama 'dashboard.blade.php'
    }

    public function riwayatPengerjaan()
    {
        // Ambil semua pesanan dengan status "Selesai" untuk riwayat pengerjaan
        $orders = Pemesanan::paginate(10);
        
        return view('pages-karyawan.riwayat-pengerjaan', compact('orders'));
    }
    
        public function showRiwayatPengerjaan()
    {
        $orders = Pemesanan::where('status', 'Selesai')->paginate(10);

        return view('riwayat-pengerjaan', compact('orders'));
    }

    public function ulasanpengguna()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $ulasan = Ulasan::paginate(2); // Menampilkan 4 komentar per halaman
        return view('pages-karyawan.ulasan-pengguna', compact('ulasan'));
    }

    public function profilkaryawan()
    {
        return view('pages-karyawan.profil-karyawan'); // Pastikan Anda memiliki file view bernama 'dashboard.blade.php'
    }

    public function editprofil()
    {
        return view('pages-karyawan.edit-profil'); // Pastikan Anda memiliki file view bernama 'dashboard.blade.php'
    }

    public function show()
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('pages-karyawan.profil-karyawan', compact('user')); // Tampilkan profil
    }
    
    public function edit()
    {
        $user = auth()->user(); // Ambil data pengguna
        return view('pages-karyawan.edit.profil', compact('user')); // Tampilkan form edit
    }    

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->address = $validatedData['address'] ?? $user->address;

        // Update foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('profil.karyawan')->with('success', 'Profil berhasil diperbarui.');
    }
}


