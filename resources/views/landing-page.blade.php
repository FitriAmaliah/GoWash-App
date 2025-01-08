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
            <!-- Container with white circle background for the logo -->
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center">
                <!-- Perbesar ukuran logo tanpa mengubah background -->
                <img src="/assets/logo-aplikasi.png" alt="Logo" class="w-10 h-10 rounded-full">
            </div>
            <span class="ml-4">GoWash</span> <!-- Add margin to the left of the text -->
        </a>

        <!-- Hamburger Button for Mobile View -->
        <button id="hamburger" class="block md:hidden text-white focus:outline-none">
            <i class="fas fa-bars text-4xl"></i> <!-- Hamburger icon -->
        </button>
        <!-- Navbar Links for Desktop View -->
        <ul id="navbar-links" class="hidden md:flex space-x-8 justify-center w-full">
            <li><a href="#beranda" class="text-white font-bold" onclick="setActive(this)">Beranda</a></li>
            <li><a href="#tentang" class="text-white font-bold" onclick="setActive(this)">Tentang</a></li>
            <li><a href="#fitur" class="text-white font-bold" onclick="setActive(this)">Fitur</a></li>
            <li><a href="#ulasan" class="text-white font-bold" onclick="setActive(this)">Ulasan</a></li>
            <li><a href="#kontak" class="text-white font-bold" onclick="setActive(this)">Kontak</a></li>
        </ul>
        </ul>
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('login') }}" 
               class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition duration-300 flex items-center space-x-2">
                <!-- Ikon dengan warna hijau -->
                <i class="fa-solid fa-right-to-bracket text-green-500"></i>
                <span>Login</span>
            </a>
            </div>
        </ul>
    </div>

<!-- Mobile Navbar Links (Initially Hidden) -->
<ul id="mobile-menu" class="md:hidden hidden flex-col space-y-2 mt-4 absolute top-16 left-0 w-full bg-indigo-500 p-4 bg-opacity-90 shadow-lg">
    <li><a href="#beranda" class="text-white font-bold" onclick="setActive(this)">Beranda</a></li>
    <li><a href="#tentang" class="text-white font-bold" onclick="setActive(this)">Tentang</a></li>
    <li><a href="#fitur" class="text-white font-bold" onclick="setActive(this)">Fitur</a></li>
    <li><a href="#ulasan" class="text-white font-bold" onclick="setActive(this)">Ulasan</a></li>
    <li><a href="#kontak" class="text-white font-bold" onclick="setActive(this)">Kontak</a></li>
    
<!-- Tombol Login -->
<li class="mt-4 flex justify-start">
    <a href="{{ route('login') }}" 
       class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition duration-300 text-center w-auto flex items-center space-x-2">
        <!-- Ikon dengan warna hijau -->
        <i class="fa-solid fa-right-to-bracket text-green-500"></i>
        <span>Login</span>
    </a>
</li>
</ul>
</nav>

<!-- Beranda Section -->
<section id="beranda" class="relative bg-indigo-100 text-black flex items-center justify-center min-h-screen pt-20 md:pt-0" data-aos="fade-up">
    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between container mx-auto px-4">
        <!-- Image Section (Top on Mobile) -->
        <div class="w-full md:w-1/2 mb-6 md:mb-0 order-first md:order-last" data-aos="zoom-in" data-aos-delay="200">
            <div class="col-lg-6 col-md-12 home-img">
                <img src="/assets/logo-beranda.png" alt="Layanan Cuci Motor & Mobil" class="img-fluid animate-float">
            </div>
        </div>

        <!-- Text Section (Bottom on Mobile) -->
        <div class="w-full md:w-1/2 text-center md:text-left">
            <!-- Judul -->
            <h1 class="text-4xl md:text-5xl font-bold mb-4 font-poppins leading-snug tracking-wide text-gray-700">
                Layanan Cuci Motor & Mobil Terbaik
            </h1>

            <!-- Paragraf -->
            <p class="text-lg md:text-xl mb-6 font-poppins leading-relaxed text-gray-700 max-w-lg mx-auto md:mx-0">
                Nikmati kendaraan Anda yang selalu bersih, berkilau, dan terawat dengan layanan cuci motor dan mobil GoWash yang cepat, efisien, dan ramah lingkungan. Kami siap memberikan pelayanan terbaik agar kendaraan Anda tetap tampil sempurna setiap saat.
            </p>

            <!-- Tombol -->
            <!--  <a href="http://127.0.0.1:8000/login" 
               class="bg-indigo-500 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-indigo-600 transition duration-300 font-poppins text-base md:text-lg">
                Mulai Sekarang
            </a>
        </div>
    </div>-->
</section>


<!-- Tentang Section -->
<section id="tentang" class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-indigo-500">TENTANG</h2>
            <div class="border-b-4 border-indigo-400 w-20 mx-auto my-2"></div>
        </div>
        <div class="md:flex">
            <div class="md:w-1/2 md:pr-8">
                <p class="mb-4">GoWash adalah aplikasi inovatif yang dirancang untuk mempermudah pengguna dalam memesan layanan cuci motor dan mobil secara praktis dan efisien.</p>
                <ul class="list-inside list-disc">
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                        Layanan pencucian mobil dan motor cepat dan efisien
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                        Tersedia berbagai paket cuci sesuai kebutuhan
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                        Teknologi cuci otomatis yang ramah lingkungan
                    </li>
                </ul>          
            </div>
            <div class="md:w-1/2 mt-8 md:mt-0">
                <p class="mb-4">Melalui antarmuka yang ramah pengguna, GoWash menawarkan berbagai pilihan layanan cuci kendaraan, mulai dari cuci standar hingga detailing lengkap.</p>
                <a href="http://127.0.0.1:8000/login" class="bg-blue-500 text-white py-2 px-4 rounded-full">Mulai Sekarang</a>
            </div>
        </div>
    </div>
</section>

<!-- Fitur Section -->
<section id="fitur" class="py-16 bg-indigo-100" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-indigo-500">FITUR UNGGULAN</h2>
            <div class="border-b-4 border-indigo-400 w-20 mx-auto my-2"></div>
        </div>
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <!-- Pemesanan Mudah -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
                <div class="flex justify-center items-center mb-4">
                    <img width="100" height="100" src="https://img.icons8.com/clouds/100/mobile-shopping-bag.png" alt="mobile-shopping-bag"/>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pemesanan Mudah</h3>
                <p>Pesan layanan dengan mudah dan cepat langsung melalui aplikasi, dengan antarmuka yang ramah pengguna dan intuitif.</p>
            </div>

           <!-- Jadwal Tetap -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
                <!-- Membuat gambar di tengah -->
                <div class="flex justify-center items-center mb-4">
                    <img width="100" height="100" src="https://img.icons8.com/clouds/100/calendar--v1.png" alt="calendar--v1"/>
                </div>
                <h3 class="text-xl font-semibold mb-2">Jadwal Tetap</h3>
                <p>Semua layanan tersedia pada jadwal yang telah ditentukan, memberikan kenyamanan tanpa perlu khawatir mengatur waktu sendiri.</p>
            </div>

            <!-- Pembayaran Aman -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center">
                <div class="flex justify-center items-center mb-4">
                    <img width="100" height="100" src="https://img.icons8.com/clouds/100/lock-2.png" alt="lock-2"/>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                <p>Beragam metode pembayaran yang aman dan terjamin, memberikan kenyamanan saat melakukan transaksi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Ulasan Section -->
