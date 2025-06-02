@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Kelola Guru</h1>

<!-- Notifikasi -->
<div class="flex justify-between items-center mb-6">
    @if (session('success'))
    <p class="text-green-600">{{ session('success') }}</p>
    @elseif(session('error'))
    <p class="text-red-600">{{ session('error') }}</p>
    @endif
</div>

<!-- Tombol toggle form -->
<button id="toggleFormBtn" class="mb-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
    Tambah Guru
</button>



<!-- Form Tambah Guru (default hidden) -->
<div id="formTambahGuru" class="bg-white p-6 rounded shadow mb-8 max-w-xl hidden">
    <h2 class="text-lg font-semibold mb-4">Tambah Guru Baru</h2>
    <form action="{{ route('admin-user-store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Level (hidden, default 2) -->
        <input type="hidden" name="level" value="2">

        <div>
            <label class="block mb-1 font-medium">Nama Guru</label>
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

<!-- Tabel Data Guru -->
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar Guru & Kelas</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Guru</th>
                    <th class="px-4 py-2 text-left">Tanggal Lahir</th>
                    <th class="px-4 py-2 text-left">Gender</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $guru)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $guru->name }}</td>
                    <td class="px-4 py-2">{{ $guru->birth_date }}</td>
                    <td class="px-4 py-2">
                        {{ $guru->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}
                    </td>
                    <td class="px-4 py-2 flex justify-start">
                        <a href="{{ route('admin-user-edit', $guru->id) }}" class="px-2 py-1 bg-yellow-400 rounded-sm font-medium mx-0.5 text-white">Ubah</a>
                        <form action="{{ route('admin-user-destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 rounded-sm font-medium text-white">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Belum ada data guru</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal/Popup untuk Detail Guru -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Detail Guru</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="modalContent">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Tutup</button>
        </div>
    </div>
</div>

<script>
    function showDetail(data) {
        // Format konten modal dengan semua field yang diminta
        const content = `
            <div class="space-y-3">
                <p class="flex items-center">
                    <span class="font-semibold w-32">Nama:</span>
                    <span>${data.name || '-'}</span>
                </p>

                <p class="flex items-center">
                    <span class="font-semibold w-32">Tanggal Lahir:</span>
                    <span>${data.birth_date ? formatDate(data.birth_date) : '-'}</span>
                </p>

                <p class="flex items-center">
                    <span class="font-semibold w-32">Jenis Kelamin:</span>
                    <span>${formatGender(data.gender)}</span>
                </p>

                <p class="flex items-center">
                    <span class="font-semibold w-32">Group ID:</span>
                    <span>${data.group_id || '-'}</span>
                </p>
            </div>
        `;

        // Masukkan konten ke modal
        document.getElementById('modalContent').innerHTML = content;

        // Tampilkan modal
        document.getElementById('detailModal').classList.remove('hidden');
    }

    // Fungsi helper untuk format tanggal
    function formatDate(dateString) {
        if (!dateString) return '-';
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    // Fungsi helper untuk format jenis kelamin
    function formatGender(gender) {
        if (!gender) return '-';
        const genders = {
            'male': 'Laki-laki',
            'female': 'Perempuan',
            'other': 'Lainnya'
        };
        return genders[gender.toLowerCase()] || gender;
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Tutup modal ketika klik di luar konten modal
    window.onclick = function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>


<script>
    let passwordVisible = false;
    const realPassword = "${data.password || ''}"; // Simpan password asli

    function togglePassword() {
        const passwordField = document.getElementById('passwordField');
        const eyeIcon = document.getElementById('eyeIcon');

        passwordVisible = !passwordVisible;

        if (passwordVisible) {
            passwordField.textContent = realPassword;
            eyeIcon.innerHTML = `
                <path d="M13.875 18.825A10.05 10.05 0 0110 20c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0110 3c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L14 14" />
            `;
        } else {
            passwordField.textContent = '••••••••';
            eyeIcon.innerHTML = `
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            `;
        }
    }
</script>

<script>
    document.getElementById('toggleFormBtn').addEventListener('click', function() {
        const form = document.getElementById('formTambahGuru');
        form.classList.toggle('hidden');
    });
</script>
@endsection