@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Kelola Murid</h1>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="mb-4 text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Tambah Murid -->
    <div class="bg-white p-6 rounded shadow mb-8 max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Tambah Murid Baru</h2>
        <form id="formTambahMurid" action="{{ route('admin-student-store') }}" method="POST" class="space-y-4">
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
                <label class="block mb-1 font-medium">Pilih Murid</label>
                <select name="name" id="murid_select" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Murid --</option>
                    @foreach ($studentsPure as $s)
                        <option value="{{ $s->name }}" data-birth="{{ $s->birth_date }}"
                            data-gender="{{ $s->gender }}">
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required>
            </div>


            <div>
                <label class="block mb-1 font-medium">Tanggal Lahir</label>
                <input type="date" name="birth_date" id="birth_date" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Jenis Kelamin</label>
                <select name="gender" id="gender" class="w-full border rounded px-3 py-2" required>
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
                                <td class="px-4 py-2 space-x-2 flex justify-start">
                                    <button onclick="showModal('modalSiswa{{ $data->id }}')"
                                        class="px-2 py-1 bg-blue-500 hover:bg-blue-700 rounded-sm font-medium text-white">
                                        Lihat Detail
                                    </button>
                                    <a href="{{ route('admin-student-edit', $data->id) }}"
                                        class="px-2 py-1 bg-yellow-500 hover:bg-yellow-700 rounded-sm font-medium text-white">Ubah
                                        Data</a>
                                    <form action="{{ route('admin-student-destroy', $data->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-500 rounded-sm font-medium text-white">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Detail Siswa -->
                            <div id="modalSiswa{{ $data->id }}"
                                class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative mx-auto mt-10">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-xl font-bold">Detail Murid: {{ $data->name }}</h3>
                                        <button onclick="closeModal('modalSiswa{{ $data->id }}')"
                                            class="text-gray-600 hover:text-black text-2xl font-bold">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="space-y-2">
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
                                        <p><strong>Jenis Kelamin:</strong>
                                            {{ $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
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

    <script>
        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.getElementById(id).classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const guruSelect = document.getElementById('user_id');
            const groupSelect = document.getElementById('group_id');
            const studentSelect = document.getElementById('murid_select'); // ✅ sesuai blade

            // Saat guru dipilih, ambil daftar kelas
            guruSelect?.addEventListener('change', function() {
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

            // Autofill form saat murid dipilih dari dropdown
            studentSelect?.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const birthDate = selected.getAttribute('data-birth') || '';
                const gender = selected.getAttribute('data-gender') || '';

                document.getElementById('birth_date').value = birthDate;
                document.getElementById('gender').value = gender;
            });
        });
    </script>
@endsection
