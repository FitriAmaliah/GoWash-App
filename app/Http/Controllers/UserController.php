<?php

namespace App\Http\Controllers;
use App\Models\Layanan;
use App\Models\Ulasan;
use App\Models\Pemesanan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
 use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('pages-user.dashboard-user'); // Pastikan Anda memiliki file view bernama 'dashboard.blade.php'
    }

    public function layanantersedia()
    {
        // Ambil semua layanan dari database
        $layanans = Layanan::all();

        // Tampilkan view dengan data layanan
        return view('pages-user.layanan-tersedia', compact('layanans'));
    }

    public function statuspemesanan()
    {
       // Ambil data pemesanan berdasarkan user_id yang sedang login
       $userId = Auth::id(); // Dapatkan user_id dari user yang login
       $orders = Pemesanan::where('user_id', $userId)->paginate(); // Paginate 10 per halaman

       return view('pages-user.status-pemesanan', compact('orders'));
    }

    public function riwayatPemesanan()
    {
        // Ambil semua pesanan dengan status "Selesai" untuk riwayat pengerjaan
        $orders = Pemesanan::paginate(10);
        
        return view('pages-user.riwayat-pemesanan', compact('orders'));
    }

    public function profiluser()
    {
        return view('pages-user.profil-user'); // Ganti dengan nama view yang sesuai untuk halaman buat pemesanan
    }

 // Show the form for editing the user's profile
 public function editprofil()
 {
     $user = Auth::user(); // Get the authenticated user

     // Return the view with the user data
     return view('pages-user.edit-profil', compact('user')); // Make sure this matches the view you're using
 }

 public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function index()
{
    $ulasan = Ulasan::with('user')->paginate(10); // Gunakan paginate
    return view('admin.ulasan', compact('ulasan'));
}

public function ulasan()
{
    // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
    $ulasan = Ulasan::paginate(2); // Menampilkan 4 komentar per halaman
    return view('pages-user.ulasan', compact('ulasan'));
}

public function tulisulasan()
{
    // Menampilkan semua ulasan
    $ulasan = Ulasan::all();
    return view('pages-user.tulis-ulasan', compact('ulasan'));
}

public function ulasanStore(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string|max:1000',
    ]);

    // Cek apakah ulasan dengan isi yang sama sudah ada
    $existingUlasan = Ulasan::where('nama_pengguna', Auth::user()->name)
        ->where('komentar', $request->komentar)
        ->where('rating', $request->rating)
        ->first();

    if ($existingUlasan) {
        return redirect()->route('ulasan')->withErrors(['komentar' => 'Ulasan ini sudah ada.']);
    }

    // Simpan ulasan jika tidak ada yang sama
    $ulasan = new Ulasan();
    $ulasan->nama_pengguna = Auth::user()->name;
    $ulasan->rating = $request->rating;
    $ulasan->komentar = $request->komentar;
    $ulasan->tanggal_ulasan = now();
    $ulasan->save();

    return redirect()->route('ulasan')->with('success', 'Ulasan berhasil ditambahkan!');
}

public function updateulasan(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string',
    ]);

    $ulasan = Ulasan::findOrFail($id);
    $ulasan->rating = $request->rating;
    $ulasan->komentar = $request->komentar;
    $ulasan->save();

    return redirect()->back()->with('success', 'Ulasan berhasil diperbarui!');
}

public function destroy($id)
{
    $ulasan = Ulasan::findOrFail($id);
    $ulasan->delete();

    return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
}

    public function formpemesanan($layananId)
    {
        // Ambil data layanan berdasarkan ID yang dipilih
        $layanans = Layanan::findOrFail($layananId); // Menangkap layanan berdasarkan ID
        
        // Kirimkan data layanan ke view
        return view('pages-user.form-pemesanan', compact('layanans'));
    }

    public function pemesananpelanggan($layananId)
    {
        // Ambil data layanan berdasarkan ID yang dipilih
        $layanans = Layanan::findOrFail($layananId); // Menangkap layanan berdasarkan ID
        
        // Kirimkan data layanan ke view
        return view('pages-user.pemesanan-pelanggan', compact('layanans'));
    }
    
