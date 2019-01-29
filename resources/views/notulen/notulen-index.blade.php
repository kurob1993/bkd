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
        ajax: "{{ route('notulen.show','') }}/all",
        columns: [
            {data: 'id',
                render: function ( data, type, row, meta ) {
                    return meta.row+1;
                }
            },
            {data: 'judul'},
            {data: 'date',
                render: function ( data, type, row, meta ) {
                    return row.tanggal;
                }
            },
            {data: 'action'}
            
        ]
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
            <div class="card" style="width: 100%;">

                <div class="card-header">
                    Notulen Rapat Koordinasi
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table no-wrap" id="notulen-table" width="100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th width="10%">Aksi</th>
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
