<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #818cf8;">

    <div class="w-full max-w-sm">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-center text-2xl font-semibold mb-4">Lupa Kata Sandi</h3>
            <form action="{{ route('password.email') }}" method="POST" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-3 py-2">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-600 transition duration-200">Kirim Tautan Reset</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
