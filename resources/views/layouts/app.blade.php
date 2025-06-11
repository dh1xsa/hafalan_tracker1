<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Panel</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Navbar Mobile --}}
    <nav class="bg-white shadow px-4 py-4 flex justify-between items-center md:hidden relative">
        <h1 class="text-lg font-bold text-blue-600">User Panel</h1>
        <button id="mobileMenuBtn" aria-label="Toggle menu" class="focus:outline-none">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="mobileMenu"
            class="absolute top-full left-0 right-0 bg-white shadow-md rounded-b-md overflow-hidden max-h-0 transition-max-height duration-300 ease-in-out z-40"
            style="max-height: 0;">
            <div class="p-4">
                <button onclick="openLogoutModal()"
                    class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">
                    Logout
                </button>
            </div>
            <div class="p-4">
                <a href="/students/1" class="w-full px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded">
                    detail profil
                </a>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar (Desktop) -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 text-center font-bold text-lg border-b">User Panel</div>
            <nav class="p-4 space-y-4">
                <a href="{{ route('user-dashboard') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('user-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>

                 <a href="{{ route('students.show', $data->id) }}" class="block px-4 py-2 rounded hover:bg-gray-200">
            Detail Profile
        </a>
            </nav>
            <div class="p-4">
                <button onclick="openLogoutModal()"
                    class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">
                    Logout
                </button>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>
    </div>

    <!-- Modal Logout Confirmation -->
    <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 shadow-lg max-w-sm w-full">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Logout</h2>
            <p class="mb-6">Apakah kamu yakin ingin logout?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <form id="logoutForm" action="{{ route('student-logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const logoutModal = document.getElementById('logoutModal');

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.style.maxHeight && mobileMenu.style.maxHeight !== '0px') {
                mobileMenu.style.maxHeight = '0';
            } else {
                mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
            }
        });

        // Tutup mobile menu jika klik di luar
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.style.maxHeight = '0';
            }
        });

        // Modal Functions
        function openLogoutModal() {
            logoutModal.classList.remove('hidden');
        }

        function closeLogoutModal() {
            logoutModal.classList.add('hidden');
        }
    </script>

</body>

</html>
