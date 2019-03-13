@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendors/summernote-master/summernote-bs4.css') }}" rel="stylesheet" />
@endpush

@push('script')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendors/summernote-master/summernote-bs4.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#pic').select2({
        theme: 'bootstrap4',
        ajax: {
            url: "{{ route('progres-kerja.user') }}",
            dataType: 'json'
        }
    });
    $('.select2-container').addClass('mb-2');
    var slider = document.getElementById("customRange1");
    var output = document.getElementById("value");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
    
    $('#proker').summernote({
        height: 120, 
    });
});
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="row justify-content-center">
    <div class="col mx-3 mt-3">
        <div class="card" style="width: 100%;">

            <div class="card-header">
                Tambah Program Kerja
            </div>
            
            <div class="card-body">
                <div class="alert alert-dark" role="alert">
                    <span>Notulen : </span><br>
                    {!! $notulen->note !!} 
                    Due Date :  <strong>{{ $notulen->start }}</strong> 
                    s.d  <strong>{{ $notulen->end }}</strong>
                </div>
                <form action="{{ route('progres-kerja.store') }}" method="POST">
                    @csrf
                    <div class="row mt-1">
                        <div class="col-md">
                            <span class="badge badge-success">Program Kerja</span>
                            <input type="hidden" class="form-control" name="notulen_id" value="{{ $notulen->id }}">
                            <textarea name="proker" id="proker" cols="30" rows="4" class="form-control" required>
                            </textarea>
                        </div>
                        <div class="col-md">
                            <span class="badge badge-success">PIC</span>
                            <select class="select2 form-control" name="pic" id="pic" required></select>

                            <span class="badge badge-success">Progres <span id="value"></span> % </span>
                            <input type="range" class="custom-range" id="customRange1" name="realisasi" required>

                            <span class="badge badge-success">Issue </span>
                            <input type="text" class="form-control" name="issue" required>

                            <span class="badge badge-success">Action Plan </span>
                            <input type="text" class="form-control" name="action_plan" required>

                            <div class="float-right mr-3 mt-2">
                                <a class="btn btn-danger btn-sm" href="{{ route('progres-kerja.index') }}">
                                    <i class="fa fa-arrow-left"></i>
                                    Kembali
                                </a>
            
                                <button class="btn btn-primary btn-sm" type="button" onclick="submit()">
                                    <i class="fa fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('progres-kerja._list-proker')
@endsection