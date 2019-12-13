<a href="{{ route('opd.edit',$id) }}" class="btn btn-warning btn-sm my-1">
    <i class="fa fa-pencil-square"></i>
    Edit
</a>

<button class="btn btn-danger btn-sm my-1" data-toggle="modal" data-target="#modal-delete{{$id}}">
    <i class="fa fa-trash"></i>
    Hapus
</button>
<div  id="modal-delete{{$id}}" class="modal fade bd-example-modal-sm"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm ">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Hapus?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('opd.destroy',$id) }}" method="post" class="d-flex justify-content-center">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button class="btn btn-primary btn-sm mr-1" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-refresh"></i>
                        TIDAK
                    </button>
                    <button class="btn btn-outline-danger btn-sm ml-1">
                        <i class="fa fa-remove"></i>
                        YA
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>