@push('script')
<script>
$(document).ready(function() {
    $('#progress-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('progres-kerja.listproker') }}?id={{ $notulen->id }}",
        columns: [
            {data: 'id',
                render: function ( data, type, row, meta ) {
                    return meta.row+1;
                }
            },
            {data: 'proker'},
            {data: 'pic'},
            {data: 'realisasi'},
            {data: 'action'}
            
        ]
    });
});
</script>
@endpush
<div class="row justify-content-center">
    <div class="col mx-3 mt-2">
        <div class="card" style="width: 100%;">

            <div class="card-header">
                Daftar Program Kerja
            </div>
            
            <div class="card-body">
                <table class="table no-wrap" id="progress-table" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Proker</th>
                            <th>Pic</th>
                            <th>Progress (%)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>