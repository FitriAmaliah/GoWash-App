<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ulasan;
use App\Models\Layanan;
use App\Models\Pemesanan;
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

    public function printlayanan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(15); // Menampilkan 4 komentar per halaman
        return view('pages-admin.print-layanan', compact('orders'));
    }

    public function printReceipt($id)
    {
        // Retrieve the order by ID
        $orders = Pemesanan::find($id);

        // If the order is not found, you can handle it accordingly
        if (!$orders) {
            return abort(404, 'Order not found');
        }

        // Generate the PDF and pass the order data to the view
        $pdf = Pdf::loadView('print.print-layanan', compact('orders'));

        // Return the PDF as a download
        return $pdf->download("struk-pembelian-{$id}.pdf");
    }

    public function cetakPdf(Request $request)
    {
        // Ambil data order untuk laporan
        $orders = Pemesanan::all(); // Atau sesuaikan dengan data yang diperlukan

        // Memasukkan data ke view untuk PDF
        $pdf = PDF::loadView('print.print-laporan', compact('orders'));

        // Menghasilkan file PDF dan mendownloadnya
        return $pdf->download('laporan-transaksi.pdf');
    }

        public function filter(Request $request)
    {
        $startDate = $request->get('start_date');
        $orders = Pemesanan::whereDate('tanggal', '>=', $startDate)->get(); // Sesuaikan dengan logika filter

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
        return view('pages-admin.tambah-transaksi'); // Profile view
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

    public function laporan()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $orders = Pemesanan::paginate(10); // Menampilkan 4 komentar per halaman
        return view('pages-admin.laporan', compact('orders'));
    }

    public function ulasanpengguna()
    {
        // Mengambil ulasan dengan pagination, menampilkan 4 komentar per halaman
        $ulasan = Ulasan::paginate(2); // Menampilkan 4 komentar per halaman
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
        return view('pages-admin.edit.profile', compact('user')); // Tampilkan form edit
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

