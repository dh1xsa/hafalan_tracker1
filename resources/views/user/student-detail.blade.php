@extends('layouts.admin')

@section('title', 'Rincian Hafalan')

@section("content")
    
<h2 class="text-2xl font-semibold text-gray-800 mb-4">Detail Hafalan Murid</h2>

@if ($hafalan->isEmpty())
    <p class="text-gray-600">Tidak ada data hafalan untuk murid ini.</p>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Murid</th>
                    <th class="px-4 py-2 text-left">Hafalan</th>
                    <th class="px-4 py-2 text-left">Catatan</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($hafalan as $data)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $data->student->name }}</td>
                        <td class="px-4 py-2">{{ $data->hafalan }}</td>
                        <td class="px-4 py-2">{{ $data->description }}</td>
                        <td class="px-4 py-2">{{ $data->date }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <form action="{{ route('hafalan-destroy', $data->id) }}" method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                            <a href="{{ route('hafalan-edit', $data->id) }}"
                               class="text-blue-600 hover:underline text-sm font-medium">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<!-- Back to Dashboard Link -->
<div class="mt-6">
    <a href="{{ route('user-dashboard') }}" class="text-blue-600 hover:underline text-sm">
        ← Kembali ke Dashboard
    </a>
</div>


@endsection