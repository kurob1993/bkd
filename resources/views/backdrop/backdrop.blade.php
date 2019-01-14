@extends('core-ui.layouts.app')

@push('script')
<script></script>
@endpush
@push('style')
<style></style>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                
                <div class="card-header">
                    <div class="text-center">
                        <img src="{{ url('img/logo.png') }}" alt="logo ks" width="200px" >
                    </div>
                </div>

                <div class="card-body">
                    <div class="text-center m-t-15" style="background-color : red;border-radius: 4px;font-weight: bold">
                        <span style="color: white;font-size:18px">RAPAT KOORDINASI DIREKSI PT KRAKATAU INFORMATION TECHNOLOGY.</span>
                    </div>

                    <div class="text-center m-b-15 m-t-15">
                        <span style="color: black;font-size:22px; ">MEETING SCHEDULE</span>
                    </div>
                    <div class="">
                        <table class="table" style="width:100%;color: black;font-size:13px;border-top:1px solid #e2e7eb;">
                            <thead>
                                <tr>
                                    <th width="10%">NO</th>
                                    <th>TIME</th>
                                    <th>AGENDA</th>
                                    <th>MATERI</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @php($tanggal = date('Y-m-d') )
                                @foreach ($materi as $item)
                                    <tr>
                                        <td>{{ $item->agenda_no }}</td>
                                        <td>{{ $item->mulai }} - {{ $item->keluar }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>
                                            @foreach ($item->files as $file)
                                                @if($file->materi_id == $item->id)
                                                    @if(substr($file->name,-3,3) == 'pdf')
                                                    <a title="{{ $file->name }}" href="{{ $file->path }}" target="_blank" class="fa fa-file-pdf-o fa-lg m-r-5"></a>
                                                    @else
                                                    <a title="{{ $file->name }}" href="{{ $file->path }}" target="_blank" class="fa fa-file-text-o fa-lg m-r-5"></a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @php($tanggal = $item->date)
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="p-2" style="background-color : blue;">
                        <h4 style="color: white;">{{ \Carbon\Carbon::parse($tanggal)->formatLocalized('%A, %d %B %Y') }}</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection