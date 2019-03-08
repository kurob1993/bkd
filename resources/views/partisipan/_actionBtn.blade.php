@if ( $username == Auth::user()->username )
    @can('create partisipans')
    <a href="{{ route('partisipan.create',['id'=>$id]) }}" class="btn btn-primary btn-sm my-1">
        <i class="fa fa-user-circle"></i>
        Partisipan (+)
    </a>
    @endcan
    @can('create notulens')
    <a href="{{ route('notulis.create',['id'=>$id]) }}" class="btn btn-success btn-sm my-1">
        <i class="fa fa-pencil-square"></i>
        Notulis (+)
    </a>
    @endcan
@endif