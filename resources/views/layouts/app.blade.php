<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">Aplikasi Hafalan</h1>
        <div>
            <a href="#" class="text-sm text-gray-600 hover:text-blue-600">Profil</a>
        </div>
    </nav>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md p-4">
            <ul class="space-y-2">
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Dashboard</a></li>
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Murid</a></li>
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Hafalan</a></li>
                <li>
                    <form action="{{ route('student-logout') }}" method="POST">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="bg-white shadow mt-6 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Aplikasi Hafalan - SMK Ruhul
    </footer>

</body>

</html>