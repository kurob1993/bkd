@extends('core-ui.layouts.app') 
    @push('style')
        <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
        <style></style>
    @endpush 
    @push('script')
        <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // $('#dataTable').DataTable({
                //     responsive: true,
                //     processing: true,
                //     serverSide: true,
                //     ajax: "{{ route('user.show','') }}/all",
                //     columns: [
                //         {data: 'id',
                //             render: function(data, type, row, meta) {
                //                 return meta.row+1;
                //             }
                //         },
                //         {data: 'name'},
                //         {data: 'username'},
                //         {data: 'email'},
                //         {data: 'roles'},
                //         {data: 'action'}
                //     ]
                // });
            });
        </script>
    @endpush

@include('core-ui.layouts._layout')
@section('content')

<div class="row justify-content-center">
    <div class="col m-3">

        @CardDefault(['title' => 'Role'])
            @push('card-button')
            <a class="btn btn-outline-danger btn-sm mx-1" href="">
                <i class="fa fa-plus-circle fa-lg"></i>
                Tambah Data User
            </a>
            @endpush
            
            <table class="table table-hover responsive no-wrap" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th>Nama</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        @endCardDefault()

    </div>
</div>
@endsection