@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/summernote-master/summernote-bs4.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendors/summernote-master/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script> 
<script>
$(document).ready(function() {
    $('#pic').select2({
        theme: 'bootstrap4',
        ajax: {
            url: "{{ route('notulen.user') }}",
            dataType: 'json'
        }
    });
    jQuery.datetimepicker.setLocale('id');

    jQuery('#start').datetimepicker({
        timepicker:false,
        mask:true,
        format:'d/m/Y'
    });
    jQuery('#end').datetimepicker({
        timepicker:false,
        mask:true,
        format:'d/m/Y'
    });

    $('#note').summernote({
        height: 90, 
    });

    $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('notulen.viewNotulen',$materi->id) }}",
        columns: [
            {data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row+1;
                }
            },
            {data: 'note'},
            {data: 'start',
                render: function(data, type, row, meta) {
                    return '<b>'+data+'</b> sd <b>'+row.end+'</b>';
                }
            },
            {data: 'pic'}

        ]
    });

});
function submit(){
    $('#form').submit();
}
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="row justify-content-center">
    <div class="col m-3">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                Notulen Rapat Koordinasi ( {{$materi->judul}} )
                <div class="float-right">
                    <a class="btn btn-danger btn-sm" href="{{ route('notulen.index') }}">
                        <i class="fa fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button class="btn btn-primary btn-sm" type="button" onclick="submit()">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="form" method="post" enctype="multipart/form-data" action="{{ route('notulen.store') }}">
                    <div class="row row-form">
                        @csrf
                        <input type="hidden" name="materi_id" value="{{$materi->id}}">
                        <div class="col-sm-6">
                            <label for="note">Catatan</label>
                            <textarea name="note" class="form-control mt-1 mb-2 border-primary" id="note" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <label for="start">Dari</label>
                                <input type="text" name="start" class="form-control mb-1 border-primary" id="start" autocomplete="off">
                            </div>
                            <div class="col-sm-12">
                                <label for="end">Sampai</label>
                                <input type="text" name="end" class="form-control mb-1 border-primary" id="end" autocomplete="off">
                            </div>
                            <div class="col-sm-12">
                                <label for="pic">PIC</label>
                                <select class="select2 form-control" name="pic" id="pic" ></select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col mx-3">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                Data Notulen ( {{$materi->judul}} )
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover responsive no-wrap" id="table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Catatan</th>
                                <th>Due Date</th>
                                <th>PIC</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
