<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow px-4 py-4 flex justify-between items-center md:px-6">
        <h1 class="text-lg md:text-xl font-bold text-blue-600">Aplikasi Hafalan</h1>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-sm text-gray-600 hover:text-blue-600 hidden md:inline">Profil</a>
            {{-- Burger menu --}}
            <button id="menuToggle" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile-only menu --}}
    <div id="mobileMenu" class="md:hidden bg-white shadow px-4 py-2 hidden">
        <ul class="space-y-2">
            <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Dashboard</a></li>
            <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Murid</a></li>
            <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Hafalan</a></li>
            <li>
                <form action="{{ route('student-logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="block w-full text-left py-2 px-3 rounded hover:bg-red-100 text-red-600">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    {{-- Desktop layout --}}
    <div class="md:flex md:min-h-screen">
        {{-- Sidebar (only for desktop) --}}
        <aside class="hidden md:block md:w-64 bg-white shadow-md p-4">
            <ul class="space-y-2">
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Dashboard</a></li>
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Murid</a></li>
                <li><a href="#" class="block py-2 px-3 rounded hover:bg-blue-100">Hafalan</a></li>
                <li>
                    <form action="{{ route('student-logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="block w-full text-left py-2 px-3 rounded hover:bg-red-100 text-red-600">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    <footer class="bg-white shadow mt-6 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Aplikasi Hafalan - SMK Ruhul
    </footer>

    {{-- Script toggle menu --}}
    <script>
        const toggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        toggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>
