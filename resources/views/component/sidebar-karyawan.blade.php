<!-- Navbar -->
<nav class="bg-indigo-500 p-4 shadow-md relative z-10">
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
            <img 
            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/logo.jpg' }}" 
            alt="Foto Profil" 
            class="w-10 h-10 rounded-full mr-3">
        </div>

        <!-- Dropdown Menu (Only visible on larger screens) -->
        <div class="relative hidden lg:block">
            <button class="flex items-center text-white focus:outline-none" onclick="ProfileDropdown(event)">
                <img 
                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/assets/profile.png' }}" 
                alt="Foto Profil" 
                class="w-10 h-10 rounded-full mr-3">
                <span>{{ Auth::user()->name }}</span>
            </button>
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden" id="dropdown-menu">
                <a href="profile-admin" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Profil Saya</a>
                <a href="edit-profile" class="block px-4 py-2 text-gray-800 hover:bg-blue-100">Edit Profile</a>
            </div>
        </div>
    </div>
</nav>

  <!-- Sidebar -->
  <div class="flex min-h-screen">
    <aside id="sidebar" class="w-64 bg-indigo-400 p-6 fixed left-0 top-0 h-full z-20 shadow-lg transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 overflow-y-auto" aria-hidden="true">
        <!-- Close Button (X) for Mobile -->
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
                <a href="dashboard-karyawan" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
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
            <li>
                <a href="tugas-harian" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                      </svg>                      
                    <span>Tugas Harian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('update.status') }}" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>                      
                    <span>Status Pengerjaan</span>
                </a>
            </li>
          <!-- <li>
                <a href="detail-pesanan" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                     </svg>                                                               
                    <span>Detail Pesanan</span>
                </a>
            </li>
            <li> -->
                <a href="riwayat-pengerjaan" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                      </svg>                    
                    <span>Riwayat Pengerjaan</span>
                </a>
            </li>
            <li>
                <a href="profil-karyawan" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                      </svg>                       
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <a href="ulasan-pengguna" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                      </svg>                       
                    <span>Ulasan Pengguna</span>
                </a>
            </li>
            <li>   
                <a href="http://127.0.0.1:8000/landing-page" class="flex items-center space-x-3 px-4 py-3 text-white hover:bg-blue-500 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <path fill="#ff0000" d="M 11.5 6 C 8.48 6 6 8.48 6 11.5 L 6 36.5 C 6 39.52 8.48 42 11.5 42 L 29.5 42 C 32.52 42 35 39.52 35 36.5 A 1.5 1.5 0 1 0 32 36.5 C 32 37.898 30.898 39 29.5 39 L 11.5 39 C 10.102 39 9 37.898 9 36.5 L 9 11.5 C 9 10.102 10.102 9 11.5 9 L 29.5 9 C 30.898 9 32 10.102 32 11.5 A 1.5 1.5 0 1 0 35 11.5 C 35 8.48 32.52 6 29.5 6 L 11.5 6 z M 33.484 15.484 A 1.5 1.5 0 0 0 32.44 18.061 L 36.879 22.5 L 15.5 22.5 A 1.5 1.5 0 1 0 15.5 25.5 L 36.879 25.5 L 32.44 29.94 A 1.5 1.5 0 1 0 34.561 32.061 L 41.561 25.061 A 1.5 1.5 0 0 0 41.561 22.94 L 34.561 15.94 A 1.5 1.5 0 0 0 33.484 15.484 z"></path>
                    </svg>                    
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>

     <!-- Main Content -->
     <main class="flex-1 p-10 md:ml-60 mb-36">
        @yield('content')
    </main>
    </div>

  <!-- Modal Popup Konfirmasi Logout  -->
  <div id="confirmationLogout" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-50 text-sm md:text-xs">
    <div class="bg-white py-6 px-12 rounded-lg shadow-lg">
        <p class="text-center text-gray-700">Yakin mau logout?</p>
        <div class="mt-4 flex justify-center gap-6">
            <button id="cancelLogout" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded-xl hover:bg-green-500 hover:text-white">Tidak</button>
            <button id="confirmLogout" class="bg-white border border-red-500 text-red-500 py-2 px-4 rounded-xl hover:bg-red-500 hover:text-white">Ya</button>
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
</script>