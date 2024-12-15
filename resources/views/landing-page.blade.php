<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - GoWash</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-indigo-600 shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a href="#" class="flex items-center text-white text-2xl font-bold">
            <img src="/assets/logo.jpg" alt="Logo" class="w-10 h-10 rounded-full mr-3">
            GoWash
        </a>
        <div class="hidden md:flex justify-center space-x-6">
            <a href="#beranda" class="text-white hover:text-gray-100 transition">Beranda</a>
            <a href="#tentang" class="text-white hover:text-gray-100 transition">Tentang</a>
            <a href="#fitur" class="text-white hover:text-gray-100 transition">Layanan</a>
            <a href="#kontak" class="text-white hover:text-gray-100 transition">Kontak</a>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('login') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-full font-semibold shadow-md hover:bg-gray-100 transition duration-300">Login</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-full font-semibold shadow-md hover:bg-green-600 transition duration-300">Chat on WhatsApp</a>
        </div>
    </div>
</nav>

<!-- Beranda Section -->
<section id="beranda" class="relative bg-cover bg-center text-white flex items-center justify-center" style="background-image: url('/assets/bg-lp.jpeg'); min-height: 600px;" data-aos="fade-up">
    <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
    <div class="relative z-10 text-center">
        <h2 class="text-5xl font-bold mb-4">Layanan Cuci Motor & Mobil Terbaik</h2>
        <p class="text-lg mb-6">Nikmati kendaraan yang bersih dan berkilau dengan layanan GoWash.</p>
        <a href="#tentang" class="bg-indigo-500 text-white px-6 py-3 rounded-full font-semibold shadow-md hover:bg-indigo-600 transition">Mulai Sekarang</a>
    </div>
</section>

<!-- Tentang Section -->
<section id="tentang" class="py-20 bg-white" data-aos="fade-up">
    <div class="container mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-indigo-500">Tentang Kami</h2>
            <p class="text-gray-600 mt-4">
                GoWash adalah aplikasi booking layanan cuci motor dan mobil yang memudahkan pengguna untuk mendapatkan kendaraan bersih dan berkilau kapan saja dan di mana saja. Dengan GoWash, pengguna dapat memilih berbagai layanan cuci, dari cuci standar hingga detailing lengkap, sesuai kebutuhan mereka.
                </p>
        </div>
    </div>
</section>

<!-- Fitur Utama Section -->
<section id="fitur" class="w-full py-10 bg-indigo-50" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center mb-2 text-indigo-500">Fitur Utama Aplikasi</h2>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
        <!-- Pemesanan Mudah -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
            <div class="text-indigo-500 mb-4">
                <svg class="w-12 h-12 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7M5 7h4a3 3 0 003-3v0a3 3 0 013-3h3" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Pemesanan Mudah</h3>
            <p>Pesan layanan langsung dari aplikasi dengan antarmuka yang intuitif.</p>
        </div>

        <!-- Jadwal Fleksibel -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
            <div class="text-indigo-500 mb-4">
                <svg class="w-12 h-12 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8M8 17h8M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Jadwal Fleksibel</h3>
            <p>Atur waktu layanan sesuai kebutuhan Anda dengan fitur kalender yang mudah.</p>
        </div>

        <!-- Pembayaran Aman -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
            <div class="text-indigo-500 mb-4">
                <svg class="w-12 h-12 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2m-1 11h10a2 2 0 002-2v-6a2 2 0 00-2-2h-10a2 2 0 00-2 2v6a2 2 0 002 2zm3-7h4" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
            <p>Dukungan berbagai metode pembayaran dengan keamanan terjamin.</p>
        </div>
    </div>
</section>



<!-- Kontak Section -->
<section id="kontak" class="container mx-auto py-20 bg-white" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center mb-10 text-indigo-500">Hubungi Kami</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <!-- Informasi Kontak -->
        <div class="space-y-6">
            <h3 class="text-2xl font-semibold text-indigo-500">Informasi Kontak</h3>
            <p class="text-gray-600">Silakan hubungi kami melalui informasi di bawah ini untuk pertanyaan lebih lanjut.</p>
            <div>
                <p class="text-lg font-medium text-gray-800">Alamat:</p>
                <p class="text-gray-600">Jl. Kebersihan No. 10, Jakarta</p>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-800">Email:</p>
                <p class="text-gray-600">info@washgo.com</p>
            </div>
            <div>
                <p class="text-lg font-medium text-gray-800">Telepon:</p>
                <p class="text-gray-600">+62 123 456 789</p>
            </div>
        </div>

        <!-- Form Kontak -->
        <form class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" class="w-full border rounded-md px-4 py-2 focus:ring-indigo-300 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" class="w-full border rounded-md px-4 py-2 focus:ring-indigo-300 focus:border-indigo-500">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea id="message" class="w-full border rounded-md px-4 py-2 focus:ring-indigo-300 focus:border-indigo-500"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded-md font-semibold hover:bg-indigo-600 transition">Kirim Pesan</button>
        </form>
    </div>
</section>


<!-- Footer -->
<footer class="bg-indigo-600 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2024 GoWash. Semua Hak Dilindungi.</p>
    </div>
</footer>

<!-- AOS Script -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: false });
</script>
</body>
</html>
