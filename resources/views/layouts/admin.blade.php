<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6 text-center font-bold text-lg border-b">Admin Panel</div>
            {{-- <nav class="p-4 space-y-4">
                <a href="{{ route('admin-dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin-student-dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-student-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Murid
                </a>
                <a href="{{ route('admin-user-dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin-user-dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Guru
                </a>
            </nav> --}}
            <form action="{{ route('user-logout') }}" method="POST" class="p-4">
                @csrf
                <button class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600 rounded">Logout</button>
            </form>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
