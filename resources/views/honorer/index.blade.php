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
                    ajax: "{{ route('honorer.show','') }}/all",
                    columns: [
                        {data: 'id',
                            render: function(data, type, row, meta) {
                                return 'TKK_'+data;
                            }
                        },
                        {data: 'nama',
                            render: function(data, type, row, meta) {
                                var depan = row.gelar_depan ? row.gelar_depan+' ' : '';
                                var belakang = row.gelar_belakang ? ', '+row.gelar_belakang : '';                                
                                return depan+row.nama+belakang;
                            }
                        },
                        {data: 'tanggal_lahir',
                            render: function(data, type, row, meta) {
                                var tempat_lahir = row.tempat_lahir;
                                var tangagl_lahir = row.tanggal_lahir;                               
                                return tempat_lahir+', '+tangagl_lahir;
                            }
                        },
                        {data: 'jenis_kelamin_text'},
                        {data: 'tmt'},
                        {data: 'status_tkk_text'},
                        {data: 'opds.text'},
                        {data: 'keterangan'},
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

        @CardDefault(['title' => 'Tenaga Kerja Honorer'])
            @push('card-button')
            <a class="btn btn-outline-success btn-sm mx-1" href="">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                Unduh Excel
            </a>
            <a class="btn btn-outline-primary btn-sm mx-1" href="{{ route('honorer.pdf') }}">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                Unduh PDF
            </a>
            <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('honorer.create') }}">
                <i class="fa fa-plus-circle fa-lg"></i>
                Tambah Data Tenaga Kerja
            </a>
            @endpush
            
            <table class="table table-hover responsive no-wrap" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th data-priority="1">NO</th>
                        <th>NAMA</th>
                        <th>TEMPAT, TGL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>TMT</th>
                        <th>STATUS TKK</th>
                        <th>ORGANISASI PERANGKAT DAERAH</th>
                        <th>KET</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
            </table>
        @endCardDefault()

    </div>
</div>
@endsection