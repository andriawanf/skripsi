<!DOCTYPE html>
<html>

<head>
    <title>Laporan Cuti Guru</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 500;
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
                    NIP
                </th>
                <th scope="col">
                    Jabatan
                </th>
                <th scope="col">
                    Pangkat
                </th>
                <th scope="col">
                    Satuan Organisasi
                </th>
                <th scope="col">
                    Saldo Cuti
                </th>
                <th scope="col">
                    Email
                </th>
            </tr>
        </thead>
        <tbody class="font-medium">
            @if ($dataGuru->count())
                @foreach ($dataGuru as $item)
                    <tr>
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <th scope="row">
                            {{ $item->name }}
                        </th>
                        <td>
                            {{ $item->nip }}
                        </td>
                        <td>
                            {{ $item->jabatan }}
                        </td>
                        <td>
                            {{ $item->pangkat }}
                        </td>
                        <td>
                            {{ $item->satuan_organisasi }}
                        </td>
                        <td >
                            {{ $item->saldo_cuti }}
                        </td>
                        <td>
                            {{ $item->email }}
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
