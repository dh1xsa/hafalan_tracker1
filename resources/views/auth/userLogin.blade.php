<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        <!-- Notifikasi Error Login -->
        @if($errors->has('login'))
            <div class="mb-4 text-red-600 bg-red-100 border border-red-400 p-3 rounded">
                {{ $errors->first('login') }}
            </div>
        @endif

        <form action="{{ route('user-login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <input type="text" name="name" placeholder="Username"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                Login
            </button>
        </form>
    </div>

</body>
</html>
