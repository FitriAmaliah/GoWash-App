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
    $userId = auth()->id(); // Mendapatkan user ID yang sedang login

    // Mengambil total pemesanan berdasarkan user_id
    $totalpemesanan = Pemesanan::where('user_id', $userId)->count();

    // Mengambil total pemesanan aktif berdasarkan user_id
    $pemesananaktif = Pemesanan::where('user_id', $userId)
        ->where('status', 'Proses')
        ->count(); // Menghitung jumlah pemesanan dengan status 'Proses'

    // Mengambil total pemesanan selesai berdasarkan user_id
    $pemesananselesai = Pemesanan::where('user_id', $userId)
        ->where('status', 'Selesai')
        ->count(); // Menghitung jumlah pemesanan dengan status 'Selesai'

    // Mengirim data ke view dashboard-user
    return view('pages-user.dashboard-user', compact('totalpemesanan', 'pemesananaktif', 'pemesananselesai'));
}

public function showLandingPage()
{
    $ulasan = Ulasan::all(); // Assuming you have a model named Ulasan
    return view('landingPage', compact('ulasan')); // Pass the variable to the view
}

public function layanantersedia(Request $request)
{
    // Ambil semua layanan dengan paginasi 2 data per halaman
    $layanans = Layanan::paginate(3);

    // Tampilkan view dengan data layanan dan paginasi
    return view('pages-user.layanan-tersedia', compact('layanans'));
}

    public function indexlayanantersedia(Request $request)
{
    // Mendapatkan parameter pencarian
    $search = $request->input('search');
    
    // Ambil data layanan dengan relasi terkait (jika ada) dan pencarian yang sesuai
    $layanans = Layanan::when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            // Pencarian berdasarkan nama layanan
            $q->where('nama_layanan', 'like', '%' . $search . '%')
              // Pencarian berdasarkan deskripsi layanan
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              // Pencarian berdasarkan harga layanan
              ->orWhere('harga', 'like', '%' . $search . '%');
        });
    })
    // Urutkan berdasarkan nama layanan atau bisa diurutkan berdasarkan waktu
    ->orderBy('nama_layanan', 'asc') // Atau bisa diubah sesuai kebutuhan, misal berdasarkan created_at
    ->paginate(5); // Batas per halaman 5

    // Return view dengan data layanan yang sudah difilter dan diurutkan
    return view('pages-user.layanan-tersedia', compact('layanans', 'search'));
}

public function indexstatuspemesanan(Request $request)
{
    // Mendapatkan parameter pencarian
    $search = $request->input('search');
    $status = $request->input('status');  // If you want to filter by status as well

    // Ambil data layanan dengan relasi terkait (jika ada) dan pencarian yang sesuai
    $layanans = Layanan::when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            // Pencarian berdasarkan nama layanan
            $q->where('nama_layanan', 'like', '%' . $search . '%')
              // Pencarian berdasarkan deskripsi layanan
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              // Pencarian berdasarkan harga layanan
              ->orWhere('harga', 'like', '%' . $search . '%');
        });
    })
    ->orderBy('nama_layanan', 'asc') // Atau bisa diubah sesuai kebutuhan
    ->paginate(5); // Batas per halaman 5

    // Ambil data pemesanan dengan status yang sesuai
    $orders = Pemesanan::when($status, function ($query) use ($status) {
        $query->where('status', 'like', '%' . $status . '%');
    })
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            // Search for orders based on layanan name
            $q->whereHas('layanan', function ($query) use ($search) {
                $query->where('nama_layanan', 'like', '%' . $search . '%');
            });
        });
    })
    ->paginate(5);  // Batas per halaman 5

    // Return view dengan data layanan yang sudah difilter dan diurutkan
    return view('pages-user.status-pemesanan', compact('orders', 'layanans', 'search', 'status'));
}

