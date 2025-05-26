<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Siswa - Tutorial CRUD Laravel 10 @ qadrlabs.com</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white rounded-xl shadow-lg max-w-4xl w-full mx-4 md:flex overflow-hidden">

    <!-- Left side: Image -->
    <div 
      class="hidden md:block md:w-1/2 bg-cover bg-center"
      style="background-image: url('https://i.pinimg.com/736x/23/bb/be/23bbbed2c7d469c018fe5482caecea56.jpg');"
      aria-label="Login illustration">
    </div>

    <!-- Right side: Form -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Login Siswa</h2>

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

      <form action="{{ route('student-login') }}" method="POST" class="space-y-6">
          @csrf
          <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan username"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
              @error('name')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
          </div>

          <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" id="password" name="password" placeholder="Masukkan password"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
              @error('password')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
          </div>

          <div>
              <button type="submit"
                      class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                  Login
              </button>
          </div>
      </form>
    </div>
  </div>
  
</body>
</html>
