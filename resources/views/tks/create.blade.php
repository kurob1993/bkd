@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
<style></style>
@endpush

@push('script')
<script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        jQuery('#tanggal_lahir').datetimepicker({            
            timepicker:false,
            format:'d.m.Y',
            lang:'id'
        });
        jQuery('#tmt').datetimepicker({
            timepicker:false,
            format:'d.m.Y',
            lang:'id'
        });
    });
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            @CardDefault(['title' => 'Tambah Data Tenaga Kerja'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('tks.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                        <div class="col-sm-2">
                            <input type="text" name="gelar_depan" value="{{ old('gelar_depan') }}" class="form-control" 
                            id="gd" placeholder="Gelar Depan">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control"
                            id="text" placeholder="Nama" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="gelar_belakang" value="{{ old('gelar_belakang') }}" class="form-control" 
                            id="gk" placeholder="Gelar Belakang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir : </label>
                        <div class="col-sm-10">
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control" 
                            id="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir : </label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control" 
                            id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin : </label>
                        <div class="col-sm-10">
                            <select name="jenis_kelamin" id="jk" class="form-control" required>
                                <option value="">Pilih Data</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan : </label>
                        <div class="col-sm-10">
                            <input type="text" name="pendidikan" value="{{ old('pendidikan') }}" class="form-control" \
                            id="pendidikan" placeholder="Pendidikan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt" class="col-sm-2 col-form-label">TMT : </label>
                        <div class="col-sm-10">
                            <input type="text" name="tmt" value="{{ old('tmt') }}" class="form-control" id="tmt" 
                            placeholder="TMT"  autocomplete="Off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_tkk" class="col-sm-2 col-form-label">STATUS TKK : </label>
                        <div class="col-sm-10">
                            <select name="status_tkk" id="status_tkk" class="form-control" required>
                                <option value="">Pilih Data</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="opd" class="col-sm-2 col-form-label">OPD : </label>
                        <div class="col-sm-10">
                            <select name="master_opd_id" id="opd" class="form-control" required>
                                @if (Auth::user()->master_opd_id)
                                    <option value="{{Auth::user()->opds->id}}" selected>{{Auth::user()->opds->text}}</option>
                                @else
                                    <option value="">Pilih Data</option>
                                    @foreach ($MasterOpd as $item)
                                    <option value="{{$item->id}}">{{$item->text}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-2 col-form-label">Keterangan : </label>
                        <div class="col-sm-10">
                            <input type="text" name="ket" id="ket" class="form-control" value="{{ old('ket') }}" >
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-outline-danger" href="{{ Route('tks.index') }}">
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
