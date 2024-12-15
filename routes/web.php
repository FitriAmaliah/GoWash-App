<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananTersediaController;
use App\Http\Controllers\ManajemenPenggunaController;
use App\Http\Controllers\ManajemenKaryawanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PemesananController;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', function () {
    return view('logout');
})->name('logout');

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi');

// Route untuk halaman landing page
Route::get('/landing-page', function () {
    return view('landing-page');
});

Route::get('layouts/layout', function () {
return view('layouts.layout');
})->name('layouts/layout');

Route::get('/pages-admin.dashboard-admin', function () {
    return view('pages-admin.dashboard-admin');
})->name('pages-admin.dashboard-admin');

Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('pages-admin.dashboard-admin');

Route::get('/pages-admin.data-layanan', function () {
    return view('pages-admin.data-layanan');
})->name('pages-admin.data-layanan');

Route::get('/pages-admin.profile-admin', function () {
    return view('pages-admin.profile-admin');
})->name('pages-admin.profile-admin');

Route::get('/pages-admin.edit-profile', function () {
    return view('pages-admin.edit-profile');
})->name('pages-admin.edit-profile');

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk handle login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Show the password reset request form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Handle the password reset link request
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

//tampilan route role admin
Route::get('/pages-admin/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');
Route::get('/pages-admin/profile-admin', [AdminController::class, 'profile'])->name('profile.admin');
Route::get('/pages-admin/edit-profile', [AdminController::class, 'editprofile'])->name('edit.profile');

Route::get('/pages-admin/data-layanan', [AdminController::class, 'datalayanan'])->name('data.layanan');
Route::get('/pages-admin/data-layanan', [LayananController::class, 'index'])->name('pages-admin.data-layanan');
Route::get('/pages-admin/tambah-layanan', [AdminController::class, 'tambahlayanan'])->name('tambah.layanan');
Route::get('/pages-admin/data-pemesanan', [AdminController::class, 'datapemesanan'])->name('data.pemesanan');
Route::get('/pages-admin/tambah-pemesanan', [AdminController::class, 'tambahpemesanan'])->name('tambah.pemesanan');
Route::get('/pages-admin/edit-pemesanan/{id}', [AdminController::class, 'editpemesanan'])->name('edit.pemesanan');
Route::put('/pages-admin/update-pemesanan/{id}', [AdminController::class, 'updatepemesanan'])->name('update.pemesanan');

Route::get('/pages-admin/data-transaksi', [AdminController::class, 'datatransaksi'])->name('data.transaksi');
Route::get('/pages-admin/tambah-transaksi', [AdminController::class, 'tambahtransaksi'])->name('tambah.transaksi');
Route::get('/pages-admin/edit-transaksi', [AdminController::class, 'edittransaksi'])->name('edit.transaksi');

Route::get('/pages-admin/manajemen-karyawan', [AdminController::class, 'manajemenkaryawan'])->name('manajemen.karyawan');
Route::get('/pages-admin/tambah-karyawan', [AdminController::class, 'tambahkaryawan'])->name('tambah.karyawan');
Route::get('/pages-admin/edit-karyawan', [AdminController::class, 'editkaryawan'])->name('edit.karyawan');
Route::get('/pages-admin/manajemen-pengguna', [AdminController::class, 'manajemenpengguna'])->name('manajemen.pengguna');
Route::get('/pages-admin/tambah-pengguna', [AdminController::class, 'tambahpengguna'])->name('tambah.pengguna');
Route::get('/pages-admin/edit-pengguna/{id}', [AdminController::class, 'editpengguna'])->name('edit.pengguna');

Route::get('/pages-admin/data-pelanggan', [AdminController::class, 'datapelanggan'])->name('data.pelanggan');
Route::get('/pages-admin/tambah-pelanggan', [AdminController::class, 'tambahpelanggan'])->name('tambah.pelanggan');
Route::get('/pages-admin/laporan', [AdminController::class, 'laporan'])->name('laporan');

Route::get('/pages-admin/edit-layanan', [AdminController::class, 'editlayanan'])->name('edit.layanan');
Route::get('/pages-admin/print-layanan', [AdminController::class, 'printlayanan'])->name('print.layanan');
Route::get('/pages-admin/ulasan-pengguna', [AdminController::class, 'ulasanpengguna'])->name('ulasan.pengguna');
Route::get('/pages-admin/pendapatan', [AdminController::class, 'pendapatan'])->name('pendapatan');


//ROUTE UNTUK BAGIAN DATABASE ADMIN

//rote data layanan
Route::get('/tambah-layanan', [LayananController::class, 'create'])->name('tambah-layanan');
// Menyimpan data layanan baru
Route::post('/tambah-layanan', [LayananController::class, 'store']);
// Menampilkan data layanan
Route::get('/data-layanan', [LayananController::class, 'index'])->name('data-layanan');
//Menampilkan 
Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('update.layanan');

Route::get('pages-admin/{id}/edit', [LayananController::class, 'edit'])->name('edit.layanan');
Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('update.layanan');

// Rute untuk menghapus layanan
Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');


// route manajemen pengguna

// Route untuk menampilkan halaman manajemen pengguna
Route::get('/manajemen-pengguna', [ManajemenPenggunaController::class, 'index'])->name('manajemen-pengguna');

// Route untuk menampilkan form tambah pengguna
Route::get('/tambah-pengguna', [ManajemenPenggunaController::class, 'create'])->name('tambah-pengguna');

// Route untuk menyimpan pengguna baru
Route::post('/tambah-pengguna', [ManajemenPenggunaController::class, 'store'])->name('tambah-pengguna.store');

// Route untuk menghapus pengguna
Route::delete('/hapus-pengguna/{id}', [ManajemenKaryawanController::class, 'destroy'])->name('hapus.pengguna');


// rote data transaksi 
Route::post('/transaksi/store', [AdminController::class, 'store'])->name('store-transaksi');


// route untuk manajemen karyawan

// Route untuk menampilkan halaman manajemen karyawan
Route::get('/manajemen-karyawan', [ManajemenKaryawanController::class, 'index'])->name('manajemen-karyawan');

// Route untuk menampilkan form tambah karyawan
Route::get('/tambah-karyawan', [ManajemenKaryawanController::class, 'create'])->name('tambah-karyawan');

// Route untuk menyimpan karyawan baru
Route::post('/tambah-karyawan', [ManajemenKaryawanController::class, 'store'])->name('tambah-karyawan.store');

// Route untuk menghapus karyawan
Route::delete('/karyawan/{id}', [ManajemenKaryawanController::class, 'destroy'])->name('hapus.pengguna');

// route untuk tampilan profile admin
Route::get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile'); // Untuk menampilkan profile
Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit'); // Untuk form edit
Route::match(['PUT', 'PATCH'], '/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');

// route untuk tampilan profile user

Route::get('/user/profile', [UserController::class, 'show'])->name('profil.user');
Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('user.profile.update');

// route untuk tampilan profile karyawan

Route::get('/karyawan/profile', [KaryawanController::class, 'show'])->name('karyawan.user');
Route::get('/karyawan/profile/edit', [KaryawanController::class, 'edit'])->name('karyawan.profile.edit');
Route::put('/karyawan/profile/', [KaryawanController::class, 'update'])->name('karyawan.profile.update');
Route::post('/orders/{id}/status', [KaryawanController::class, 'updateOrderStatus'])->name('orders.updateStatus');
Route::post('/orders/{id}/set-selesai', [KaryawanController::class, 'setOrderToSelesai'])->name('orders.setSelesai');
// Halaman riwayat pengerjaan
Route::get('/riwayat-pengerjaan', [KaryawanController::class, 'index'])->name('riwayat.pengerjaan');


// Route to handle saving the profile
Route::middleware(['auth'])->group(function () {
    Route::get('/edit-profile', [UserController::class, 'edit'])->name('edit-profile');
    Route::post('/save-profile', [UserController::class, 'saveProfile'])->name('save-profile');
});

