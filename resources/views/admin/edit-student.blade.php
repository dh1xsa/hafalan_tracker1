<form action="{{ route('admin-student-update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Guru Penanggung Jawab</label>
    <select name="user_id">
        @foreach ($user as $data )
        <option value="{{ $data->id }}" {{ $student->user_id == $data->id ? 'selected' : '' }}>
            {{ $data->name }}
        </option>
        @endforeach
    </select>
    <label>Nama</label>
    <input type="text" name="name" value="{{ $student->name }}">

    <button type="submit">Update</button>
</form>
@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif