@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Data Murid</h1>

<form action="{{ route('admin-student-update', $student->id) }}" method="POST" class="space-y-4 max-w-xl bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-medium">Pilih Guru</label>
        <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
            <option value="" disabled>Pilih Guru</option>
            @foreach ($guru as $g)
            <option value="{{ $g->id }}" {{ $student->group && $g->groups->contains('id', $student->group_id) ? 'selected' : '' }}>
                {{ $g->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium">Kelas</label>
        <select name="group_id" id="group_id" class="w-full border rounded px-3 py-2" required>
            <!-- Akan diisi via JS -->
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium">Nama Murid</label>
        <input type="text" name="name" value="{{ $student->name }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Tanggal Lahir</label>
        <input type="date" name="birth_date" value="{{ $student->birth_date }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Jenis Kelamin</label>
        <select name="gender" class="w-full border rounded px-3 py-2" required>
            <option value="L" {{ $student->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $student->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan Perubahan
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const guruSelect = document.getElementById('user_id');
        const groupSelect = document.getElementById('group_id');
        const selectedGroupId = '{{ $student->group_id }}';

        function loadGroups(guruId) {
            groupSelect.innerHTML = '<option disabled selected>Memuat...</option>';
            fetch(`/get-groups-by-guru/${guruId}`)
                .then(res => res.json())
                .then(data => {
                    groupSelect.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(group => {
                            const opt = document.createElement('option');
                            opt.value = group.id;
                            opt.textContent = group.groups_name;
                            if (group.id == selectedGroupId) {
                                opt.selected = true;
                            }
                            groupSelect.appendChild(opt);
                        });
                    } else {
                        groupSelect.innerHTML = '<option disabled selected>Tidak ada kelas</option>';
                    }
                })
                .catch(err => {
                    console.error(err);
                    groupSelect.innerHTML = '<option disabled selected>Gagal memuat data</option>';
                });
        }

        if (guruSelect.value) {
            loadGroups(guruSelect.value);
        }

        guruSelect.addEventListener('change', function() {
            loadGroups(this.value);
        });
    });
</script>
@endsection