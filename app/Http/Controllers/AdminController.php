<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\Layanan;
use App\Models\Pemesanan;
use Midtrans\Config;
use Midtrans\Snap;
 use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminController extends Controller
{
    public function dashboard()
    {
        $totalpemesanan = Pemesanan::count();

        // Mengambil total pemasukan dari subtotal di tabel transaksi
        $totalpendapatan = Pemesanan::sum('biaya'); // Menjumlahkan semua nilai di kolom 'subtotal'
        $jumlahpelanggan = User::count(); // Menjumlahkan semua nilai di kolom 'subtotal'

        return view('pages-admin.dashboard-admin', compact('totalpemesanan', 'totalpendapatan', 'jumlahpelanggan')); // Dashboard view
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('http://127.0.0.1:8000/landing-page'); // Redirect to landing page
    }

    // Method to show the Admin Profile
    public function profile()
    {
        return view('pages-admin.profile-admin'); // Profile view
    }

    // Method to show the Edit Profile form
    public function editprofile()
    {
        return view('pages-admin.edit-profile'); // Edit Profile view
    }

    public function datalayanan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $layanans = Layanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.data-layanan', compact('layanans'));
    }
    
    public function tambahlayanan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $layanans = Layanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.tambah-layanan', compact('layanans'));
    }
    
    public function store(Request $request)
    {
        // Logika untuk menyimpan transaksi
        // Validasi, simpan data ke database, dll.

        // Redirect atau tampilkan pesan setelah penyimpanan selesai
        return redirect()->route('pages-admin.tambah-transaksi'); // Contoh redirect ke halaman daftar transaksi
    }

     // Menampilkan daftar semua pesanan
     public function index()
     {
         // Mendapatkan semua data pesanan
         $orders = Pemesanan::all();
 
         // Mengirimkan data orders ke view index
         return view('pages-admin-print-layanan', compact('orders'));
     }

     public function DetailLayanan($id)
     {
         // Fetch the order by id
         $order = Pemesanan::findOrFail($id);
 
         // Pass the order to the print-layanan view
         return view('pages-admin.print-layanan', compact('order'));
     }

    public function printReceipt($id)
    {
        // Retrieve the order by ID
        $order = Pemesanan::find($id);

        // If the order is not found, you can handle it accordingly
        if (!$order) {
            return abort(404, 'Order not found');
        }

        // Generate the PDF and pass the order data to the view
        $pdf = Pdf::loadView('print.print-layanan', compact('order'));

        // Return the PDF as a download
        return $pdf->download("struk-pembelian-{$id}.pdf");
    }
    
    public function cetakPdf(Request $request)
    {
        // Cek apakah ada filter tanggal
        $startDate = $request->get('start_date');
        
        // Jika ada filter tanggal
        if ($startDate) {
            // Filter data berdasarkan tanggal yang dipilih
            $orders = Pemesanan::whereDate('tanggal', '=', $startDate)->get();
        } else {
            // Jika tidak ada filter tanggal, ambil semua data
            $orders = Pemesanan::all();
        }
        
        // Memasukkan data ke view untuk PDF
        $pdf = PDF::loadView('print.print-laporan', compact('orders'));
        
        // Menghasilkan file PDF dan mendownloadnya
        return $pdf->download('laporan-transaksi.pdf');
    }
     
    public function filter(Request $request)
    {
        // Ambil parameter start_date dari request
        $startDate = $request->get('start_date');
    
        // Jika start_date ada, filter data berdasarkan tanggal
        if ($startDate) {
            $orders = Pemesanan::whereDate('tanggal', '=', $startDate)->get();  // Memastikan tanggal sama dengan start_date
        } else {
            // Jika tidak ada filter tanggal, ambil semua data
            $orders = Pemesanan::all();
        }
    
        // Kembalikan data yang sudah difilter atau seluruh data dalam format JSON
        return response()->json($orders);
    }    

    public function datatransaksi()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.data-transaksi', compact('orders'));
    }