public function indexriwayatpemesanan(Request $request)
{
    // Mendapatkan parameter pencarian dan status
    $search = $request->input('search');
    $status = $request->input('status');  // If you want to filter by order status

    // Ambil data layanan yang sesuai dengan pencarian
    $layanans = Layanan::when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            // Pencarian berdasarkan nama layanan
            $q->where('nama_layanan', 'like', '%' . $search . '%')
              // Pencarian berdasarkan deskripsi layanan
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              // Pencarian berdasarkan harga layanan
              ->orWhere('harga', 'like', '%' . $search . '%');
        });
    })
    ->orderBy('nama_layanan', 'asc') // Sorting berdasarkan nama layanan atau sesuai kebutuhan
    ->paginate(5); // Pagination dengan 5 data per halaman

    // Ambil data pemesanan berdasarkan status jika diberikan
    $orders = Pemesanan::when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            // Pencarian berdasarkan nama layanan di pemesanan
            $q->whereHas('layanan', function ($query) use ($search) {
                $query->where('nama_layanan', 'like', '%' . $search . '%');
            });
        });
    })
    ->when($status, function ($query) use ($status) {
        $query->where('status', 'like', '%' . $status . '%');
    })
    ->paginate(5);

    // Return view dengan data layanan dan pemesanan yang sudah difilter
    return view('pages-user.riwayat-pemesanan', compact('orders', 'layanans', 'search', 'status'));
}

    public function statuspemesanan()
    {
       // Ambil data pemesanan berdasarkan user_id yang sedang login
       $userId = Auth::id(); // Dapatkan user_id dari user yang login
       $orders = Pemesanan::where('user_id', $userId)->paginate(10); // Paginate 10 per halaman

       return view('pages-user.status-pemesanan', compact('orders'));
    }

    public function riwayatpemesanan()
        {
            // Ambil pesanan dengan status "Selesai" untuk pengguna yang sedang login
            $orders = Pemesanan::where('user_id', auth()->id())
                            ->where('status', 'Selesai')
                            ->paginate(2);
            
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
    $ulasan = Ulasan::paginate(4); // Menampilkan 4 komentar per halaman
    return view('pages-user.ulasan', compact('ulasan'));
}

public function tulisulasan()
{
    // Menampilkan semua ulasan
    $ulasan = Ulasan::all();
    
    // Menampilkan data order (contoh)
    $order = Pemesanan::all(); // Sesuaikan jika Anda ingin mengambil data order tertentu

    // Menampilkan halaman dengan variabel ulasan dan order
    return view('pages-user.tulis-ulasan', compact('ulasan', 'order'));
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
    $layanan = Layanan::findOrFail($layananId); // Menangkap layanan berdasarkan ID
    
    // Ambil data pemesanan sebelumnya jika ada (opsional)
    $orders = Pemesanan::where('user_id', auth()->id())->first(); // Ambil pemesanan terakhir dari user yang login

    // Ambil data pengguna yang sedang login
    $user = auth()->user(); // Mengambil data user yang sedang login
    
    // Kirimkan data layanan, pemesanan, dan user ke view
    return view('pages-user.form-pemesanan', compact('layanan', 'orders', 'user'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'layanan_id' => 'required|exists:layanan,id',
        'user_id' => 'required|exists:users,id',
        'id_member' => 'required|exists:users,id_member',
        'tanggal' => 'required|date',
        'waktu' => 'required',
        'metode_pembayaran' => 'required|string',
        'status_pembayaran' => 'required|in:pending,success,failed',
        'biaya' => 'required|numeric',
        'plat_nomor' => 'required|string',
        'jenis_kendaraan' => 'required|string',
    ]);

    Pemesanan::create($validated);

    return redirect()->back()->with('success', 'Data berhasil disimpan!');
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
                    'id_member' => 'required|exists:users,id_member',
                    'tanggal' => 'required|date',
                    'waktu' => 'required|date_format:H:i',
                    'metode_pembayaran' => 'required|in:cash,digital',
                    'plat_nomor' => 'required|string|max:255', // Tambahkan validasi untuk plat_nomor
                    'jenis_kendaraan' => 'required|string|max:255', // Tambahkan validasi untuk plat_nomor
                ]);
        
                $layananId = $validated['layanan_id'];
                $tanggal = $validated['tanggal'];
                $waktu = $validated['waktu'];
                $metodePembayaran = $validated['metode_pembayaran'];
                $platNomor = $request->input('plat_nomor');
                $jenisKendaraan = $request->input('jenis_kendaraan');   
                $idMember =$validated['id_member'];
        
                // Cari layanan
                $layanan = Layanan::findOrFail($layananId);
                if (!$layanan) {
                    throw new \Exception('Layanan not found');
                }
        
                $biaya = $layanan->harga; // Sesuaikan dengan nama kolom harga pada model Layanan
                \Log::info($request->all());
        
                // Simpan pemesanan
                $pemesanan = Pemesanan::create([
                    'layanan_id' => $layananId,
                    'id_member' => $user->id_member,
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                    'waktu' => $waktu,
                    'status' => 'belum selesai',
                    'metode_pembayaran' => $metodePembayaran,
                    'status_pembayaran' => $metodePembayaran === 'cash' ? 'success' : 'pending',
                    'biaya' => $biaya,
                    'plat_nomor' => $platNomor, // Tambahkan nilai plat_nomor
                    'jenis_kendaraan' => $jenisKendaraan, // Tambahkan nilai plat_nomor
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

         // Perbarui status pembayaran
         $pemesanan->status_pembayaran = 'success';
         $pemesanan->save();

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