// route print struck layanan dan laporan
Route::get('print-receipt/{id}', [AdminController::class, 'printReceipt'])->name('print-receipt');
Route::get('/laporan/cetak-pdf', [AdminController::class, 'cetakPdf'])->name('laporan.cetak-pdf');

// route filter tanggal laporan
Route::get('/laporan/filter', [AdminController::class, 'filter'])->name('laporan.filter');

//tampilan route role user
Route::get('/pages-user/dashboard-user', [UserController::class, 'dashboard'])->name('dashboard.user');
Route::get('/pages-user/status-pemesanan', [UserController::class, 'statuspemesanan'])->name('status.pemesanan');
Route::get('/pages-user/layanan-tersedia', [UserController::class, 'layanantersedia'])->name('layanan.tersedia');
Route::get('/pages-user/riwayat-pemesanan', [UserController::class, 'riwayatpemesanan'])->name('riwayat.pemesanan');
Route::get('/pages-user/profil-user', [UserController::class, 'profiluser'])->name('profil.user');
Route::get('/pages-user/edit-profil', [UserController::class, 'editprofil'])->name('edit.profil');
Route::get('/pages-user/ulasan', [UserController::class, 'ulasan'])->name('ulasan');
Route::get('/pages-user/tulis-ulasan', [UserController::class, 'tulisulasan'])->name('tulis.ulasan');
Route::get('/pages-user/form-pemesanan/{layananId}', [UserController::class, 'formpemesanan'])->name('form.pemesanan');
Route::get('/pages-user/pemesanan-pelanggan/{layananId}', [UserController::class, 'pemesananpelanggan'])->name('pemesanan.pelanggan');
Route::post('/checkout', [UserController::class, 'checkout'])->name('checkout');
Route::post('/payment/success', [UserController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/pages-user/pelanggan', [UserController::class, 'pelanggan'])->name('pelanggan');

// route ulasan user
Route::get('/ulasan', [UserController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UserController::class, 'ulasanStore'])->name('ulasan.store');
Route::put('/ulasan/{id}', [UlasanController::class, 'updateulasan'])->name('ulasan.update');
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

// route pemesanan
Route::get('/pemesanan/{id}', [PemesananController::class, 'create'])->name('pages-user.form-pemesanan');
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::post('/orders/update-status/{order}', [PemesananController::class, 'updateStatus'])->name('orders.updateStatus');
// routes/web.php atau routes/api.php
Route::post('/update-payment-status', [PemesananController::class, 'updatePaymentStatus'])->name('update.payment.status');
Route::get('/tambah-pemesanan', [AdminController::class, 'showAddOrderForm'])->name('tambah-pemesanan');
Route::post('/tambah-pemesanan', [AdminController::class, 'storeOrder'])->name('store-pemesanan');

//tampilan route role karyawan
Route::get('/pages-karyawan/dashboard-karyawan', [KaryawanController::class, 'dashboard'])->name('dashboard.karyawan');
Route::get('/pages-karyawan/tugas-harian', [KaryawanController::class, 'tugasharian'])->name('tugas.harian');
Route::get('/pages-karyawan/update-status', [KaryawanController::class, 'updatestatus'])->name('update.status');
Route::get('/pages-karyawan/detail-pesanan', [KaryawanController::class, 'detailpesanan'])->name('detail.pesanan');
Route::get('/pages-karyawan/riwayat-pengerjaan', [KaryawanController::class, 'riwayatpengerjaan'])->name('riwayat.pengerjaan');
Route::get('/pages-karyawan/profil-karyawan', [KaryawanController::class, 'profilkaryawan'])->name('profil.karyawan');
Route::get('/pages-karyawan/edit-profil', [KaryawanController::class, 'editprofil'])->name('edit.profil');
Route::get('/pages-karyawan/ulasan-pengguna', [KaryawanController::class, 'ulasanpengguna'])->name('ulasan.pengguna');


