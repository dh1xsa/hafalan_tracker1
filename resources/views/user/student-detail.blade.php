@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">Detail Hafalan Murid</h2>

@if ($hafalan->isEmpty())
    <p class="text-gray-600">Tidak ada data hafalan untuk murid ini.</p>
@else
    <div class="overflow-x-auto bg-white p-6 rounded shadow">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Murid</th>
                    <th class="px-4 py-2 text-left">Hafalan</th>
                    <th class="px-4 py-2 text-left">Catatan</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hafalan as $data)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $data->student->name }}</td>
                        <td class="px-4 py-2">{{ $data->hafalan }}</td>
                        <td class="px-4 py-2">{{ $data->description }}</td>
                        <td class="px-4 py-2">{{ $data->date }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <form action="{{ route('hafalan-destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                    Hapus
                                </button>
                            </form>
                            <a href="{{ route('hafalan-edit', $data->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="mt-6">
    <a href="{{ route('user-dashboard') }}" class="inline-block text-blue-600 hover:underline">
        ← Kembali ke Dashboard
    </a>
</div>

@endsection
