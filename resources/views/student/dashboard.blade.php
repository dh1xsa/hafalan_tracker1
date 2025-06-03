@extends('layouts.app')

@section('title', 'Data Murid')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Hafalanmu</h2>

    @foreach ($students as $data)
        <a href="{{ route('students.show', $data->id) }}" class="text-lg font-medium text-blue-700 hover:underline">
            {{ $data->name }}
        </a>
        <br>
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
                    @foreach ($hafalan as $item)
                        <tr class="hover:bg-gray-50 text-sm md:text-base">
                            <td class="px-4 py-2 border">{{ $item->student->name }}</td>
                            <td class="px-4 py-2 border">{{ $item->hafalan }}</td>
                            <td class="px-4 py-2 border">{{ $item->description }}</td>
                            <td class="px-4 py-2 border">{{ $item->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
@endsection
