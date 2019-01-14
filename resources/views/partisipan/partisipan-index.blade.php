@extends('core-ui.layouts.app') @push('style')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<style></style>

@endpush @push('script')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('partisipan.show','') }}/all",
        columns: [
            {data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row+1;
                }
            },
            {data: 'judul'},
            {data: 'partisipan'}
        ]
    });
});
function pdf(file) {
    var win = window.open( url()+file ,'_blank');
    win.focus();
}
</script>

@endpush
    @include('core-ui.layouts._layout') 
@section('content')
<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card" style="width: 100%;">

                <div class="card-header">
                    Partisipan Rapat Koordinasi
                    @can('create materis')
                    <div class="float-right">
                        <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('partisipan.create') }}">
                            <i class="fa fa-plus-circle fa-lg"></i>
                            Tambah Data
                        </a>
                    </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover responsive no-wrap" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Partisipan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection