@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Edit Hafalan Murid</h2>

<!-- Notifikasi -->
@if(session('success'))
<p class="text-green-600 mb-4">{{ session('success') }}</p>
@endif
@if(session('error'))
<p class="text-red-600 mb-4">{{ session('error') }}</p>
@endif

<!-- Form Edit -->
<div class="bg-white p-6 rounded shadow max-w-xl">
    <form action="{{ route('hafalan-update', $hafalan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Hafalan:</label>
            <input type="text" name="hafalan" value="{{ $hafalan->hafalan }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Catatan:</label>
            <input type="text" name="description" value="{{ $hafalan->description }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Status:</label>
            <select name="status" id="status" required class="w-full rounded px-3 py-2 border">
                <option value="" disabled>Pilih Jenis Kelamin</option>
                <option value="belum" {{ $hafalan->status == 'belum' ? 'selected' : '' }}>belum</option>
                <option value="proses" {{ $hafalan->status == 'proses' ? 'selected' : '' }}>proses</option>
                <option value="selesai" {{ $hafalan->status == 'selesai' ? 'selected' : '' }}>selesai</option>
                <option value="perlu diulang" {{ $hafalan->status == 'perlu diulang' ? 'selected' : '' }}>perlu diulang</option>
            </select>
        </div>

        <div>
            <label class="block font-medium mb-1">Nilai:</label>
            <input type="text" name="score" value="{{ $hafalan->score }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal:</label>
            <input type="date" name="date" value="{{ $hafalan->date }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <input type="hidden" name="student_id" value="{{ $hafalan->student_id }}">

        <div class="flex justify-between items-center">
            <a href="{{ route('student-detail', $hafalan->student_id) }}" class="text-blue-600 hover:underline">
                ← Kembali
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </div>
    </form>
</div>

@endsection