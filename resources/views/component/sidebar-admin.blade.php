<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Navbar -->
<nav class="bg-indigo-500 p-4 shadow-md relative fixed w-full z-10 top-0 left-0">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Hamburger Icon for Mobile (Left side) -->
        <div class="block lg:hidden">
            <button class="text-white" id="hamburger-icon" onclick="toggleNavbar()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
    <!-- Logo and Profile Dropdown (Right side) -->
    <div class="relative flex items-center">
        <!-- Foto Profil (Hanya tampil di layar desktop dan lebih besar) -->
         <!-- <img 
            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}" 
            alt="Foto Profil" 
            class="w-10 h-10 rounded-full mr-3 hidden sm:block"> <!-- Foto hanya muncul di layar sm dan lebih besar -->
    </div>

<!-- Dropdown Menu (Visible on all screen sizes) -->
<div class="relative block">
    <button 
        class="flex items-center text-white focus:outline-none" 
        onclick="ProfileDropdown(event)">
        <img 
            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}" 
            alt="Foto Profil" 
            class="w-10 h-10 rounded-full mr-3">
        
        <!-- Nama Pengguna (Tampil di mobile dan desktop) -->
        <span class="block text-white sm:inline-block">{{ Auth::user()->name }}</span>
        
        <!-- Tanda Panah (Tampil di mobile dan desktop) -->
        <i class="fas fa-chevron-down ml-2" id="arrow-icon"></i>
    </button>
    
    <!-- Dropdown Menu (Tampil setelah tombol dropdown diklik) -->
    <div 
        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden" 
        id="dropdown-menu">
        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Profil Saya</a>
        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Edit Profile</a>
    </div>
</div>
</nav>

  <!-- Sidebar -->
  <div class="flex min-h-screen">
    <aside id="sidebar" class="w-64 bg-indigo-400 p-6 fixed left-0 top-0 h-full z-20 shadow-lg transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 overflow-y-auto" aria-hidden="true">
        <button id="close-sidebar" class="text-white absolute top-4 right-4 lg:hidden" onclick="closeSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Profile and Title Section -->
        <div class="flex flex-col items-center mb-6">
            <div class="bg-white rounded-full p-1">
                <img src="/assets/logo-aplikasi.png" alt="Profile Photo" class="w-24 h-24 rounded-full border-4 border-white">
            </div>                    
            <p class="text-white font-semibold text-lg text-center">GoWash</p>
        </div>  
        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard.admin') }}" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                        <g fill="#ffffff">
                            <g transform="scale(10.66667,10.66667)">
                                <path d="M12,2.09961l-11,9.90039h3v9h7v-6h2v6h7v-9h3zM12,4.79102l6,5.40039v0.80859v8h-3v-6h-6v6h-3v-8.80859z"></path>
                            </g>
                        </g>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Dropdown Menu for Data -->
            <li class="relative">
                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded" onclick="toggleSidebarDropdown(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                    <span>Data</span>
                    <svg class="w-4 h-4 ml-2" fill="white" viewBox="0 0 20 20">
                        <path d="M7 10l5 5 5-5H7z"/>
                    </svg>
                </a>
                <div id="sidebarDropdown" class="left-0 hidden mt-1 w-48 bg-indigo-500 text-white rounded-md shadow-lg z-10">
                    <div class="py-1" role="none">
                        <a href="{{ route('data-layanan') }}" class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <p>Data Layanan</p>
                        </a>
                        <a href="{{ route('data.transaksi') }}"  class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <p>Data Transaksi</p>
                        </a>
                        <a href="{{ route('data.pemesanan') }}"  class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <p>Data Pemesanan</p>
                        </a>
                        <a href="{{ route('data.pelanggan') }}"  class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <p>Data Pelanggan</p>
                        </a>
                    </div>
                </div>
            </li>

                <li class="relative">
                    <a href="#" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded" onclick="toggleDropdown(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <span>Manajemen</span>
                        <svg class="w-4 h-4 ml-2" fill="white" viewBox="0 0 20 20">
                            <path d="M7 10l5 5 5-5H7z"/>
                        </svg>
                    </a>
                    <div id="dropdownMenu" class="left-0 hidden mt-1 w-48 bg-indigo-500 text-white rounded-md shadow-lg z-10">
                        <div class="py-1" role="none">
                            <a href="{{ route('manajemen-pengguna') }}"  class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                  </svg>                                  
                                <p>Manajemen Pengguna</p>
                            </a>
                            <a href="{{ route('manajemen-karyawan') }}"  class="flex space-x-2 px-4 py-2 hover:bg-blue-600 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-6 h-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                  </svg>                                  
                                <p>Manajemen Karyawan</p>
                            </a>
                        </div>
                    </div>
                </li>
               <!-- <a href="pendapatan" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                      </svg>                                                                
                    <span>Pendapatan</span>
                </a>
            </li>
            <li> --> 
                <a href="{{ route('laporan') }}" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                      </svg>                                           
                    <span>Laporan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pages-admin.ulasan.pengguna') }}" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                      </svg>                                           
                    <span>Ulasan Pengguna</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <!-- Ikon Logout -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <path fill="#ff0000" d="M 11.5 6 C 8.48 6 6 8.48 6 11.5 L 6 36.5 C 6 39.52 8.48 42 11.5 42 
                        L 29.5 42 C 32.52 42 35 39.52 35 36.5 A 1.5 1.5 0 1 0 32 36.5 C 32 37.898 30.898 39 29.5 39 
                        L 11.5 39 C 10.102 39 9 37.898 9 36.5 L 9 11.5 C 9 10.102 10.102 9 11.5 9 L 29.5 9 C 30.898 9 
                        32 10.102 32 11.5 A 1.5 1.5 0 1 0 35 11.5 C 35 8.48 32.52 6 29.5 6 L 11.5 6 z M 33.484 15.484 
                        A 1.5 1.5 0 0 0 32.44 18.061 L 36.879 22.5 L 15.5 22.5 A 1.5 1.5 0 1 0 15.5 25.5 L 36.879 25.5 
                        L 32.44 29.94 A 1.5 1.5 0 1 0 34.561 32.061 L 41.561 25.061 A 1.5 1.5 0 0 0 41.561 22.94 L 34.561 
                        15.94 A 1.5 1.5 0 0 0 33.484 15.484 z"></path>
                    </svg>
                    <span>Logout</span>
                </a>
            
                <!-- Form Logout -->
                <form id="logout-form" action="{{ route('logout.admin') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <html class="overflow-x-hidden h-screen">
        <body class="overflow-x-hidden h-screen">
            <!-- Main Content -->
            <main class="flex-1 p-1 md:ml-60 mb-36 flex justify-center items-center">
                <div class="w-full max-w-5xl">
                    @yield('content')
                </div>
            </main>
        </body>
    </html>

<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
        <h2 class="text-lg text-center font-semibold mb-4">Konfirmasi Logout</h2>
        <p class="mb-6">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-center space-x-4">
            <button onclick="closeLogoutModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</button>
            <a href="{{ route('logout.admin') }}" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Logout</a>
        </div>
    </div>
</div>


    <!-- JavaScript sidebar-->
    <script>
                // sidebar //

        // Ambil elemen-elemen yang diperlukan
        const menuButton = document.getElementById('menu-button');
        const closeButton = document.getElementById('close-button');
        const sidebar = document.getElementById('sidebar');

        // Fungsi untuk menampilkan sidebar
        menuButton.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        // Fungsi untuk menyembunyikan sidebar
        closeButton.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });


            // logout //

        // Menampilkan popup saat tombol logout diklik
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('confirmationLogout').classList.remove('hidden');
        });

        // Mengonfirmasi logout
        document.getElementById('confirmLogout').addEventListener('click', function() {
            // Aksi penghapusan di sini (misalnya, mengirim request penghapusan ke server. kalau mau pakai respon server buka komentar code dibawah ini aja)
            // alert('Item dihapus');
            document.getElementById('confirmationLogout').classList.add('hidden');

            // Mengarahkan pengguna ke halaman landing page
            window.location.href = '/';
        });

        // Membatalkan logout
        document.getElementById('cancelLogout').addEventListener('click', function() {
            document.getElementById('confirmationLogout').classList.add('hidden');
        });

         // Toggle dropdown menu
document.querySelector('.relative button').addEventListener('click', function() {
document.getElementById('dropdown-menu').classList.toggle('hidden');
});

        function toggleDropdown(event) {
            event.preventDefault(); // Prevent the default link behavior
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('hidden'); // Toggle the visibility of the dropdown
        }
    
        // Optional: Close dropdown if clicked outside
        window.onclick = function(event) {
            const dropdown = document.getElementById('dropdownMenu');
            if (!event.target.closest('li')) {
                dropdown.classList.add('hidden'); // Hide dropdown if clicked outside
            }
        };
        
        function toggleDropdown(event) {
event.preventDefault();
const dropdownMenu = document.getElementById('dropdownMenu');
dropdownMenu.classList.toggle('hidden');
}

function searchTable() {
const input = document.getElementById("search-input").value.toLowerCase();
const tableBody = document.getElementById("table-body");
const rows = tableBody.getElementsByTagName("tr");

for (let i = 0; i < rows.length; i++) {
const row = rows[i];
const cells = row.getElementsByTagName("td");
let match = false;

for (let j = 0; j < cells.length; j++) {
    if (cells[j].innerText.toLowerCase().includes(input)) {
        match = true;
        break;
    }
}

row.style.display = match ? "" : "none";
}
}

function toggleDropdown(event) {
        event.preventDefault(); // Prevent the default link behavior
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden'); // Toggle the visibility of the dropdown
    }

    // Optional: Close dropdown if clicked outside
    window.onclick = function(event) {
        const dropdown = document.getElementById('dropdownMenu');
        if (!event.target.closest('li')) {
            dropdown.classList.add('hidden'); // Hide dropdown if clicked outside
        }
    };

    function toggleDropdown(event) {
     event.preventDefault();
    const dropdown = event.currentTarget.nextElementSibling;
    dropdown.classList.toggle('hidden');
        }

        function deleteData(button) {
// Ambil id data dari atribut data-id
const id = button.getAttribute("data-id");

// Konfirmasi penghapusan data
if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
// Lakukan permintaan fetch atau AJAX untuk menghapus data
fetch(`/delete/${id}`, {
    method: 'DELETE', // Menggunakan metode DELETE untuk menghapus
    headers: {
        'Content-Type': 'application/json'
    }
})
.then(response => {
    if (response.ok) {
        alert("Data berhasil dihapus.");
        // Menghapus elemen baris tabel yang berisi data ini
        button.closest("tr").remove();
    } else {
        alert("Gagal menghapus data.");
    }
})
.catch(error => {
    console.error("Terjadi kesalahan:", error);
    alert("Gagal menghapus data.");
});
}
}

function searchTable() {
// Get the search input value
const searchInput = document.getElementById("search-input").value.toLowerCase();

// Get the table and its rows
const table = document.getElementById("data-layanan");
const rows = table.getElementsByTagName("tr");

// Loop through all rows, except the first (header) row
for (let i = 1; i < rows.length; i++) {
const cells = rows[i].getElementsByTagName("td");
let found = false;

// Loop through each cell in the row
for (let j = 0; j < cells.length; j++) {
    const cell = cells[j];
    
    // If the cell contains the search term, mark the row as found
    if (cell.textContent.toLowerCase().includes(searchInput)) {
        found = true;
        break;
    }
}

// Show or hide the row based on the search result
if (found) {
    rows[i].style.display = "table-row";  // Correct way to show the row
} else {
    rows[i].style.display = "none";  // Hide the row
}
}
}


//toggle data

function toggleDropdown(event) {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.classList.toggle('hidden');
    }

    function toggleSidebarDropdown(event) {
        const sidebarDropdown = document.getElementById('sidebarDropdown');
        sidebarDropdown.classList.toggle('hidden');
    }


    //toggle manajemen 

    function toggleDropdown(event) {
        // Mencegah event default (contohnya, prevent klik ke <a> yang tidak diinginkan)
        event.preventDefault();
        
        // Ambil elemen dropdown
        const dropdownMenu = document.getElementById('dropdownMenu');
        
        // Toggle visibility (menyembunyikan/menampilkan dropdown)
        dropdownMenu.classList.toggle('hidden');
    }

    //toggle profile

    function ProfileDropdown(event) {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.classList.toggle('hidden'); // Toggle visibility
    }
    
    // Close dropdown if clicked outside
    window.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdown-menu');
        const button = event.target.closest('button');
        
        if (!button || !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden'); // Hide dropdown if clicked outside
        }
    });

    //toggle dropdown profile

    // Open Lihat Profile Modal
    function openViewProfile() {
        const modal = document.getElementById('view-profile-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Close Lihat Profile Modal
    function closeViewProfile() {
        const modal = document.getElementById('view-profile-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    //toggle tampilan mobile sidebar
// Function to toggle navbar visibility on mobile and handle icon changes
function toggleNavbar() {
    const sidebar = document.getElementById("sidebar");
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const closeSidebar = document.getElementById("close-sidebar");

    // Toggle the sidebar visibility
    sidebar.classList.toggle("-translate-x-full");
    sidebar.classList.toggle("translate-x-0");

    // Change hamburger icon to close icon (X) in navbar when sidebar is open
    if (sidebar.classList.contains("translate-x-0")) {
        hamburgerIcon.innerHTML = `
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        `;
    } else {
        hamburgerIcon.innerHTML = `
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        `;
    }
}

// Function to close sidebar (mobile)
function closeSidebar() {
    const sidebar = document.getElementById("sidebar");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    // Hide the sidebar
    sidebar.classList.add("-translate-x-full");
    sidebar.classList.remove("translate-x-0");

    // Change the hamburger icon back to its original state
    hamburgerIcon.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    `;
}

function ProfileDropdown(event) {
    const dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.classList.toggle('hidden'); // Menyembunyikan atau menampilkan dropdown
}

function ProfileDropdown(event) {
        // Mencegah perilaku default tombol
        event.preventDefault();

        // Dropdown menu
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Tanda panah
        const arrowIcon = document.getElementById('arrow-icon');

        // Toggle visibility dropdown menu
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.remove('hidden');
            arrowIcon.classList.remove('fa-chevron-down');
            arrowIcon.classList.add('fa-chevron-up');
        } else {
            dropdownMenu.classList.add('hidden');
            arrowIcon.classList.remove('fa-chevron-up');
            arrowIcon.classList.add('fa-chevron-down');
        }
    }

    //logout 
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }

    </script>