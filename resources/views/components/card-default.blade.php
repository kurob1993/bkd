<div class="card" style="width: 100%;">

    <div class="card-header">
        {{ $title }}
        <div class="float-right">
            @stack('card-button')
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            {{ $slot }}
            
        </div>
    </div>

</div>