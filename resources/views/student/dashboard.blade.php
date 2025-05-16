@extends('layouts.app')

@section('title', 'Data Murid')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Hafalanmu</h2>

    @foreach ($student as $data)
        <p class="text-lg font-medium text-blue-700">{{ $data->name }}</p>
    @endforeach

    {{-- Hafalan --}}
    <h3 class="text-xl font-semibold mt-6 mb-2">Detail Hafalan</h3>

    @if ($hafalan->isEmpty())
        <p class="text-gray-600">Tidak ada data hafalan untuk murid ini.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded">
                <thead class="bg-gray-100 text-sm md:text-base">
                    <tr>
                        <th class="px-4 py-2 border whitespace-nowrap">Nama Murid</th>
                        <th class="px-4 py-2 border whitespace-nowrap">Hafalan</th>
                        <th class="px-4 py-2 border whitespace-nowrap">Catatan</th>
                        <th class="px-4 py-2 border whitespace-nowrap">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hafalan as $data)
                        <tr class="hover:bg-gray-50 text-sm md:text-base">
                            <td class="px-4 py-2 border">{{ $data->student->name }}</td>
                            <td class="px-4 py-2 border">{{ $data->hafalan }}</td>
                            <td class="px-4 py-2 border">{{ $data->description }}</td>
                            <td class="px-4 py-2 border">{{ $data->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
