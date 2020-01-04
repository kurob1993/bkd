@extends('core-ui.layouts.app') 
    @push('style')
        <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
        <style></style>
    @endpush 
    @push('script')
        <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('posisi.show','all') }}",
                    columns: [
                        {data: 'id',
                            render: function(data, type, row, meta) {
                                return 'POSITION_'+data;
                            }
                        },
                        {data: 'text'},
                        {data: 'master_opd_id',
                            render: function(data, type, row, meta) {
                                console.log(row);
                                
                                return row.opd.text;
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

<div class="row justify-content-center">
    <div class="col m-3">

        @CardDefault(['title' => 'Master Posisi'])
            @push('card-button')
            <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('posisi.create') }}">
                <i class="fa fa-plus-circle fa-lg"></i>
                Tambah Data Posisi
            </a>
            @endpush
            
            <table class="table table-hover responsive no-wrap" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th data-priority="1">NO</th>
                        <th>POSISI</th>
                        <th>ORGANISASI PERANGKAT DAERAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
            </table>
        @endCardDefault()

    </div>
</div>
@endsection