@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-white rounded-lg shadow">
            <a href="{{ route('admin-student-dashboard') }}" class="text-blue-600 font-medium hover:underline">
                Kelola Murid
            </a>
        </div>
        <div class="p-6 bg-white rounded-lg shadow">
            <a href="{{ route('admin-user-dashboard') }}" class="text-blue-600 font-medium hover:underline">
                Kelola Guru
            </a>
        </div>
    </div>
@endsection
