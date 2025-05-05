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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hafalan as $data)
            <tr>
                <td>{{ $data->student->name}}</td>
                <td>{{ $data->hafalan }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->date}}</td>
                <td>
                    <form action="{{ route('hafalan-destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                    <a href="{{ route('hafalan-edit', $data->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <br>
    <a href="{{ route('user-dashboard') }}">← Kembali ke Dashboard</a>