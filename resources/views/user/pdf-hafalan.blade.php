<!DOCTYPE html>
<html>
<head>
    <title>Detail Hafalan - {{ $student->name }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Detail Hafalan - {{ $student->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hafalan</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hafalan as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->hafalan }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->date)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
