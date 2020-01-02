<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TKK</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
        }

        table {
            width: 100%
        }

        table, td, th {
            border: 1px solid black;
        }
    
        body {
            font-size: 10px;
        }
    </style>

</head>

<body>
    <table align="center">
        <thead>
            <tr>
                <th align="center" data-priority="1">NO</th>
                <th align="center">NAMA</th>
                <th align="center">TEMPAT, TGL LAHIR</th>
                <th align="center">JENIS<br>KELAMIN</th>
                <th align="center">TMT</th>
                <th align="center">STATUS</th>
                <th align="center">KATEGORI</th>
                <th align="center">OPD</th>
                <th align="center">KET</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emp as $key => $item)
            <tr>
                <td align="center">{{$key+1}}</td>
                <td>{{$item->gelar_depan}} {{$item->nama}}{{$item->gelar_belakang ? ', '.$item->gelar_belakang : ''}}</td>
                <td>{{$item->tempat_lahir.', '.$item->tanggal_lahir->format('d-m-Y')}}</td>
                <td>{{$item->jenis_kelamin_text}}</td>
                <td>{{$item->tmt->format('d-M-y')}}</td>
                <td>{{$item->status_tkk_text}}</td>
                <td>{{$item->employeeStatus->text}}</td>
                <td>{{$item->opds->text}}</td>
                <td>{{$item->keterangan}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>