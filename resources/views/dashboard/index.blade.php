@extends('core-ui.layouts.app')

@push('script')
<script></script>
@endpush
@push('style')
<style></style>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                
                <div class="card-header">
                    <div class="text-center">
                        <img src="{{ url('img/logo.png') }}" alt="logo ks" width="200px" >
                    </div>
                </div>

                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection