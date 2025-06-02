@extends('layouts.admin')
@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h2 class="text-xl font-bold mb-4">Edit Nama Guru</h2>

    <form action="{{ route('admin-group-update', $group->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium mb-1">Nama Kelas</label>
            <input type="text" name="groups_name" value="{{ $group->group->groups_name }}" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
        </div>

        <div>
            <label class="block font-medium mb-1">Pilih Guru</label>
            <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                <option value="{{ $group->user_id }}">{{ $group->user->name }}</option>
                @foreach ($users as $guru)
                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                @endforeach
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