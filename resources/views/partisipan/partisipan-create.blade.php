@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
@endpush

@push('script')
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('#partisipan').select2({
        theme: 'bootstrap4',
        ajax: {
            url: "{{ route('partisipan.user') }}",
            dataType: 'json'
        }
    });
    $('.select2-container').addClass('mb-2');
});
function addFile(){
    var index = 1;
    $('#index').val(index+1);
    var newIndex = $('#index').val();
    var file = '<select class="select2 form-control mb-1" name="partisipan[]" id="partisipan'+newIndex+'"></select>';
    var button = '<button class="btn btn-danger mb-2 btn-block" onclick="removeButton('+newIndex+')" id="button'+newIndex+'" type="button"><i class="fa fa-minus-circle fa-lg"></i></button>';
    $('.addfile').append(file);
    $('.addButton').append(button);

    $("#partisipan"+newIndex+"").select2({
        theme: 'bootstrap4',
        ajax: {
            url: "{{ route('partisipan.user') }}",
            dataType: 'json'
        }
    });
    $('.select2-container').addClass('mb-2');
}
function removeButton(params) {
    $('.addButton').find('#button'+params).remove();
    $('.addfile').find('#file'+params).remove();
}
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">
<div class="row justify-content-center">
    <div class="col m-3">
        <div class="card" style="width: 100%;">

            <div class="card-header">
                Tambah Data Partisipan Rapat Koordinasi
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('partisipan.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Rakoor: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly value="{{ $materi->judul }}">
                            <input type="hidden" class="form-control" value="{{ $materi->id }}" name="judul" id="judul">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="partisipan" class="col-sm-2 col-form-label">Partisipan : </label>
                        <div class="col-10 addfile">
                            <select class="select2 form-control" name="partisipan[]" id="partisipan" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-outline-danger" href="{{ Route('partisipan.index') }}">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
