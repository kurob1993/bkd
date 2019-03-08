@extends('core-ui.layouts.app')

@push('style')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#notulen-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('progres-kerja.show','') }}/all",
        columns: [
            {data: 'id',
                render: function ( data, type, row, meta ) {
                    return meta.row+1;
                }
            },
            {data: 'note'},
            {data: 'start',
                render: function(data, type, row, meta) {
                    return '<b>'+data+'</b> sd <b>'+row.end+'</b>';
                }
            },
            {data: 'pic'},
            {data: 'progres'},
            {data: 'action'}
            
        ]
    });
});
</script>
@endpush

@include('core-ui.layouts._layout')

@section('content')
<div class="row justify-content-center">
    <div class="col m-3">
        <div class="card" style="width: 100%;">

            <div class="card-header">
                Progres Kerja
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table no-wrap" id="notulen-table" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Notulen</th>
                                <th>Due Date</th>
                                <th>Pic</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection