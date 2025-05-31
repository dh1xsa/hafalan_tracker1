@extends('layouts.admin')

@section('content')
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
        <h2 class="text-xl font-bold mb-4">Edit Data Murid</h2>

        <form action="{{ route('admin-student-update', $student->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Pilih Guru -->
            <div>
                <label class="block mb-1 font-medium">Pilih Guru</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Guru</option>
                    @foreach ($guru as $g)
                        <option value="{{ $g->id }}" {{ $g->id == $selectedGuruId ? 'selected' : '' }}>
                            {{ $g->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Pilih Kelas -->
            <div>
                <label class="block mb-1 font-medium">Kelas</label>
                <select name="group_id" id="group_id" class="w-full border rounded px-3 py-2" required>
                    <option value="" disabled selected>Pilih Guru Terlebih Dahulu</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update
            </button>
        </form>

        @if (session('success'))
            <p class="mt-4 text-green-600">{{ session('success') }}</p>
        @elseif(session('error'))
            <p class="mt-4 text-red-600">{{ session('error') }}</p>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('user_id');
            const groupSelect = document.getElementById('group_id');
            const selectedGroupId = "{{ old('group_id', $student->group_id ?? '') }}";

            function loadGroups(userId) {
                fetch(`/get-groups-by-guru/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Groups fetched:", data); // Debug log
                        groupSelect.innerHTML = '<option value="" disabled selected>Pilih Kelas</option>';
                        data.forEach(group => {
                            const option = document.createElement('option');
                            option.value = group.id;
                            option.text = group.name;
                            if (group.id == selectedGroupId) {
                                option.selected = true;
                            }
                            groupSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching groups:', error));
            }

            // Load jika sudah ada guru terpilih
            if (userSelect.value) {
                loadGroups(userSelect.value);
            }

            userSelect.addEventListener('change', function() {
                loadGroups(this.value);
            });
        });
    </script>
@endsection