//     public function create($id)
// {
//     $layanans = Layanan::all();
//     return view('pages-user,form-pemesanan', compact('layanans'))->with('id', $id);
// }

    public function pelanggan()
    {
        // Ambil semua layanan dari database
        $layanans = Layanan::all();

        // Tampilkan view dengan data layanan
        return view('pages-user.pelanggan', compact('layanans'));
    }

    public function saveProfile(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's profile data
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
    
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile-user')->with('success', 'Profil Anda telah diperbarui!');
    }


    public function show()
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('pages-user.profil-user', compact('user')); // Tampilkan profil
    }
    
    public function edit()
    {
        $user = auth()->user(); // Ambil data pengguna
        return view('pages-user.edit.profil', compact('user')); // Tampilkan form edit
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

        return redirect()->route('profil.user')->with('success', 'Profil berhasil diperbarui.');
    }


public function checkout(Request $request)
{
    try {
        $user = Auth::user();
        if (!$user) {
            throw new \Exception('User not authenticated');
        }

        // Validasi data
        $validated = $request->validate([
            'layanan_id' => 'required|exists:layanan,id',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'metode_pembayaran' => 'required|in:cash,digital',
        ]);

        $layananId = $validated['layanan_id'];
        $tanggal = $validated['tanggal'];
        $waktu = $validated['waktu'];
        $metodePembayaran = $validated['metode_pembayaran'];

        // Cari layanan
        $layanan = Layanan::findOrFail($layananId);
        if (!$layanan) {
            throw new \Exception('Layanan not found');
        }

        $biaya = $layanan->harga; // Sesuaikan dengan nama kolom harga pada model Layanan

        // Simpan pemesanan
        $pemesanan = Pemesanan::create([
            'layanan_id' => $layananId,
            'user_id' => $user->id,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'status' => 'belum selesai',
            'metode_pembayaran' => $metodePembayaran,
            'status_pembayaran' => $metodePembayaran === 'cash' ? 'success' : 'pending',
            'biaya' => $biaya,
        ]);

        if ($metodePembayaran === 'cash') {
            // Jika pembayaran cash, langsung sukses
            $pemesanan->status = 'belum selesai';
            $pemesanan->save();

            return response()->json([
                'message' => 'Pemesanan berhasil dengan metode cash!',
                'pemesanan' => $pemesanan,
            ]);
        } elseif ($metodePembayaran === 'digital') {
            // Konfigurasi Midtrans
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false; // Ubah ke true jika dalam mode produksi
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Siapkan data untuk Snap Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id' => $pemesanan->id,
                    'gross_amount' => $biaya,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->telepon ?? '',
                ],
                'item_details' => [
                    [
                        'id' => $layananId,
                        'price' => $biaya,
                        'quantity' => 1,
                        'name' => $layanan->nama_layanan,
                    ],
                ],
            ];

            $snapToken = Snap::getSnapToken($payload);

            return response()->json([
                'snapToken' => $snapToken,
                'pemesanan' => $pemesanan,
            ]);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Catat error validasi
        Log::error('Validation Error: ', $e->errors());
        return response()->json(['error' => 'Validation Error', 'messages' => $e->errors()], 422);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Catat jika model tidak ditemukan
        Log::error('Model Not Found: ' . $e->getMessage());
        return response()->json(['error' => 'Data not found'], 404);
    } catch (\Exception $e) {
        // Catat error umum lainnya
        Log::error('Checkout Error: ' . $e->getMessage());
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

public function paymentSuccess(Request $request)
{
    try {
        $orderId = $request->input('order_id');

        // Cari pemesanan berdasarkan order_id
        $pemesanan = Pemesanan::find($orderId);

        if (!$pemesanan) {
            throw new \Exception('Pemesanan not found');
        }

        // Perbarui status pembayaran dan pemesanan
        $pemesanan->update([
            'status_pembayaran' => 'success',
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil!',
        ]);
    } catch (\Exception $e) {
        // Catat error
        Log::error('Payment Success Error: ' . $e->getMessage());
        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

}





