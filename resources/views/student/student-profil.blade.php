@extends('layouts.app')

@section('title', 'Data Murid')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Detail Murid: {{ $data->name }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $data->name }}</p>
                <p><strong>Kelas Hafalan:</strong> {{ $data->group->groups_name ?? '-' }}</p>
                <p><strong>Guru Pengajar:</strong>
                    @if ($data->group && $data->group->users && $data->group->users->isNotEmpty())
                        {{ $data->group->users->pluck('name')->join(', ') }}
                    @else
                        Tidak ada guru
                    @endif
                </p>
                <p><strong>Tanggal Lahir:</strong> {{ $data->birth_date }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
            </div>
        </div>
    </div>
@endsection
