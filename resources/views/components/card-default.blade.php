<div class="card" style="width: 100%;">

    <div class="card-header">
        {{ $title }}
        <div class="float-right">
            @stack('card-button')
        </div>
    </div>

    <div class="card-body">
        <div style="width: 100%">

            {{ $slot }}
            
        </div>
    </div>

</div>