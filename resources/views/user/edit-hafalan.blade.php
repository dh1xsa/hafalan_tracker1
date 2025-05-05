@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
@if(session('error'))
<p style="color:red;">{{ session('error') }}</p>
@endif
<form action="{{ route('hafalan-update', $hafalan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Hafalan:</label>
    <input type="text" name="hafalan" value="{{ $hafalan->hafalan }}">

    <label>Deskripsi:</label>
    <input type="text" name="description" value="{{ $hafalan->description }}">

    <label>Tanggal:</label>
    <input type="date" name="date" value="{{ $hafalan->date }}">

    <input type="text" name="student_id" value="{{ $hafalan->student_id }}" hidden>

    <button type="submit">Update</button>
</form>