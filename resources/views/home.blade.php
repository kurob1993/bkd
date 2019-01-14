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
            <div class="card bg-primary">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
