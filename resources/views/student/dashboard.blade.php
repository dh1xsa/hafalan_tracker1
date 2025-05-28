@extends('layouts.app')

@section('title', 'Data Murid')

@section('content')
  <h2 class="text-2xl font-semibold mb-4">Hafalanmu</h2>

  @foreach ($student as $data)
    <p class="text-lg font-medium text-blue-700 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalSiswa{{ $data->id }}">
      {{ $data->name }}
    </p>

    <!-- Modal -->
    <div class="modal fade" id="modalSiswa{{ $data->id }}" tabindex="-1" aria-labelledby="modalSiswaLabel{{ $data->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalSiswaLabel{{ $data->id }}">Detail Murid: {{ $data->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body space-y-2">
                <p><strong>Nama:</strong> {{ $data->name }}</p>
                <p><strong>Group ID:</strong> {{ $data->group_id }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $data->birth_date }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
        </div>
      </div>
    </div>
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

@section('scripts')
  <!-- Bootstrap JS (via CDN) jika belum dimasukkan di layout -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-whatever" crossorigin="anonymous"></script>
@endsection
