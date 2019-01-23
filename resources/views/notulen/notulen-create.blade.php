@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push('script')
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
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
});
function submit(){
    $('#form').submit();
}
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    Notulen Rapat Koordinasi ( {{$materi->judul}} )
                    <button class="btn btn-primary btn-sm float-right" type="button" onclick="submit()">
                        <i class="fa fa-save"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form id="form" method="post" enctype="multipart/form-data" action="{{ route('notulen.store') }}">
                        <div class="row row-form">
                            @csrf
                            <input type="hidden" name="materi_id" value="{{$materi->id}}">
                            <div class="col-sm-12">
                                <label for="note">Catatan</label>
                                <textarea name="note" class="form-control mt-1 mb-2 border-primary" id="note" cols="30" rows="4"></textarea>
                            </div>
                            <div class="col-sm-4">
                                <label for="start">Dari</label>
                                <input type="text" name="start" class="form-control mb-1 border-primary" id="start" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label for="end">Sampai</label>
                                <input type="text" name="end" class="form-control mb-1 border-primary" id="end" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <label for="pic">PIC</label>
                                <select class="select2 form-control" name="pic" id="pic" ></select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
