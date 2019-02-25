{{-- {{ dd($materi[0]->agenda_no) }} --}}
@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<style></style>
@endpush

@push('script')
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script>
    jQuery.datetimepicker.setLocale('id');
    jQuery('#tanggal').datetimepicker({
        timepicker:false,
        mask:true,
        format:'d/m/Y'
    });
    jQuery('#jamMasuk').datetimepicker({
        datepicker:false,
        mask:true,
        format:'H:i'
    });
    jQuery('#jamKeluar').datetimepicker({
        datepicker:false,
        mask:true,
        format:'H:i'
    });
    function addFile(){
        var index = 1;
        $('#index').val(index+1);
        var newIndex = $('#index').val();
        var file = '<input type="file" class="form-control mb-1" id="file'+newIndex+'" placeholder="File" name="file[]" value="">';
        var button = '<button class="btn btn-danger mt-2 btn-block" onclick="removeButton('+newIndex+')" id="button'+newIndex+'" type="button"><i class="fa fa-minus-circle fa-lg"></i></button>';
        $('.addfile').append(file);
        $('.addButton').append(button);
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

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card" style="width: 100%;">

                <div class="card-header">
                    Tambah Data Materi Rapat Koordinasi
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
                    <form method="post" enctype="multipart/form-data" action="{{ route('materi.update',$materi[0]->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="judul" class="col-sm-2 col-form-label">Judul : </label>
                            <div class="col-sm-10">
                                <input type="text" name="judul" value="{{ $materi[0]->judul }}" class="form-control" id="judul" placeholder="Judul" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal : </label>
                            <div class="col-sm-10">
                                <input type="text" name="tanggal" value="{{ $materi[0]->dmy_date }}" class="form-control" id="tanggal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noDokumen" class="col-sm-2 col-form-label">No Dokumen : </label>
                            <div class="col-sm-10">
                                <input type="text" name="no_dokumen" value="{{ $materi[0]->no_dokumen }}" class="form-control" id="noDokumen" placeholder="No Dokumen" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agenda" class="col-sm-2 col-form-label">Agenda ke : </label>
                            <div class="col-sm-10">
                                <select class="form-control" required name="agenda">
                                    <option value=""> .: Pilih Agenda :. </option>
                                    @for ($i=0; $i < 10 ; $i++)
                                        @if( $materi[0]->agenda_no == $i+1 )
                                            <option value="{{ $i+1 }}" selected> {{ $i+1 }} </option>
                                        @else
                                            <option value="{{ $i+1 }}"> {{ $i+1 }} </option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jamMasuk" class="col-sm-2 col-form-label">Jam : </label>
                            <div class="col-sm-4">
                                <input type="text" name="jam_mulai" value="{{ $materi[0]->mulai }}" class="form-control" id="jamMasuk" required>
                            </div>
                            <div class="col-sm-1 text-center">s.d</div>
                            <div class="col-sm-5">
                                <input type="text" name="jam_keluar" value="{{ $materi[0]->keluar }}" class="form-control" id="jamKeluar" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="presenter" class="col-sm-2 col-form-label">Presentasi oleh : </label>
                            <div class="col-sm-10">
                            <input type="text" name="presenter" value="{{ $materi[0]->presenter }}" class="form-control" id="presenter" placeholder="Presentasi oleh">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 col-form-label">File : </label>
                            <div class="col-8 addfile">
                                <input type="file" name="file[]" class="form-control mb-1" id="file" placeholder="Password">
                            </div>
                            <div class="col-auto addButton">
                                <button class="btn btn-primary" onclick="addFile()" type="button">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <a class="btn btn-outline-danger" href="{{ Route('materi.index') }}">
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
</div>
@endsection
