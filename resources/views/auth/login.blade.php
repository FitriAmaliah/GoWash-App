<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #818cf8;">

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-sm sm:max-w-md">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-center mb-6">
            <img src="/assets/logo-aplikasi.png" alt="Logo Aplikasi" class="h-48 w-48">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-4">Login</h3>

        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan email" required>
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan password" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="rememberMe" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="rememberMe" class="ml-2 block text-sm text-gray-900">Ingatkan saya</label>
            </div>

            <!-- Forgot Password -->
            <div class="text-right mb-4">
                <a href="forgot-password" class="text-blue-500 hover:text-blue-700">Lupa Kata Sandi?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Masuk</button>

            <!-- Register Link -->
            <div class="text-center mt-4">
                Belum punya akun?
                <a href="registrasi" class="text-blue-500 hover:text-blue-700">Daftar di sini</a>
            </div>
        </form>
    </div>

</body>
</html>
