@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="{ open: false }">
    <h1 class="text-2xl font-bold mb-4">Kelola Murid</h1>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tombol Tambah Murid -->
    <div class="mb-6">
        <button @click="open = true" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Murid
        </button>
    </div>

    <!-- Modal Tambah Murid -->
    <div x-show="open" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow max-w-lg w-full relative">
            <h2 class="text-xl font-semibold mb-4">Tambah Murid Baru</h2>
            <form action="{{ route('admin-student-store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 font-medium">Pilih Guru</label>
                    <select name="user_id" class="w-full border rounded px-3 py-2">
                        @foreach ($user as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Nama Murid</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Murid Per Guru -->
    @forelse ($students as $userId => $studentGroup)
    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">Guru: {{ $studentGroup->first()->user->name }}</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama Murid</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">No HP</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentGroup as $data)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $data->name }}</td>
                        <td class="px-4 py-2">{{ $data->email ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $data->phone_number ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin-student-edit', $data->id) }}" class="text-blue-600 hover:underline">
                                Ubah Data
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @empty
    <p class="text-gray-600">Belum ada data murid.</p>
    @endforelse
</div>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
