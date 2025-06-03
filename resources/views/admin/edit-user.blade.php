@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
        <h2 class="text-xl font-bold mb-4">Edit Nama Guru</h2>

        <form action="{{ route('admin-user-update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2">
            </div>

             <div>
                <label class="block font-medium mb-1">Nama</label>
                <input type="date" name="birth_date" value="{{ $user->birth_date }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium mb-1">Jenis Kelamin</label>
                <select name="gender">
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                    <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </form>

        <!-- Notifikasi -->
        @if(session('success'))
            <p class="mt-4 text-green-600">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="mt-4 text-red-600">{{ session('error') }}</p>
        @endif
    </div>
@endsection