public function tambahtransaksi()
{
    // Mengambil semua data pengguna dengan role 'user'
    $users = User::where('role', 'user')->get()->map(function($user) {
        // Mengganti nama atribut 'id' menjadi 'id_user'
        $user->id_user = $user->id;
        return $user;
    });

    $layanan = Layanan::all();

    return view('pages-admin.tambah-transaksi', compact('users', 'layanan')); // Profile view
}

        public function storetransaksibyadmin(Request $request)
        {  
                    // dd($request->all());
                try {
                    $user = User::findOrFail($request->user_id);
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
        
    public function paymentsuccesstransaksibyadmin(Request $request)
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

    public function edittransaksi()
    {
        return view('pages-admin.edit-transaksi'); // Profile view
    }

    public function datapemesanan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.data-pemesanan', compact('orders'));
    }

    public function tambahpemesanan()
    {
        return view('pages-admin.tambah-pemesanan'); // Profile view
    }

    public function editpemesanan($id)
    {
        $order = Pemesanan::findOrFail($id); // Ambil data pemesanan berdasarkan ID
        return view('pages-admin.edit-pemesanan', compact('order'));
    }
    public function updatepemesanan(Request $request, $id)
{
    $order = Pemesanan::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'customer-name' => 'required|string|max:255',
        'vehicle-type' => 'required|string',
        'service-type' => 'required|string',
        'order-date' => 'required|date',
        'payment-method' => 'required|string',
        'order-status' => 'required|string',
    ]);

    // Update data pemesanan
    $order->update([
        'nama_pelanggan' => $validated['customer-name'],
        'jenis_layanan' => $validated['service-type'],
        'tanggal_pesan' => $validated['order-date'],
        'metode_pembayaran' => $validated['payment-method'],
        'status_pemesanan' => $validated['status_pemesanan'],
    ]);

    return redirect()->route('pages-admin.data-pemesanan')->with('success', 'Pemesanan berhasil diperbarui!');
}

    public function manajemenkaryawan()
    {
        // Ambil hanya pengguna dengan role 'User' dan tambahkan pagination
        $users = User::where('role', 'Karyawan')->paginate(10);
        
        // Kirim data ke tampilan
        return view('pages-admin.manajemen-karyawan', compact('users'));
    }

    public function tambahkaryawan()
    {
        return view('pages-admin.tambah-karyawan'); // Profile view
    }

    public function editKaryawan($id)
    {
        $user = User::findOrFail($id);  // Menemukan pengguna berdasarkan ID
        return view('pages-admin.edit-karyawan', compact('user'));  // Menampilkan tampilan edit karyawan dengan data pengguna
    }

    public function manajemenpengguna()
    {
        // Ambil hanya pengguna dengan role 'User' dan tambahkan pagination
        $users = User::where('role', 'User')->paginate(10);
        
        // Kirim data ke tampilan
        return view('pages-admin.manajemen-pengguna', compact('users'));
    }

    // Menampilkan form untuk menambah pengguna baru
    public function create()
    {
        return view('pages-admin.tambah-pengguna'); // Menampilkan form untuk menambah pengguna
    }

    public function tambahpengguna()
    {
        return view('pages-admin.tambah-pengguna'); // Profile view
    }

    public function editPengguna($id)
    {
        $user = User::findOrFail($id);  // Menemukan pengguna berdasarkan ID
        return view('pages-admin.edit-pengguna', compact('user'));  // Menampilkan tampilan edit karyawan dengan data pengguna
    }
    public function datapelanggan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.data-pelanggan', compact('orders'));
    }

    public function tambahpelanggan()
    {
        return view('pages-admin.tambah-pelanggan'); // Profile view
    }

    public function pendapatan()
    {
        return view('pages-admin.pendapatan'); // Profile view
    }

    public function laporan(Request $request)
{
    // Mendapatkan input tanggal mulai (start_date) dari request
    $startDate = $request->input('start_date');

    // Jika tanggal mulai diisi, filter pemesanan berdasarkan tanggal
    if ($startDate) {
        // Mengambil pemesanan yang sesuai dengan tanggal
        $orders = Pemesanan::whereDate('created_at', $startDate)->paginate(10); // Filter berdasarkan tanggal
    } else {
        // Jika tidak ada tanggal, ambil semua pemesanan
        $orders = Pemesanan::paginate(10);
    }

    return view('pages-admin.laporan', compact('orders'));
}

    public function indexlayanan(Request $request)
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
        return view('pages-admin.data-layanan', compact('layanans', 'search'));
    }

    public function indextransaksi(Request $request)
    {
        // Mendapatkan parameter pencarian
        $search = $request->input('search');
        
        // Ambil data transaksi dengan relasi terkait (misalnya, layanan dan user)
        $orders = Pemesanan::with(['layanan', 'user']) // Asumsi ada relasi 'layanan' dan 'user'
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    // Pencarian berdasarkan nama pengguna
                    $q->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%'); // Nama pengguna
                    })
                    // Pencarian berdasarkan nama layanan
                    ->orWhereHas('layanan', function ($q) use ($search) {
                        $q->where('nama_layanan', 'like', '%' . $search . '%'); // Nama layanan
                    })
                    // Pencarian berdasarkan tanggal transaksi
                    ->orWhere('tanggal', 'like', '%' . $search . '%')
                    // Pencarian berdasarkan metode pembayaran
                    ->orWhere('metode_pembayaran', 'like', '%' . $search . '%')
                    // Pencarian berdasarkan status pembayaran
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
                });
            })
            // Urutkan berdasarkan tanggal transaksi
            ->orderBy('tanggal', 'desc')
            // Pagination jika perlu
            ->paginate(5); // Batas per halaman 5
    
        // Return view dengan data transaksi yang sudah difilter
        return view('pages-admin.data-transaksi', compact('orders', 'search'));
    }

    public function indexpemesanan(Request $request)
    {
        // Mendapatkan parameter pencarian
        $search = $request->input('search');
        
        // Ambil data transaksi dengan relasi terkait (misalnya, layanan dan user)
        $orders = Pemesanan::with(['layanan', 'user']) // Asumsi ada relasi 'layanan' dan 'user'
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    // Pencarian berdasarkan nama pengguna
                    $q->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%'); // Nama pengguna
                    })
                    // Pencarian berdasarkan nama layanan
                    ->orWhereHas('layanan', function ($q) use ($search) {
                        $q->where('nama_layanan', 'like', '%' . $search . '%'); // Nama layanan
                    })
                    // Pencarian berdasarkan tanggal transaksi
                    ->orWhere('tanggal', 'like', '%' . $search . '%')
                    // Pencarian berdasarkan metode pembayaran
                    ->orWhere('metode_pembayaran', 'like', '%' . $search . '%')
                    // Pencarian berdasarkan status pembayaran
                    ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
                });
            })
            // Urutkan berdasarkan tanggal transaksi
            ->orderBy('tanggal', 'desc')
            // Pagination jika perlu
            ->paginate(5); // Batas per halaman 5
    
        // Return view dengan data transaksi yang sudah difilter
        return view('pages-admin.data-pemesanan', compact('orders', 'search'));
    }
    
    public function indexPelanggan(Request $request)
{
    // Retrieve the search input from the request
    $search = $request->input('search');

    // Fetch customer-related orders with related relationships (user and layanan)
    $orders = Pemesanan::with(['layanan', 'user']) // Assumes 'layanan' and 'user' relationships exist
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                // Search by customer/member ID
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('id_member', 'like', '%' . $search . '%'); // Member ID
                })
                // Search by customer name
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%'); // Customer name
                })
                // Search by service name
                ->orWhereHas('layanan', function ($q) use ($search) {
                    $q->where('nama_layanan', 'like', '%' . $search . '%'); // Service name
                })
                // Search by order date
                ->orWhere('tanggal', 'like', '%' . $search . '%')
                // Search by payment method
                ->orWhere('metode_pembayaran', 'like', '%' . $search . '%')
                // Search by payment status
                ->orWhere('status_pembayaran', 'like', '%' . $search . '%');
            });
        })
        // Order results by the order date
        ->orderBy('tanggal', 'desc')
        // Paginate results (5 per page)
        ->paginate(5);

    // Return the view with the filtered data and search term
    return view('pages-admin.data-pelanggan', compact('orders', 'search'));
}

