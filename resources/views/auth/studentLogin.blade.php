<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Siswa - Tutorial CRUD Laravel 10 @ qadrlabs.com</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    {{-- Snackbar Alert --}}
    @if (session('error') || session('success'))
        <div id="snackbar" class="fixed top-5 right-5 px-4 py-2 rounded-md shadow-md transition-all duration-300 z-50
            {{ session('error') ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
            {{ session('error') ?? session('success') }}
        </div>
        <script>
            setTimeout(function () {
                const sb = document.getElementById('snackbar');
                if (sb) {
                    sb.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => sb.remove(), 300);
                }
            }, 3000);
        </script>
    @endif

    <div class="w-full max-w-md p-8 bg-white shadow-md rounded-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login Siswa</h2>

        <form action="{{ route('student-login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan username"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>