@extends('layouts.layout-user')

@section('title', 'Tulis Ulasan-User')

@section('content')

          <!-- Content Area -->
<div class="flex-1 p-5">
    <!-- White Container -->

        <div class="mb-4">
        </div>

        <div class="container mx-auto p-4 md:p-8 lg:w-2/3">
            <!-- Header -->
            <div class="flex-1 p-5">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-100 shadow-xl rounded-xl p-6">
                    <div class="container mx-auto">
                        <h5 class="text-3xl font-semibold text-gray-800 mb-4">Tambah Ulasan</h5>
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-600 p-4 rounded-lg mb-4">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('ulasan.index') }}" method="POST" class="bg-white shadow-xl rounded-2xl p-6 space-y-4">
                            @csrf
                            <!-- Nama Pengguna-->
                            <div>
                                <label for="nama_pengguna" class="text-lg font-semibold text-gray-700">Nama Pengguna</label>
                                <input type="text" 
                                    id="nama_pengguna" 
                                    name="nama_pengguna" 
                                    value="{{ Auth::user()->name }}" 
                                    class="w-full mt-2 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                                    readonly>
                            </div>
                            <!-- Rating -->
                            <div class="mt-4">
                                <label for="rating" class="text-lg font-semibold text-gray-700">Rating</label>
                                <input type="hidden" id="rating" name="rating" value="0">
                                <div class="flex items-center mt-2 space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg 
                                            xmlns="http://www.w3.org/2000/svg" 
                                            class="w-8 h-8 cursor-pointer star text-gray-400 transition duration-200"
                                            fill="currentColor" 
                                            data-value="{{ $i }}" 
                                            onclick="setRating({{ $i }})">
                                            <path d="M12 17.27L18.18 21 16.54 13.97 22 9.24l-6.91-.61L12 2 9.91 8.63 3 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <!-- Komentar -->
                            <div>
                                <label for="komentar" class="text-lg font-semibold text-gray-700">Tulis Ulasan Anda</label>
                                <textarea id="komentar" name="komentar" rows="4" placeholder="Bagikan pengalaman Anda..." class="w-full mt-2 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                            </div>
                            <!-- Button Submit -->
                            <div class="flex justify-end">
                                <button type="submit" 
                                id="submitBtn"
                                class="bg-indigo-600 text-white py-2 px-6 rounded-full hover:bg-indigo-700 transition duration-300 transform hover:scale-105"
                                onclick="this.disabled=true; this.form.submit();">
                                Kirim Ulasan
                            </button>                                                        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            
              
<script>
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

 // Get all star elements
 const stars = document.querySelectorAll('.w-8.h-8.cursor-pointer');

 function setRating(rating) {
        // Update the hidden input value
        document.getElementById('rating').value = rating;

        // Reset all stars to default color
        const stars = document.querySelectorAll('.star');
        stars.forEach((star) => {
            star.classList.remove('text-orange-500'); // Active color
            star.classList.add('text-gray-400'); // Default color
        });

        // Highlight stars up to the selected rating
        for (let i = 0; i < rating; i++) {
            stars[i].classList.remove('text-gray-400');
            stars[i].classList.add('text-orange-500');
        }
    }

</script>
@endsection




        
        