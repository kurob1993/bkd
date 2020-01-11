@extends('core-ui.layouts.app')

@push('style')
<link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<style></style>
@endpush

@push('script')
<script src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.opd').select2();
        $('#parent_posisi').select2();
    });

    function setPosisi(value) {
        $('#parent_posisi').html('');
        $.post("{{ route('api.position.opd') }}",{opd_id:value},function(data){
            $('#parent_posisi').append('<option value=""> - </option>');
            $('#parent_posisi').append('<option value="0"> Buat Parent Posisi </option>');
            for (let index = 0; index < data.length; index++) {                    
                $('#parent_posisi').append('<option value="'+data[index].id+'">'+data[index].text+'</option>');
            }
        });
    }
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            @CardDefault(['title' => 'Tambah Data Posisi'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('posisi.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="ket" class="col-sm-2 col-form-label">OPD : </label>
                        <div class="col-sm-10">
                            <select name="master_opd_id" id="master_opd_id" class="form-control opd" onchange="setPosisi(this.value);" required>
                                <option value="">-</option>
                                @foreach ($masterOpd as $item)
                                    <option value="{{$item->id}}">{{$item->text}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Parent Posisi : </label>
                        <div class="col-sm-10">
                            <select name="parent_posisi" id="parent_posisi" class="form-control" required onchange="$('#posisi').focus();">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Posisi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="posisi" value="{{ old('posisi') }}" class="form-control" id="posisi" placeholder="Posisi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-outline-danger" href="{{ Route('opd.index') }}">
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
            @endCardDefault()

        </div>
    </div>
</div>
@endsection
