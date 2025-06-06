@extends('layouts.guru')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Tombol Trigger Modal --}}
    <h1
        class="text-3xl font-bold text-gray-800 mb-6 cursor-pointer"
        data-bs-toggle="modal"
        data-bs-target="#modalGuru{{ $user->id }}">
        Panel Guru
    </h1>
    {{-- Modal Detail Guru --}}
    <div
        class="modal fade"
        id="modalGuru{{ $user->id }}"
        tabindex="-1"
        aria-labelledby="modalGuruLabel{{ $user->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                {{-- Modal Header --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="modalGuruLabel{{ $user->id }}">
                        Detail Guru: {{ $user->name }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body">
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $user->birth_date }}</p>
                    <p><strong>Jenis Kelamin:</strong>
                        {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Snackbar Alerts --}}
@if ($errors->any() || session('error') || session('success'))
<div
    id="snackbar"
    class="fixed top-6 right-6 px-4 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 
               {{ session('error') || $errors->any() ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
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


{{-- Search Input --}}
<div class="mb-4">
    <input type="text" id="searchInput" placeholder="Cari nama murid..."
        class="w-full max-w-md border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
</div>

{{-- Tabel Murid --}}
<div class="bg-white rounded-xl shadow-md p-6">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Daftar Murid</h2>

    @foreach ($groups as $group)
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Kelas {{ $group->groups_name }}</h2>

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
                    @forelse ($group->students as $data)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3 border">{{ $data->name }}</td>
                        <td class="px-4 py-3 border">
                            <a href="{{ route('student-detail', $data->id) }}"
                                class="text-blue-600 hover:underline font-medium">
                                Cek Detail
                            </a>
                        </td>
                        <td class="px-4 py-3 border">
                            <a href="{{ route('student-detail.pdf', $data->id) }}"
                                class="text-green-600 hover:underline font-medium" target="_blank">
                                Ekspor PDF
                            </a>
                        </td>
                        <td class="px-4 py-3 border">
                            <button
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md openModalBtn"
                                data-id="{{ $data->id }}"
                                data-name="{{ $data->name }}">
                                + Input Hafalan
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            Belum ada murid di kelas ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

{{-- Modal Input Hafalan --}}
<div id="hafalanModal"
    class="fixed inset-0 bg-black bg-opacity-40 hidden z-50 flex justify-center items-center">
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6 relative">
        <button id="closeModal"
            class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
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
                <div>
                    <label for="surah" class="block font-medium text-gray-700 mb-1">Surah</label>
                    <select name="surah" id="surah" class="w-full border rounded px-3 py-2" required>
                        <option value="" disabled selected>Pilih surah</option>
                        @foreach ($surah as $g)
                        <option value="{{ $g['number'] }}" data-ayah="{{ $g['numberOfAyahs'] }}">
                            {{ $g['englishName'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block font-medium text-gray-700 mb-1">Ayat</label>
                    <div class="flex justify-center items-center">
                        <input type="number" name="startAyah" id="startAyah"
                            class="border border-gray-300 rounded-md px-3 py-2 w-1/2" min="1">

                        <span class="mx-2">Sampai</span>

                        <input type="number" name="endAyah" id="endAyah"
                            class="border border-gray-300 rounded-md px-3 py-2 w-1/2">
                    </div>
                    <p id="msg" class="text-red-500 text-sm mt-2"></p>
                </div>
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                <input type="text" name="description" id="description" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="date" class="block font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" id="date" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>

            <div>
                <label for="status" class="block font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="belum">Belum</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                    <option value="perlu diulang">Perlu Diulang</option>
                </select>
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

{{-- JS --}}
<script>
    const modal = document.getElementById('hafalanModal');
    const closeModalBtn = document.getElementById('closeModal');

    const baseDetailUrl = "{{ url('/student-detail') }}";
    const basePdfUrl = "{{ url('/user/student') }}";

    document.querySelectorAll('.openModalBtn').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('studentId').value = button.dataset.id;
            document.getElementById('studentName').value = button.dataset.name;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    document.getElementById('searchInput').addEventListener('input', function() {
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
                                    <a href="${baseDetailUrl}/${s.id}" class="text-blue-600 hover:underline font-medium">Cek Detail</a>
                                </td>
                                <td class="px-4 py-3 border">
                                    <a href="${basePdfUrl}/${s.id}/export-pdf" class="text-green-600 hover:underline font-medium" target="_blank">Ekspor PDF</a>
                                </td>
                                <td class="px-4 py-3 border">
                                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md openModalBtn"
                                        data-id="${s.id}" data-name="${s.name}">
                                        + Input Hafalan
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    body.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada murid ditemukan.</td>
                        </tr>
                    `);
                }
            });
    });
    const surahSelect = document.getElementById('surah');
    const start = document.getElementById('startAyah');
    const end = document.getElementById('endAyah');
    const msg = document.getElementById('msg');

    surahSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const maxAyah = selected.dataset.ayah;

        start.value = '';
        end.value = '';
        end.max = maxAyah;
        msg.textContent = '';
    });

    function validate() {
        const s = parseInt(start.value);
        const e = parseInt(end.value);
        const max = parseInt(end.max);

        if (s <= 0) {
            msg.textContent = 'Ayat mulai harus lebih dari 0.';
        } else if (e > max) {
            msg.textContent = `Ayat akhir tidak boleh lebih dari ${max}.`;
        } else if (e <= s) {
            msg.textContent = 'Ayat akhir harus lebih besar dari ayat mulai.';
        } else {
            msg.textContent = '';
        }
    }

    start.addEventListener('input', validate);
    end.addEventListener('input', validate);
</script>

@endsection