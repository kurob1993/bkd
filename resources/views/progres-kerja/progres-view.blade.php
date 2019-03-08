@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script>
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
@include('progres-kerja._list-proker')
@endsection