<h1><b>admin</b></h1>
<form action="{{ route('user-logout') }}" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>
@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@else
<p style="color:red;">{{ session('error') }}</p>
@endif

<form action="{{ route('user-store')}}" method="post">
    @csrf
    <select name="student_id">
        @foreach ($student as $data )
        <option value="{{ $data->id }}">{{ $data->name }}</option>
        @endforeach
    </select>
    <input type="text" name="hafalan">
    <input type="text" name="description">
    <input type="date" name="date">

    <button type="submit">Submit</button>

</form>
Guru
<table>
    <thead>
        <tr>
            <th>List Nama - Nama Guru Pengajar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $data )
        <tr>
            <td>{{ $data->name }}</td>
            <td>
                <a href="{{ route('student-detail',$data->id) }}">cek detail hafalan</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

