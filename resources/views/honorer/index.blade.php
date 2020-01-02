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
                    ordering: false,
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
                        {data: 'employee_status.text'},
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
            <button type="button" class="btn btn-outline-primary btn-sm mx-1" data-toggle="modal" data-target="#modelId">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                Unduh PDF
            </button>
            <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('honorer.create') }}">
                <i class="fa fa-plus-circle fa-lg"></i>
                Tambah Data Tenaga Kerja
            </a>
            @endpush
            
            <table class="table table-hover responsive no-wrap" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th data-priority="1">ID</th>
                        <th>NAMA</th>
                        <th>TEMPAT, TGL LAHIR</th>
                        <th>JENIS KELAMIN</th>
                        <th>TMT</th>
                        <th>STATUS TKK</th>
                        <th>KATEGORI</th>
                        <th>ORGANISASI PERANGKAT DAERAH</th>
                        <th>KET</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
            </table>
        @endCardDefault()

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unduh PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <form action="{{ route('honorer.pdf') }}" method="GET">
            <div class="modal-body">
                <div class="form-group">
                    <label for="employee_status_id">Kategori</label>
                    <select name="employee_status_id" id="employee_status_id" class="form-control" required>
                        <option value="">Pilih Data</option>
                        @foreach ($TipeTk as $item)
                        <option value="{{$item->id}}">{{$item->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="opd">OPD</label>
                    <select name="opd" id="opd" class="form-control" required>
                        @if (Auth::user()->hasRole('admin opd'))
                            <option value="{{Auth::user()->opds['id']}}" selected>{{Auth::user()->opds['text']}}</option>
                        @else
                            <option value="">Pilih Data</option>
                            @foreach ($MasterOpd as $item)
                            <option value="{{$item->id}}">{{$item->text}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Unduh</button>
            </div>
            </form>

        </div>
    </div>
</div>

@endsection