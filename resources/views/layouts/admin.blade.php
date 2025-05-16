<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar Mobile --}}
    <nav class="bg-white shadow px-4 py-4 flex justify-between items-center md:hidden">
        <h1 class="text-lg font-bold text-blue-600">Admin Panel</h1>
        <button onclick="document.getElementById('mobileSidebar').classList.toggle('hidden')">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </nav>

    <div class="flex min-h-screen">

        <!-- Sidebar (Desktop) -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 text-center font-bold text-lg border-b">Admin Panel</div>
            <nav class="p-4 space-y-4">
                <a href="{{ route('admin-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin-student-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-student-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Murid
                </a>
                <a href="{{ route('admin-user-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-user-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Guru
                </a>
            </nav>
            <form action="{{ route('user-logout') }}" method="POST" class="p-4">
                @csrf
                <button
                    class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">Logout</button>
            </form>
        </aside>

        <!-- Sidebar (Mobile) -->
        <aside id="mobileSidebar"
               class="w-64 bg-white shadow-md fixed top-0 left-0 h-full z-50 transform -translate-x-full transition-transform duration-200 ease-in-out md:hidden hidden">
            <div class="p-6 text-center font-bold text-lg border-b flex justify-between items-center">
                Admin Panel
                <button onclick="document.getElementById('mobileSidebar').classList.add('hidden')">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <nav class="p-4 space-y-4">
                <a href="{{ route('admin-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin-student-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-student-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Murid
                </a>
                <a href="{{ route('admin-user-dashboard') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-user-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Guru
                </a>
                <form action="{{ route('user-logout') }}" method="POST">
                    @csrf
                    <button class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Overlay (optional for better UX) -->
        <div id="mobileOverlay"
             class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"
             onclick="document.getElementById('mobileSidebar').classList.add('hidden'); this.classList.add('hidden');">
        </div>

        <!-- Main content -->
        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    <script>
        // Optional: hide sidebar when clicking outside (UX)
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('mobileOverlay');
        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !e.target.closest('button')) {
                sidebar.classList.add('hidden');
                overlay.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
