@extends('layouts.admin')

@section('content')

    <h1 class="text-2xl font-bold mb-4">Kelola Guru</h1>

    <!-- Logout & Notifikasi -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('user-logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Logout
            </button>
        </form>

        @if(session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
        @endif
    </div>

    <!-- Form Tambah Guru -->
    <div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Guru Baru</h2>
        <form action="{{ route('admin-user-store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Nama Guru</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </form>
    </div>

    <!-- Tabel Data Guru -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Guru Pengajar</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama Guru</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $data)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $data->name }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin-user-edit', $data->id) }}" class="text-blue-600 hover:underline">
                                    Ubah Nama
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4">Belum ada data guru</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
