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
                                var depan = row.gelar_depan ? row.gelar_depan : '';
                                var belakang = row.gelar_belakang ? row.gelar_belakang : '';                                
                                return depan+ ' ' +row.nama+ ' ' +belakang;
                            }
                        },
                        {data: 'tanggal_lahir'},
                        {data: 'jenis_kelamin'},
                        {data: 'tmt'},
                        {data: 'status_tkk',
                            render: function(data, type, row, meta) {
                                var status_tkk = row.status_tkk == 1 ? 'Aktif' : 'Tidak Aktif';                             
                                return status_tkk;
                            }
                        },
                        {data: 'opds.text'},
                        {data: 'keterangan'}
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
                    </tr>
                </thead>
            </table>
        @endCardDefault()

    </div>
</div>
@endsection