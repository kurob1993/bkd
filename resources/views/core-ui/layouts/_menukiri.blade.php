<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i> DASHBOARD
                </a>
            </li>

            <li class="nav-title">Menu</li>
            @role('administrator')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="nav-icon icon-people"></i> Pengguna</a>
            </li>
            @endrole
            {{-- @can('read materis')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('materi.index') }}">
                    <i class="nav-icon icon-list"></i> Materi</a>
            </li>
            @endcan
            @can('read partisipans')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('partisipan.index') }}">
                    <i class="nav-icon icon-user-follow"></i> Partisipan & Notulis</a>
            </li>
            @endcan
            @can('read notulens')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notulen.index') }}">
                    <i class="nav-icon icon-note"></i> Notulen</a>
            </li>
            @endcan
            @can('read pic')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('progres-kerja.index') }}">
                    <i class="nav-icon icon-pie-chart"></i> Progres Kerja</a>
            </li>
            @endcan --}}
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>