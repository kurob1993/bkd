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

                    <div class="text-center my-3">
                        <span style="color: black;font-size:22px; ">MEETING SCHEDULE</span>
                    </div>
                    <div class="">
                        <table class="table table-bordered" style="width:100%">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="10%">NO</th>
                                    <th>TIME</th>
                                    <th>AGENDA</th>
                                    <th>MATERI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materi as $key=>$item)
                                    <tr class="{{ fmod($key,2) == 0 ? 'bg-dark':'bg-white'}}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->dmyDate }} {{ $item->mulai }} - {{ $item->keluar }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>
                                            @foreach ($item->files as $file)
                                                @if($file->materi_id == $item->id)
                                                    @if(substr($file->name,-3,3) == 'pdf')
                                                    <a title="{{ $file->name }}" href="{{ $file->path }}" 
                                                        target="_blank" class="fa fa-file-pdf-o fa-2x mr-2 text-white"></a>
                                                    @else
                                                    <a title="{{ $file->name }}" href="{{ $file->path }}" 
                                                        target="_blank" class="fa fa-file-text-o fa-2x mr-2 text-white"></a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection