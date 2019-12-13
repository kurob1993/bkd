@extends('core-ui.layouts.app')

@push('style')
<style></style>
@endpush

@push('script')

@endpush

@include('core-ui.layouts._layout')

@section('content')
<input type="hidden" id="index" value="1">

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            @CardDefault(['title' => 'Tambah Data OPD'])
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{ route('opd.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">OPD : </label>
                        <div class="col-sm-10">
                            <input type="text" name="text" value="{{ old('text') }}" class="form-control" id="text" placeholder="OPD" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-2 col-form-label">KETERANGAN : </label>
                        <div class="col-sm-10">
                            <input type="text" name="ket" value="{{ old('ket') }}" class="form-control" id="email" placeholder="Keterangan">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <a class="btn btn-outline-danger" href="{{ Route('opd.index') }}">
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
