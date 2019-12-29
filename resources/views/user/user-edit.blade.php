@extends('core-ui.layouts.app')

@push('style')
<style></style>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#opd').hide();
        if('{{ $user->roles[0]->id }}' == 3){
            $('#opd').show();
        }else{
            $('#opd').hide();
        }
    });

    function roleChange(opd) {
        if(opd == 3){
            $('#opd').show();
        }else{
            $('#opd').hide();
        }
    }
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            @CardDefault(['title' => 'Edit Data User'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('user.update',$user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" value="{{ $user->name }}" class="form-control" id="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role : </label>
                        <div class="col-sm-10">
                            @foreach ($role as $key => $item)
                                @php($cek = '')
                                @foreach ($user->roles->whereIn('id',['2','3'])->toArray() as $itemx)
                                    @if ($itemx['id'] == $item->id)
                                    @php($cek = 'checked')
                                @endif
                            @endforeach

                            <label class="mr-3">
                                <input type="radio" name="role" value="{{$item->name}}" {{ $cek }}
                                onchange="roleChange({{$item->id}})">
                                {{$item->name}}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row" id="opd">
                    <label for="opd" class="col-sm-2 col-form-label">OPD : </label>
                    <div class="col-sm-10">
                        @php($opdId = '')
                        @if ($user->opds)
                            @php($opdId = $user->opds->id)
                        @endif
                        <select name="opd" class="form-control">
                            <option value="">.:: Pilih Data OPD ::.</option>
                            @foreach ($masterOpd as $item)
                            <option value="{{$item->id}}" 
                                {{ $opdId == $item->id ? 'selected' : '' }}
                            >
                                {{$item->text}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <a class="btn btn-outline-danger" href="{{ Route('user.index') }}">
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
