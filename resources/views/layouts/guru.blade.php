<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Guru Panel</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar Mobile --}}
    <nav
        class="w-full bg-white shadow px-4 py-4 flex justify-between items-center md:hidden fixed top-0 left-0 right-0 z-50">
        <h1 class="text-lg font-bold text-blue-600">Panel Guru</h1>
        <button id="mobileMenuBtn" aria-label="Toggle menu" class="focus:outline-none">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="mobileMenu"
            class="absolute top-full left-0 right-0 bg-white shadow-md rounded-b-md overflow-hidden max-h-0 transition-all duration-300 ease-in-out z-40"
            style="max-height: 0;">
            <form action="{{ route('user-logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar (Desktop) -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 text-center font-bold text-lg border-b">Panel Guru</div>
            <nav class="p-4 space-y-4">
                <a href="{{ route('admin-dashboard') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
            </nav>
            <form action="{{ route('user-logout') }}" method="POST" class="p-4">
                @csrf
                <button
                    class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-4 md:p-6 pt-20"> <!-- pt-20 untuk beri ruang di bawah navbar -->
            @yield('content')
        </main>
    </div>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.style.maxHeight && mobileMenu.style.maxHeight !== '0px') {
                mobileMenu.style.maxHeight = '0';
                document.body.classList.remove('overflow-hidden');
            } else {
                mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                document.body.classList.add('overflow-hidden');
            }
        });

        // Optional: tutup menu kalau klik di luar
        document.addEventListener('click', function (e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.style.maxHeight = '0';
            }
        });
    </script>

</body>

</html>
