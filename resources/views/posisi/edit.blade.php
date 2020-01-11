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
        var opd = $('#master_opd_id').val();
        setPosisi(opd);
    });

    function setPosisi(value) {
        $('#parent_posisi').html('');
        $.post("{{ route('api.position.opd') }}",{opd_id:value},function(data){
            $('#parent_posisi').append('<option value=""> - </option>');

            if( {{ $posisi->parent_id }} == 0){
                $('#parent_posisi').append('<option value="0" selected> Buat Parent Posisi </option>');
            }else{
                $('#parent_posisi').append('<option value="0"> Buat Parent Posisi </option>');
                for (let index = 0; index < data.length; index++) {  
                    if(data[index].id == {{ $posisi->parent_id }} ){
                        $('#parent_posisi').append('<option value="'+data[index].id+'" selected>'+data[index].text+'</option>');
                    }else{
                        $('#parent_posisi').append('<option value="'+data[index].id+'">'+data[index].text+'</option>');
                    }                  
                }
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
            @CardDefault(['title' => 'Sunting Data Posisi'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('posisi.update', $posisi->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row">
                        <label for="ket" class="col-sm-2 col-form-label">OPD : </label>
                        <div class="col-sm-10">
                            <select name="master_opd_id" id="master_opd_id" class="form-control opd">
                                <option value=""> - </option>
                                @foreach ($comboMasterOpd as $item)
                                <option value="{{$item->id}}" {{ $posisi->master_opd_id == $item->id ? 'selected' : '' }}>
                                    {{$item->text}}
                                </option>
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
                            <input type="text" name="posisi" value="{{ $posisi->text }}" class="form-control" id="posisi" placeholder="Posisi" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-outline-danger" href="{{ Route('posisi.index') }}">
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
