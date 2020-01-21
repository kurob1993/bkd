@extends('core-ui.layouts.app') 
    @push('style')
        <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendors/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
        <style>
        .stage {
            width: 20%;
            height: 25px;
            margin: 0 auto;
            margin-top:10px;
            border: none;
            border:solid 1px #ccc;
            border-radius: 10px;
        }
        </style>
    @endpush 
    @push('script')
        <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('vendors/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                load("{{ route('honorer.show','') }}/all");
            });

            function load(url) {
                $('#dataTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: "{{ route('honorer.show','') }}/all",
                    columns: [
                        {data: 'id',
                            render: function(data, type, row, meta) {
                                return row.employee_status.text+'_'+data;
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
                        {data: 'jenis_kelamin',
                            render: function(data, type, row, meta) {                             
                                return row.jenis_kelamin_text;
                            }
                        },
                        {data: 'pendidikan'},
                        {data: 'jurusan'},
                        {data: 'no_telepon'},
                        {data: 'npwp'},
                        {data: 'gapok'},
                        {data: 'position_id',
                            render: function(data, type, row, meta) { 
                                if(row.position !== null){
                                    return row.position.text
                                }else{
                                    return '';
                                }
                            }
                        },
                        {data: 'tmt'},
                        {data: 'status_tkk',
                            render: function(data, type, row, meta) {                             
                                return row.status_tkk_text;
                            }
                        },
                        {data: 'employee_status_id',
                            render: function(data, type, row, meta) {                             
                                return row.employee_status.text;
                            }
                        },
                        {data: 'master_opd_id',
                            render: function(data, type, row, meta) { 
                                return row.opds ? row.opds.text : '';
                            }
                        },
                        {data: 'stage_id',
                            render: function(data, type, row, meta) {
                                if (data) {
                                    if (data == 1) {
                                        return '<span class="badge badge-secondary">'+row.stage.text+'</span>';
                                    }
                                    if (data == 2) {
                                        return '<span class="badge badge-primary">'+row.stage.text+'</span>';
                                    }
                                }
                                return '';
                            }
                        },
                        {data: 'keterangan'},
                        {data: 'action'}
                    ]
                });
            }

            function reload(value) {
                var table = $('#dataTable').DataTable();
                table.ajax.url( "{{ route('honorer.show','') }}/all?stage="+value ).load();
            }
        </script>
    @endpush

@include('core-ui.layouts._layout')
@section('content')

<div class="row justify-content-center">
    <div class="col m-3">

        @CardDefault(['title' => 'Tenaga Kerja Honorer'])
            @push('card-button')
            <select class="stage mx-1 my-1" onchange="reload(this.value)"> \
                <option value=""> All Stage </option> 
                <option value="1"> Waiting Approval </option> 
                <option value="2"> Approved </option> 
            </select>
            <button type="button" class="btn btn-outline-success btn-sm mx-1 my-1" data-toggle="modal" data-target="#downloadExcel">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                Unduh Excel
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm mx-1 my-1" data-toggle="modal" data-target="#modelId">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                Unduh PDF
            </button>
            <a class="btn btn-outline-danger btn-sm mx-1" href="{{ route('honorer.create') }}">
                <i class="fa fa-plus-circle fa-lg"></i>
                Tambah Data Tenaga Kerja
            </a>
            <button class="btn btn-outline-warning btn-sm mx-1 my-1" data-toggle="modal" data-target="#modalImpor">
                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                Impor Data
            </button>
            @endpush
            
            <table class="table table-hover responsive no-wrap" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th data-priority="1">ID</th>
                        <th>NAMA</th>
                        <th class="none">TTL</th>
                        <th>JK</th>
                        <th class="none">PENDIDIKAN</th>
                        <th>JURUSAN</th>
                        <th class="none">NO TLP</th>
                        <th class="none">NPWP</th>
                        <th class="none">GAPOK</th>
                        <th class="none">POSISI</th>
                        <th class="none">TMT</th>
                        <th>STATUS</th>
                        <th>KATEGORI</th>
                        <th>OPD</th>
                        <th>STAGE</th>
                        <th class="none">KET</th>
                        <th class="all" width="15%">AKSI</th>
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

<!-- Modal -->
<div class="modal fade" id="downloadExcel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unduh Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <form action="{{ route('honorer.excel') }}" method="GET">
            <div class="modal-body">
                <div class="form-group">
                    <label for="employee_status_id">Kategori</label>
                    <select name="employee_status_id" class="form-control" required>
                        <option value="">Pilih Data</option>
                        @foreach ($TipeTk as $item)
                        <option value="{{$item->id}}">{{$item->text}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="opd">OPD</label>
                    <select name="opd" class="form-control" required>
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

<!-- Modal -->
<div class="modal fade" id="modalImpor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Impor Data Tenaga Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <div class="modal-body">
                <form action="{{ Route('honorer.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container-fluid">
                        <input type="file" name="file">
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <a type="button" class="btn btn-secondary" href="{{ Route('honorer.example') }}">Unduh Contoh Data</a>
            </div>
        </div>
    </div>
</div>
@endsection