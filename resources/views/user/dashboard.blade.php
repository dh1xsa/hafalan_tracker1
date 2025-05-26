@extends('layouts.guru')

@section('content')

<h1 class="text-2xl font-bold mb-6">Panel Guru</h1>

<!-- Form Hafalan -->
<div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
    <h2 class="text-lg font-semibold mb-4">Input Hafalan Murid</h2>
    <form action="{{ route('user-store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="student_id" class="block font-medium mb-1">Pilih Murid</label>
            <select name="student_id" id="student_id" class="w-full border rounded px-3 py-2">
                @foreach ($student as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="hafalan" class="block font-medium mb-1">Hafalan</label>
            <input type="text" name="hafalan" id="hafalan" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label for="description" class="block font-medium mb-1">Deskripsi</label>
            <input type="text" name="description" id="description" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label for="date" class="block font-medium mb-1">Tanggal</label>
            <input type="date" name="date" id="date" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>

<!-- Tabel Murid -->
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar Murid</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Murid</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($student as $data)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $data->name }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('student-detail', $data->id) }}" class="text-blue-600 hover:underline">
                                Cek Detail Hafalan
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center py-4 text-gray-500">Belum ada murid terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
