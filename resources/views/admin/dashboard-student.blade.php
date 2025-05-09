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

<form action="{{ route('admin-student-store')}}" method="post">
    @csrf
    <select name="user_id">
        @foreach ($user as $data )
        <option value="{{ $data->id }}">{{ $data->name }}</option>
        @endforeach
    </select>
    <input type="text" name="name">
    <input type="password" name="password">

    <button type="submit">Submit</button>

</form>
Murid
<table>
    <thead>
        <tr>
            <th>Guru Penanggung Jawab</th>
            <th>Nama Murid</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($student as $data )
        <tr>
            <td>{{ $data->user->name }}</td>
            <td>{{ $data->name }}</td>
            <td>
                <a href="{{ route('admin-student-edit',$data->id) }}">ubah data</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>