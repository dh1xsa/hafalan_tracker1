@extends('layouts.admin')

@section('content')


    <div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Kelas</h2>
        <form action="{{ route('admin-group-store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="groups_name" class="block mb-1 font-medium">Nama Kelas</label>
                <input type="text" name="groups_name" id="groups_name" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Kelas</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Kelas</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($groups as $data)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $data->groups_name }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin-group-destroy', $data->id) }}" method="POST" class="inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit"
                                              class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded shadow transition duration-200">
                                        Hapus Data
                                      </button>
                                    </form>
                                  </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
