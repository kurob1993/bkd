@foreach ($reporters as $item)
    @if (Auth::user()->id == $item['user_id'])
        <a class="btn btn-sm btn-primary" href="{{ route('notulen.create') }}?id={{$id}}">
            <i class="fa fa-pencil-square"></i>
            Catatan
        </a>
    @endif
    <a class="btn btn-sm btn-success" href="{{ route('notulen.view',$id) }}">
        <i class="fa fa-eye"></i>
        Lihat
    </a>
@endforeach
