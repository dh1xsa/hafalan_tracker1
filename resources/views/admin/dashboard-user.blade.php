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

<form action="{{ route('admin-user-store')}}" method="post">
    @csrf
    <input type="text" name="name">
    <input type="password" name="password">

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
                <a href="{{ route('admin-user-edit',$data->id) }}">ubah nama</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


