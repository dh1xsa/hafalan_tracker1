@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
        <h2 class="text-xl font-bold mb-4">Edit Data Murid</h2>

        <form action="{{ route('admin-student-update', $student->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Guru Penanggung Jawab</label>
                <select name="user_id" class="w-full border rounded px-3 py-2">
                    @foreach ($user as $data)
                        <option value="{{ $data->id }}" {{ $student->user_id == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Murid</label>
                <input type="text" name="name" value="{{ $student->name }}" class="w-full border rounded px-3 py-2">
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
