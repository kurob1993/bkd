@extends('core-ui.layouts.app')

@push('script')
<script src="{{ asset('vendors/chart.js/js/Chart.min.js') }}"></script>
<script src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
{!! $opdNonPns->script() !!}
{!! $opdPendidikan->script() !!}
{!! $opdJenisKelamin->script() !!}
{!! $opdGaji->script() !!}
{!! $opdGajiTkk->script() !!}
{!! $opdGajiTks->script() !!}
{!! $opdGajiHkl->script() !!}
{!! $opdGajiK2->script() !!}
<script>
    $(document).ready(function() {
        $('.opd').select2();
        $('#card-button').css('width','30%');
        var title = $('.opd option:selected').text();   
        $('.title').html(title);     
    });
    function chart(value) {
        window.open("{{ Route('home') }}"+"?opd="+value,"_self");
    }
</script>
@endpush
@push('style')
<link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<style></style>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @CardDefault(['title' => '<img src="'.url('img/logo.png').'" alt="logo ks" width="40px"> <h4 class="ml-3" style="display: inline">DASHBOARD</h4>'])
            @push('card-button')
            <div class="col-xs-10">
                <select class="form-control-sm opd" onchange="chart(this.value)">
                    <option value=""> -- Pilih Data OPD -- </option>
                    @foreach ($mopd as $item)
                        @if ($item->id == $opd)
                        <option value="{{$item->id}}" selected> {{$item->text}} </option>
                        @else
                        <option value="{{$item->id}}"> {{$item->text}} </option>
                        @endif
                    @endforeach
                </select>
            </div>            
            @endpush
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Klasifikasi Kategori Non PNS ( <span class="title"></span> )</h4>
                        <div>
                            {!! $opdNonPns->container() !!}
                        </div>
                      </div>
                    </div>                
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Klasifikasi Pendidikan ( <span class="title"></span> )</h4>
                          <div>
                              {!! $opdPendidikan->container() !!}
                          </div>
                        </div>
                      </div>   
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Klasifikasi Jenis Kelamin ( <span class="title"></span> )</h4>
                            <div>
                                {!! $opdJenisKelamin->container() !!}
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Klasifikasi Gaji Per OPD</h4>
                            <div style="position: relative; height:40vh; width:80vw;">
                                {!! $opdGaji->container() !!}
                            </div>
                        </div>
                    </div>  
                </div>
                
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                            <div class="text-value">Rp. {{ number_format( $totalTkk ) }}</div>
                            <div>Total Gaji TKK</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            {!! $opdGajiTkk->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-success">
                        <div class="card-body pb-0">
                            <div class="text-value">Rp. {{ number_format( $totalTks ) }}</div>
                            <div>Total Gaji TKS</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            {!! $opdGajiTks->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body pb-0">
                            <div class="text-value">Rp. {{ number_format( $totalHkl ) }}</div>
                            <div>Total Gaji HKL</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            {!! $opdGajiHkl->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body pb-0">
                            <div class="text-value">Rp. {{ number_format( $totalK2 ) }}</div>
                            <div>Total Gaji K2</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            {!! $opdGajiK2->container() !!}
                        </div>
                    </div>
                </div>

            </div>

        @endCardDefault()
    </div>
</div>
@endsection