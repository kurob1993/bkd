@extends('core-ui.layouts.app') @push('style')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<style></style>

@endpush @push('script')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#materis-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('materi.show','') }}/all",
        columns: [
            {data: 'id'},
            {data: 'judul'},
            {data: 'agenda_no'},
            {data: 'date'},
            {data: 'mulai'},
            {data: 'keluar'},
            {data: 'presenter'},
            {
                data: 'files',
                render: function ( data, type, row ) {
                    var file = '';
                    var ex;
                    var fa;
                    for (let index = 0; index < data.length; index++) {                            
                        if(data[index]){
                            ex = data[index].path.substr(-3, 3);
                            if(ex === 'pdf' || ex === 'PDF'){
                                fa = 'fa fa-file-pdf-o fa-lg';
                                file += '<a data-toggle="modal" href="#modal-id" class="text-danger m-1" '+
                                        'style="margin:0px 2px 2px 0px" onclick="pdf(`'+data[index].path+'`)">'+
                                    '<i class="'+fa+'"></i>'+
                                    '</a>';
                            }else{
                                fa = 'fa fa-file-text-o fa-lg';
                                url = data[index].path;
                                file += '<a href="'+url+'" target="_blank" class="text-danger m-1" style="margin:0px 2px 2px 0px">'+
                                    '<i class="'+fa+'"></i>'+
                                    '</a>';
                            }
                        }
                    }
                    return file;
                }
            },
            {data: 'action'}
        ]
    });
});
function pdf(file) {
    var win = window.open( url()+file ,'_blank');
    win.focus();
}
</script>

@endpush
    @include('core-ui.layouts._layout') 
@section('content')
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card" style="width: 100%;">

                <div class="card-header">
                    Materi Rapat Koordinasi
                    @can('create materis')
                    <div class="float-right">
                        <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('materi.create') }}">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    Tambah Data
                                </a>
                        <button class="btn btn-outline-warning btn-sm mx-1" type="button">
                                    <i class="fa fa-users fa-lg"></i>
                                    Tambah Partisipan
                                </button>
                    </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover responsive no-wrap" id="materis-table" width="100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">No</th>
                                    <th>Judul</th>
                                    <th>Agenda</th>
                                    <th width="10%">Tanggal</th>
                                    <th>Mulai</th>
                                    <th>Keluar</th>
                                    <th>Presenter</th>
                                    <th width="15%">File</th>
                                    <th width="15%" data-priority="2">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection