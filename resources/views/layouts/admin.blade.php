<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Guru')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">Aplikasi Hafalan</h1>
        <div class="relative inline-block text-left">
            <button onclick="toggleDropdown()" class="text-sm text-gray-600 hover:text-blue-600 focus:outline-none">
                More
            </button>
        
            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-10">
                <form action="{{ route('user-logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        

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
<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }

    // Optional: klik di luar dropdown untuk menutup
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = e.target.closest('button');
        if (!dropdown.contains(e.target) && !button) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</html>
