<h1><b>Murid</b></h1>
@foreach ( $student as $data )
<h1><b>{{$data->name}}</b></h1>
@endforeach


<form action="{{ route('student-logout') }}" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>
<h2>Detail Hafalan Murid</h2>

@if ($hafalan->isEmpty())
<p>Tidak ada data hafalan untuk murid ini.</p>
@else
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nama Murid</th>
            <th>Hafalan</th>
            <th>Catatan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hafalan as $data)
        <tr>
            <td>{{ $data->student->name}}</td>
            <td>{{ $data->hafalan }}</td>
            <td>{{ $data->description }}</td>
            <td>{{ $data->date}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif