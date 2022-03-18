<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
</head>

<body>
    <h3 class="text-center">Lapora Pendapatan</h3>
    <h3 class="text-center">
        Tanggal {{ tanggal_indonesia($awal, false) }}
        s/d
        Tanggal {{ tanggal_indonesia($akhir, false) }}
    </h3>

    <table class="table table-striped">
        <tr>
            <th width="5%">No</th>
            <th>Tanggal</th>
            <th>Penjualan</th>
            <th>Pembelian</th>
            <th>Pengeluaran</th>
            <th>Pendapatan</th>
        </tr>
    </table>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($row as $col)
                    <td>{{ $col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</body>

</html>