public function indexManajemenPengguna(Request $request)
{
    // Retrieve the search input from the request
    $search = $request->input('search');

    // Fetch users based on search input, filtering by role 'user'
    $users = User::query()
        ->where('role', 'user') // Only include users with role 'user'
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%') // Search by name
                  ->orWhere('email', 'like', '%' . $search . '%') // Search by email
                  ->orWhere('id_member', 'like', '%' . $search . '%'); // Search by member ID (if available)
            });
        })
        ->orderBy('name', 'asc') // Sort by name
        ->paginate(10); // Pagination with 10 users per page

    // Return the view with filtered users and search term
    return view('pages-admin.manajemen-pengguna', compact('users', 'search'));
}

public function indexManajemenKaryawan(Request $request)
{
    // Retrieve the search input from the request
    $search = $request->input('search');

    // Fetch users with role 'karyawan' and apply search filter
    $users = User::query()
        ->where('role', 'karyawan') // Filter users with role 'karyawan'
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%') // Search by name
                  ->orWhere('email', 'like', '%' . $search . '%') // Search by email
                  ->orWhere('id_member', 'like', '%' . $search . '%'); // Search by member ID (if available)
            });
        })
        ->orderBy('name', 'asc') // Sort by name
        ->paginate(10); // Pagination with 10 users per page

    // Return the view with filtered users and search term
    return view('pages-admin.manajemen-karyawan', compact('users', 'search'));
}