<section id="ulasan" class="py-16 bg-white" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-indigo-500">ULASAN PENGGUNA</h2>
            <div class="border-b-4 border-indigo-400 w-20 mx-auto my-2"></div>
        </div>

        <!-- Wrapper untuk animasi scroll -->
        <div class="overflow-hidden relative">
            <!-- Container untuk slide ulasan dengan animasi bergerak ke kanan -->
            <div id="ulasan-container" class="flex space-x-6 animate-scroll-gear select-none">
                <!-- Loop Data Ulasan -->
                @forelse ($ulasan as $item)
                    <div id="ulasan-{{ $item->id }}" 
                        class="bg-white shadow-md rounded-lg p-4 hover:shadow-lg transition duration-300 ease-in-out transform hover:bg-gray-50 w-72 flex-shrink-0 snap-center">
                        <!-- Profil Pengguna -->
                        <div class="flex items-center mb-3">
                            <img 
                                src="{{ $item->profile_picture ? asset('storage/' . $item->profile_picture) : '/assets/profile.png' }}" 
                                alt="Foto Profil" 
                                class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <h3 class="font-semibold text-base text-gray-800">{{ $item->nama_pengguna }}</h3>
                                <span class="text-gray-500 text-xs">{{ $item->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                        <!-- Rating Bintang -->
                        <div class="flex items-center mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="text-lg {{ $i <= $item->rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                        <!-- Komentar -->
                        <p class="text-gray-600 text-sm mb-4">{{ $item->komentar }}</p>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-2">Belum ada ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Kontak Section -->
<section id="kontak" class="py-16 bg-indigo-100" data-aos="fade-up">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-indigo-500">KONTAK</h2>
            <div class="border-b-4 border-indigo-400 w-20 mx-auto my-2"></div>
        </div>
        <!-- Informasi Kontak di Tengah -->
        <div class="flex justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg">
                <h3 class="text-2xl font-semibold text-indigo-500">Informasi Kontak</h3>
                <p class="text-gray-600 mb-4">Silakan hubungi kami melalui informasi di bawah ini untuk pertanyaan lebih lanjut.</p>
                
                <!-- Email dengan Icon -->
                <div class="mb-4 flex items-center">
                    <i class="fas fa-envelope text-indigo-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-lg font-medium text-gray-800">Email:</p>
                        <p class="text-gray-600">gowash@gmail.com</p>
                    </div>
                </div>

                <!-- WhatsApp dengan Icon -->
                <div class="flex items-center">
                    <i class="fab fa-whatsapp text-green-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-lg font-medium text-gray-800">WhatsApp:</p>
                        <p class="text-gray-600">+62 895 0641 8632</p>
                    </div>
                </div>
            </div>
        </div>
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
       // Inisialisasi AOS (Animasi saat scroll)
       AOS.init({ duration: 1000, once: false });

// Autoscroll JavaScript untuk efek scroll otomatis
let scrollContainer = document.querySelector('.animate-scroll');
let scrollAmount = 0;

function autoScroll() {
    if (scrollAmount <= scrollContainer.scrollWidth) {
        scrollContainer.scrollLeft = scrollAmount;
        scrollAmount += 1;
    } else {
        scrollAmount = 0;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const ulasanContainer = document.getElementById('ulasan-container');
    
    // Membuat animasi scroll ke kanan
    ulasanContainer.classList.add('animate-scroll');
  });

  const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobile-menu');
    
    hamburger.addEventListener('click', () => {
        // Toggle visibility of the mobile menu
        mobileMenu.classList.toggle('hidden');
    });

    function setActive(element) {
        // Menghapus kelas aktif dari semua tautan
        const links = document.querySelectorAll('#mobile-menu a');
        links.forEach(link => link.classList.remove('border-b-2', 'border-white'));

        // Menambahkan garis bawah pada elemen yang diklik
        element.classList.add('border-b-2', 'border-white');
    }

    function setActive(element) {
    // Menghapus kelas 'active' dari semua link
    let links = document.querySelectorAll('#navbar-links a');
    links.forEach(link => {
        link.classList.remove('active');
    });

    // Menambahkan kelas 'active' ke link yang diklik
    element.classList.add('active');
}

// Smooth scroll with offset

// Mengatur jarak untuk menghindari navbar menutupi konten
document.documentElement.style.setProperty('--navbar-height', `${document.querySelector('nav').offsetHeight}px`);
document.body.style.paddingTop = getComputedStyle(document.documentElement).getPropertyValue('--navbar-height');

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();

    const targetId = this.getAttribute('href');
    const targetElement = document.querySelector(targetId);

    if (targetElement) {
      const navbarHeight = document.querySelector('nav').offsetHeight;
      const adjustment = 5; // Koreksi kecil
      const elementPosition = targetElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - navbarHeight - adjustment;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    }
  });
});



</script>

<!-- Tambahkan custom animation pada Tailwind -->
<style>
  @layer utilities {
    @keyframes scroll-right {
      0% { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }

    .animate-scroll {
      animation: scroll-right 20s linear infinite;
    }
  }

  @keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}
  </style>

</body>
</html>
