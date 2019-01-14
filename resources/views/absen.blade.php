<div  style="height: 500px">
    <table class="" width="100%" border="1">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nik</th>
                <th rowspan="2">Nama</th>
                @for ($i = 0; $i < 31; $i++)
                    <th colspan="2">Tanggal <br> {{ $i+1 }} </th>
                @endfor
                
            </tr>
            <tr>
                @for ($i = 0; $i < 31; $i++)
                    <th>IN</th>
                    <th>OUT</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($emp as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nama}}</td>
                    
                    @for ($i = 0; $i < 31; $i++)
                    <td>
                        @foreach ($item->absens->where('date',$i+1)->whereIn('inout',['MASUK']) as $absen)
                            @if ($absen)
                                {{$absen->time}}
                            @endif                                   
                        @endforeach
                    </td>
                    <td>
                        @foreach ($item->absens->where('date',$i+1)->where('inout','PULANG') as $absen)
                            @if ($absen)
                                {{$absen->time}}
                            @endif                                   
                        @endforeach
                    </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>