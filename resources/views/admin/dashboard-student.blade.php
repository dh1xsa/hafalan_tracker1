@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Kelola Murid</h1>

<!-- Logout & Notifikasi -->
<div class="flex justify-between items-center mb-6">

    @if(session('success'))
    <p class="text-green-600">{{ session('success') }}</p>
    @elseif(session('error'))
    <p class="text-red-600">{{ session('error') }}</p>
    @endif
</div>

<!-- Form Tambah Murid -->
<div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
    <h2 class="text-lg font-semibold mb-4">Tambah Murid Baru</h2>
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

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>

<!-- Tabel Data Murid -->
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar Murid</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Guru Penanggung Jawab</th>
                    <th class="px-4 py-2 text-left">Nama Murid</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $userId => $studentGroup)
                <tr class="bg-gray-100 border-t">
                    <td colspan="3" class="px-4 py-2 font-semibold">
                        {{ $studentGroup->first()->user->name }}
                    </td>
                </tr>

                @foreach ($studentGroup as $data)
                <tr class="border-t">
                    <td class="px-4 py-2"></td>
                    <td class="px-4 py-2">{{ $data->name }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin-student-edit', $data->id) }}" class="text-blue-600 hover:underline">
                            Ubah Data
                        </a>
                    </td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Belum ada data murid</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection