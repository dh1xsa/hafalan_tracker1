@extends('layouts.admin')
@section('title', 'Edit Hafalan')
@section('content')
@if(session('success'))
    <p class="text-green-600 mb-4">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p class="text-red-600 mb-4">{{ session('error') }}</p>
@endif

<form action="{{ route('hafalan-update', $hafalan->id) }}" method="POST" class="max-w-9xl bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="hafalan" class="block text-sm font-medium text-gray-700">Hafalan</label>
        <input type="text" name="hafalan" id="hafalan"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
               value="{{ $hafalan->hafalan }}">
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <input type="text" name="description" id="description"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
               value="{{ $hafalan->description }}">
    </div>

    <div class="mb-4">
        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
        <input type="date" name="date" id="date"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
               value="{{ $hafalan->date }}">
    </div>

    <input type="hidden" name="student_id" value="{{ $hafalan->student_id }}">

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Update
    </button>
</form>


@endsection