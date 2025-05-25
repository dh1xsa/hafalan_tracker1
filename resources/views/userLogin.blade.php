
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Guru dan Orang Tua - Tutorial CRUD Laravel 10 @ qadrlabs.com</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col md:flex-row h-screen">
      <!-- Form Login -->
      <div class="w-full md:w-1/2 flex items-center justify-center p-6 bg-white">
        <div class="w-full max-w-md p-8 shadow-md rounded-xl">
          <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login Guru dan Orang Tua</h2>
  
          <form action="{{ route('user-login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
              <input type="text" id="name" name="name" placeholder="Masukkan username"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
  
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" id="password" name="password" placeholder="Masukkan password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
  
            <div>
              <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Login
              </button>
            </div>
          </form>
  
          @if($errors->has('login'))
          <div class="alert alert-danger mt-4 text-red-600">{{ $errors->first('login') }}</div>
          @endif
        </div>
      </div>
  
      <!-- Gambar di sebelah kanan -->
      <div class="hidden md:block md:w-1/2 bg-cover bg-center" style="background-image: url('/assets/images/19.jpg');">
      </div>
    </div>
  </body>
  
</html>
