<h1><b>Guru</b></h1>
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

<table>
    <thead>
        <tr>
            <th>Nama Murid</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($student as $data )
        <tr>
            <td>{{ $data->name }}</td>
            <td>
                <a href="{{ route('student-detail',$data->id) }}">cek detail hafalan</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>