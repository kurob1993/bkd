<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td colspan="2" rowspan="3" style="text-align: center;">
                <img src="{{ public_path('/img/logo.png') }}" alt="" width="120px">
            </td>
            <td colspan="12" style="height: 35px; text-align: center; vertical-align: middle;  font-size: 20px">BADAN KEPEGAWAIAN DAERAH</td>
        </tr>
        <tr>
            <td colspan="12" style="height: 35px; text-align: center; vertical-align: middle; font-size: 20px">PEMERINTAH KOTA CILEGON</td>
        </tr>
        <tr>
            <td colspan="12" style="height: 35px; text-align: center; vertical-align: middle; font-size: 15px">Alamat: Jalan Raya Merak-Tirtayasa No.10, Kecamatan Purwakarta, Ramanuju, Kec. Cilegon, Kota Cilegon, Banten 4243</td>
        </tr>
        <tr>
            <td style="height: 10px"></td>
        </tr>
    </table>
    <table class="table table-bordered">
        <thead>
           <tr>
                <th>ID</th>
                <th>NAMA</th>
                <th>TTL</th>
                <th>JENIS KELAMIN</th>
                <th>PENDIDIKAN</th>
                <th>JURUSAN</th>
                <th>NO TELEPON</th>
                <th>NPWP</th>
                <th>GAPOK</th>
                <th>TMT</th>
                <th>STATUS_TKK</th>
                <th>OPD</th>
                <th>POSISI</th>
                <th>KETERANGAN</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $item->employeeStatus->text }}_{{ $item->id }}</td>
                    <td>{{ $item->gelar_depan }} {{ $item->nama }} {{ $item->gelar_belakang }}</td>
                    <td>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                    <td>{{ $item->jenis_kelamin_text }}</td>
                    <td>{{ $item->pendidikan }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->npwp }}</td>
                    <td>{{ $item->gapok }}</td>
                    <td>{{ $item->tmt->format('d-m-Y') }}</td>
                    <td>{{ $item->status_tkk_text }}</td>
                    <td>{{ $item->opds['text'] }}</td>
                    <td>{{ $item->position['text'] }}</td>
                    <td>{{ $item->KETERANGAN }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>