<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Login - Hafalan Tracker</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="h-screen bg-gray-100">

  <div class="flex h-screen">
    <!-- Form Login -->
    <div class="w-full md:w-1/3 flex items-center justify-center bg-white p-10">
      <div class="w-full max-w-sm">
        <h2 class="text-2xl font-bold text-gray-800 mb-1">Masuk Akun <span class="text-blue-600">HAFALAN</span></h2>
        <p class="text-sm text-gray-600 mb-6">Siswa</p>
        <form action="/student-login" method="POST" class="space-y-4">
          @csrf
          <div>
            <input type="text" id="name" name="name" placeholder="Nama pengguna"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <input type="password" id="password" name="password" placeholder="Kata sandi"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <button type="submit"
              class="w-full py-2 px-4 bg-blue-200 text-gray-800 font-semibold rounded-md hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
              Masuk
            </button>
          </div>
        </form>
        @if($errors->has('login'))
        <div class="alert alert-danger mt-4 text-red-600">{{ $errors->first('login') }}</div>
        @endif
      </div>
    </div>

    <!-- Background Image -->
    <div class="hidden md:block md:w-2/3 bg-cover bg-center relative"
         style="background-image: url('/assets/images/17.jpg');">
      <!-- Optional: overlay if needed -->
      <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    </div>
  </div>

</body>
</html>
