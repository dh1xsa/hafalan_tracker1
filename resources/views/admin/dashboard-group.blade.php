@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Kelas</h2>
        <form action="{{ route('admin-group-store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="user_id" class="block mb-1 font-medium">Pilih Guru</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Guru</option>
                    @foreach ($users as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="groups_name" class="block mb-1 font-medium">Nama Kelas</label>
                <input type="text" name="groups_name" id="groups_name" class="w-full border rounded px-3 py-2" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </form>
    </div>

    {{-- TABLE DAFTAR KELAS --}}
    <div class="bg-white p-6 rounded shadow max-w-4xl">
        <h2 class="text-lg font-semibold mb-4">Daftar Kelas</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border-b text-left">No</th>
                    <th class="px-4 py-2 border-b text-left">Nama Kelas</th>
                    <th class="px-4 py-2 border-b text-left">Guru</th>
                    <th class="px-4 py-2 border-b text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $index => $group)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $group->groups_name }}</td>
                        <td class="px-4 py-2 border-b">
                            @foreach ($group->users as $guru)
                                {{ $guru->name }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                        <td class="px-4 py-2 space-x-2 flex justify-start border-b">
                            <a href="{{ route('admin-group-edit', $group->id) }}"
                            class="px-2 py-1 bg-yellow-500 hover:bg-yellow-700 rounded-sm font-medium text-white">Ubah Data</a>
                            <form action="{{ route('admin-group-destroy', $group->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if ($groups->isEmpty())
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada kelas</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
