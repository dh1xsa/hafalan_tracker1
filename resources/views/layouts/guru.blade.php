<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Mobile Navbar -->
    <div class="md:hidden bg-white shadow px-4 py-4 flex justify-between items-center">
        <h1 class="text-lg font-bold">Admin Panel</h1>
        <button onclick="toggleSidebar()">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div class="flex min-h-screen">

        <!-- Sidebar (desktop & mobile) -->
        <aside id="sidebar"
               class="w-64 bg-white shadow-md fixed md:relative top-0 left-0 h-full z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
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
            </nav>
            <form action="{{ route('user-logout') }}" method="POST" class="p-4">
                @csrf
                <button class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">Logout</button>
            </form>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay"
             class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"
             onclick="closeSidebar()"></div>

        <!-- Main content -->
        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    </script>

</body>
</html>
