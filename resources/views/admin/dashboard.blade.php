<!DOCTYPE html>
<html lang="en">
<head>
@vite('resources/css/app.css')
</head>
<body>
Admin
Kelola Data
<form action="{{ route('user-logout') }}" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>
<div class="flex justify-center items-center m-4 p-4 bg-gray-300">
    <div class="flex">
        <div class="m-4 p-8 bg-white rounded-sm">
            <a href="{{ route('admin-student-dashboard') }}">Murid</a>
        </div>
        <div class="m-4 p-8 bg-white rounded-sm">
            <a href="{{ route('admin-user-dashboard') }}">Guru</a>
        </div>
    </div>
</div>
    
</body>
</html>
