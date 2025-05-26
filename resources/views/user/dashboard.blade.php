@extends('layouts.guru')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Panel Guru</h1>

    {{-- Snackbar Alerts --}}
    @if($errors->any() || session('error') || session('success'))
        <div id="snackbar" class="fixed top-6 right-6 px-4 py-3 rounded-lg shadow-lg z-50
            {{ session('error') || $errors->any() ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @else
                {{ session('error') ?? session('success') }}
            @endif
        </div>
        <script>
            setTimeout(() => {
                const sb = document.getElementById('snackbar');
                if (sb) {
                    sb.classList.add('opacity-0', 'translate-y-2');
                    setTimeout(() => sb.remove(), 300);
                }
            }, 3000);
        </script>
    @endif

    {{-- Search Murid --}}
    <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Cari nama murid..."
            class="w-full max-w-md border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    {{-- Tabel Murid --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Murid</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium text-gray-700 border">Nama Murid</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700 border">Detail</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700 border">PDF</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-700 border">Hafalan</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    @forelse ($student as $data)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 border">{{ $data->name }}</td>
                            <td class="px-4 py-3 border">
                                <a href="{{ route('student-detail', $data->id) }}"
                                   class="text-blue-600 hover:underline font-medium">Cek Detail</a>
                            </td>
                            <td class="px-4 py-3 border">
                                <a href="{{ route('student-detail.pdf', $data->id) }}"
                                   class="text-green-600 hover:underline font-medium" target="_blank">Ekspor PDF</a>
                            </td>
                            <td class="px-4 py-3 border">
                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md openModalBtn"
                                    data-id="{{ $data->id }}" data-name="{{ $data->name }}">
                                    + Input Hafalan
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada murid terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Form --}}
<div id="hafalanModal" class="fixed inset-0 bg-black bg-opacity-40 hidden justify-center items-center z-50">
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Input Hafalan</h2>
        <form action="{{ route('user-store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="student_id" id="studentId">
            <div>
                <label class="block font-medium text-gray-700 mb-1">Nama Murid</label>
                <input type="text" id="studentName" disabled
                    class="w-full bg-gray-100 border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div>
                <label for="hafalan" class="block font-medium text-gray-700 mb-1">Hafalan</label>
                <input type="text" name="hafalan" id="hafalan"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div>
                <label for="description" class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                <input type="text" name="description" id="description"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div>
                <label for="date" class="block font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" id="date"
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div class="text-right">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    const modal = document.getElementById('hafalanModal');
    const closeModalBtn = document.getElementById('closeModal');

    document.querySelectorAll('.openModalBtn').forEach(button => {
        button.addEventListener('click', () => {
            const studentId = button.getAttribute('data-id');
            const studentName = button.getAttribute('data-name');
            document.getElementById('studentId').value = studentId;
            document.getElementById('studentName').value = studentName;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // Search AJAX
    document.getElementById('searchInput').addEventListener('input', function () {
        fetch(`{{ route('students.search') }}?q=${encodeURIComponent(this.value)}`)
            .then(res => res.json())
            .then(data => {
                const body = document.getElementById('studentTableBody');
                body.innerHTML = '';
                if (data.length) {
                    data.forEach(s => {
                        body.insertAdjacentHTML('beforeend', `
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3 border">${s.name}</td>
                                <td class="px-4 py-3 border">
                                    <a href="/student-detail/${s.id}" class="text-blue-600 hover:underline font-medium">Cek Detail</a>
                                </td>
                                <td class="px-4 py-3 border">
                                    <a href="/user/student/${s.id}/export-pdf" class="text-green-600 hover:underline font-medium" target="_blank">Ekspor PDF</a>
                                </td>
                                <td class="px-4 py-3 border">
                                    <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md openModalBtn"
                                        data-id="${s.id}" data-name="${s.name}">
                                        + Input Hafalan
                                    </button>
                                </td>
                            </tr>
                        `);
                    });

                    // Re-bind modal event
                    document.querySelectorAll('.openModalBtn').forEach(button => {
                        button.addEventListener('click', () => {
                            document.getElementById('studentId').value = button.dataset.id;
                            document.getElementById('studentName').value = button.dataset.name;
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                        });
                    });

                } else {
                    body.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada murid ditemukan.</td>
                        </tr>`;
                }
            });
    });
</script>
@endsection
