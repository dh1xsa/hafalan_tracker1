@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Kelola Murid</h1>

    <!-- Notifikasi -->
    <div class="mb-6">
        @if (session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="text-red-600">{{ session('error') }}</p>
        @endif
    </div>

    <!-- Form Tambah Murid -->
    <div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Murid Baru</h2>
        <form action="{{ route('admin-student-store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Pilih Guru</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Guru</option>
                    @foreach ($guru as $g)
                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Kelas</label>
                <select name="group_id" id="group_id" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Guru Terlebih Dahulu</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Nama Murid</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Jenis Kelamin</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </form>
    </div>

    <!-- Tabel Murid -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Daftar Murid</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Kelas</th>
                        <th class="px-4 py-2 text-left">Guru</th>
                        <th class="px-4 py-2 text-left">Nama Murid</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $groupId => $studentGroup)
                        @php
                            $group = $groups->firstWhere('id', $groupId);
                            $groupName = $group->groups_name ?? 'Kelas Tidak Diketahui';
                            $guruNames =
                                $group && $group->users->count()
                                    ? $group->users->pluck('name')->join(', ')
                                    : 'Guru Tidak Diketahui';
                        @endphp

                        <tr class="bg-gray-100 border-t">
                            <td class="px-4 py-2 font-semibold">{{ $groupName }}</td>
                            <td class="px-4 py-2 font-semibold">{{ $guruNames }}</td>
                            <td class="px-4 py-2"></td>
                            <td class="px-4 py-2"></td>
                        </tr>

                        @foreach ($studentGroup as $data)
                            <tr class="border-t">
                                <td class="px-4 py-2"></td>
                                <td class="px-4 py-2"></td>
                                <td class="px-4 py-2">{{ $data->name }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button onclick="showDetailModal({{ $data->id }})"
                                        class="text-purple-600 hover:underline">Lihat Detail</button>
                                    <a href="{{ route('admin-student-edit', $data->id) }}"
                                        class="text-blue-600 hover:underline">Ubah Data</a>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada data murid</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-md p-6 rounded shadow-lg relative">
            <button onclick="closeDetailModal()"
                class="absolute top-2 right-2 text-gray-600 hover:text-black text-2xl font-bold">
                &times;
            </button>
            <h3 class="text-xl font-semibold mb-4">Detail Murid</h3>
            <div id="detailContent">
                <p class="text-gray-500 text-center">Memuat data...</p>
            </div>
        </div>
    </div>

    <script>
        function showDetailModal(studentId) {
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailContent').innerHTML =
                '<p class="text-gray-500 text-center">Memuat data...</p>';

            fetch(`/admin/student/${studentId}`)
                .then(res => res.json())
                .then(data => {
                    const html = `
                    <p><strong>Nama:</strong> ${data.name}</p>
                    <p><strong>Tanggal Lahir:</strong> ${data.birth_date}</p>
                    <p><strong>Jenis Kelamin:</strong> ${data.gender === 'L' ? 'Laki-laki' : 'Perempuan'}</p>
                    <p><strong>Guru Penanggung Jawab:</strong> ${data.guru_name}</p>
                `;
                    document.getElementById('detailContent').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('detailContent').innerHTML =
                        '<p class="text-red-500 text-center">Gagal memuat data.</p>';
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const guruSelect = document.getElementById('user_id');
            const groupSelect = document.getElementById('group_id');

            guruSelect.addEventListener('change', function() {
                const guruId = this.value;
                groupSelect.innerHTML = '<option value="" disabled selected>Memuat...</option>';

                fetch(`/get-groups-by-guru/${guruId}`)
                    .then(response => response.json())
                    .then(data => {
                        groupSelect.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(group => {
                                const option = document.createElement('option');
                                option.value = group.id;
                                option.textContent = group.groups_name;
                                groupSelect.appendChild(option);
                            });
                        } else {
                            groupSelect.innerHTML =
                                '<option value="" disabled selected>Tidak ada kelas</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Gagal mengambil data grup:', error);
                        groupSelect.innerHTML =
                            '<option value="" disabled selected>Gagal memuat data</option>';
                    });
            });
        });
    </script>
@endsection