public function indexmanajemenlaporan(Request $request)
{
    // Retrieve the search input from the request
    $search = $request->input('search');

    // Fetch orders and apply search filter
    $orders = Pemesanan::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%') // Search by user name
                              ->orWhere('id_member', 'like', '%' . $search . '%'); // Search by user ID member
                })
                ->orWhereHas('layanan', function ($layananQuery) use ($search) {
                    $layananQuery->where('nama_layanan', 'like', '%' . $search . '%'); // Search by layanan name
                })
                ->orWhere('tanggal', 'like', '%' . $search . '%') // Search by date
                ->orWhere('metode_pembayaran', 'like', '%' . $search . '%') // Search by payment method
                ->orWhere('status', 'like', '%' . $search . '%'); // Search by status
            });
        })
        ->orderBy('tanggal', 'desc') // Sort by date
        ->paginate(10); // Pagination with 10 results per page

    // Return the view with filtered orders and search term
    return view('pages-admin.laporan', compact('orders', 'search'));
}


    public function ulasanpengguna()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $ulasan = Ulasan::paginate(4); // Menampilkan 4 komentar per halaman
        return view('pages-admin.ulasan-pengguna', compact('ulasan'));
    }

    public function showUlasan()
    {
        // Ambil data ulasan beserta data pengguna yang memberi ulasan
        $ulasan = Ulasan::with('user')->get();

        // Kirim data ulasan ke view
        return view('admin.ulasan', compact('ulasan'));
    }

    public function show()
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('pages-admin.profile-admin', compact('user')); // Tampilkan profil
    }
    
    public function edit()
    {
        $user = auth()->user(); // Ambil data pengguna
        return view('pages-admin.edit-profile', compact('user')); // Tampilkan form edit
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

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Menampilkan halaman tambah pemesanan
    public function showAddOrderForm()
    {
        return view('admin.tambah-pemesanan');
    }

    // Menyimpan data pemesanan
    public function storeOrder(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'id_pemesanan' => 'required|string|max:255',
            'jenis_layanan' => 'required|string',
            'tanggal_pesan' => 'required|date',
            'waktu_pesan' => 'required|date_format:H:i',
            'metode_pembayaran' => 'required|string',
            'status_pemesanan' => 'required|string',
        ]);

        // Simpan data pemesanan ke database (misal menggunakan model Pemesanan)
        // Misalnya:
        // Pemesanan::create($request->all());

        // Redirect ke halaman data pemesanan atau halaman lain
        return redirect()->route('data-pemesanan')->with('success', 'Pemesanan berhasil ditambahkan');
    }
}

