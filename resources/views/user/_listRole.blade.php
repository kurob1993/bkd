@foreach ($roles as $item)
    <span class="badge badge-dark">
        {{ $item['name'] }} 
    </span>
@endforeach
@if ($opds)
<br>
<span class="badge badge-primary">
    {{$opds['text']}}
</span>
@endif

