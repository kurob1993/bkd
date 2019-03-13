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
            <div class="card" style="width: 100%;">

                <div class="card-header">
                    Edit Data User Rakordir
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

                                    <label>
                                        <input type="radio" name="role" value="{{$item->name}}" {{ $cek }}>
                                        {{$item->name}}
                                    </label><br>
                                @endforeach

                                
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

                    <div class="alert alert-info">
                        <p>
                            Role <b>Admin</b> adalah role yang bertugas untuk membuat jadwal rapat, 
                            menambahlan <b>partisipan</b> dan menunjuk <b>notulis</b> <br>
                            
                            Role <b>User</b> adalah minimal role yang bisa mengakses aplikasi rakordir
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
