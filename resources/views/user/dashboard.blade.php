@extends('layouts.admin')

@section('title', 'Dashboard Guru')

@section('content')

<div class="max-w-7xl mx-auto w-full p-4 lg:p-8">
    <div
      class="rounded-2xl shadow-2xl bg-cover bg-center bg-no-repeat flex items-center justify-center min-h-[400px] lg:min-h-[500px] text-white"
      style="background-image: url('/assets/images/19.jpg');"
    >
      <h1 class="text-4xl lg:text-5xl font-bold drop-shadow-lg">Welcome</h1>
    </div>
  </div>
  

<form action="{{ route('user-store') }}" method="POST" class="max-w-7xl mx-auto bg-white p-6 rounded shadow">
    @csrf

    <!-- Select Student -->
    <div class="mb-4">
        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Murid</label>
        <select name="student_id" id="student_id" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @foreach ($student as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Input Hafalan -->
    <div class="mb-4">
        <label for="hafalan" class="block text-sm font-medium text-gray-700 mb-1">Hafalan</label>
        <input type="text" id="hafalan" name="hafalan" placeholder="Masukkan hafalan"
            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Input Deskripsi -->
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <input type="text" id="description" name="description" placeholder="Deskripsi"
            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Input Tanggal -->
    <div class="mb-6">
        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Setoran</label>
        <input type="date" id="date" name="date"
            class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Submit
    </button>
</form>

<!-- Tabel Murid -->
<div class="max-w-9xl mx-auto mt-10">
    <table class="min-w-full divide-y divide-gray-200 border rounded shadow overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Murid</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($student as $data)
                <tr>
                    <td class="px-6 py-4 text-gray-900">{{ $data->name }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('student-detail', $data->id) }}"
                           class="text-blue-600 hover:underline">
                            Cek detail hafalan
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection