@extends('core-ui.layouts.app')

@push('style')
<style></style>
@endpush

@push('script')
<script>
    $(document).ready(function() {
        $('#opd').hide();
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
            @CardDefault(['title' => 'Tambah Data User'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" id="nama" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password : </label>
                        <div class="col-sm-10">
                            <input type="text" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role : </label>
                        <div class="col-sm-10">
                            @foreach ($role as $key => $item)
                                <label class="mr-3">
                                    <input type="radio" name="role" value="{{$item->name}}" required
                                        onchange="roleChange({{$item->id}})"
                                    >
                                    {{$item->name}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row" id="opd">
                        <label for="opd" class="col-sm-2 col-form-label">OPD : </label>
                        <div class="col-sm-10">
                            <select name="opd" class="form-control">
                                <option value="">.:: Pilih Data OPD ::.</option>
                                @foreach ($masterOpd as $item)
                                <option value="{{$item->id}}">{{$item->text}}</option>
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
                            <button type="reset" class="btn btn-outline-warning">
                                <i class="fa fa-recycle"></i>
                                Bersihkan
                            </button>
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
