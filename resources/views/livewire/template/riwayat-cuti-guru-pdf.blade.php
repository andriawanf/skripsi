<!DOCTYPE html>
<html>

<head>
    <title>Laporan Cuti Guru</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
        }
    
        th,
        td {
            padding: 10px;
            border-bottom: 1px;
            border-color: gray;
        }
    </style>
</head>

<body>
    <h1>Laporan Cuti Guru</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">
                    No
                </th>
                <th scope="col">
                    Nama
                </th>
                <th scope="col">
                    Kategori
                </th>
                <th scope="col">
                    Sub-Kategori
                </th>
                <th scope="col">
                    Tanggal Mulai
                </th>
                <th scope="col">
                    Tanggal Akhir
                </th>
                <th scope="col">
                    Total Cuti
                </th>
                <th scope="col">
                    Alasan
                </th>
                <th scope="col">
                    status
                </th>
            </tr>
        </thead>
        <tbody class="font-medium">
            @if ($cutiGuru->count())
                @foreach ($cutiGuru as $item)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row">
                            {{ $item->user->name }}
                        </th>

                        <td>
                            {{ $item->kategori->nama }}
                        </td>
                        <td>
                            {{ optional($item->subkategori)->nama_subkategoris ?? '-' }}
                        </td>
                        <td>
                            {{ $item->tanggal_mulai }}
                        </td>
                        <td>
                            {{ $item->tanggal_akhir }}
                        </td>
                        <td>
                            {{ $item->durasi }} Hari
                        </td>
                        <td class="px-6 py-4 line-clamp-1">
                            {{ $item->alasan }}
                        </td>
                        <td>
                            {{ $item->status }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>

                    <td scope="col">
                        Tidak ada data
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
