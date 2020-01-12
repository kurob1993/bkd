<div class="card" style="width: 100%;">

    <div class="card-header">
        {!! $title !!}
        <span class="float-xl-right" id="card-button">
            @stack('card-button')
        </span>
    </div>

    <div class="card-body">
        <div style="width: 100%">

            {{ $slot }}
            
        </div>
    </div>

</div>