<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i> Backdrop
                </a>
            </li>

            <li class="nav-title">Menu</li>
            @role('administrator')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-drop"></i> User</a>
            </li>
            @endrole
            @can('read materis')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('materi.index') }}">
                    <i class="nav-icon icon-drop"></i> Materi</a>
            </li>
            @endcan
            @can('read partisipans')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('partisipan.index') }}">
                    <i class="nav-icon icon-drop"></i> Partisipan & Notulis</a>
            </li>
            @endcan
            @can('read notulens')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notulen.index') }}">
                    <i class="nav-icon icon-drop"></i> Notulen</a>
            </li>
            @endcan
            @can('read pic')
            <li class="nav-item">
                <a class="nav-link" href="colors.html">
                    <i class="nav-icon icon-drop"></i> Progres Kerja</a>
            </li>
            @endcan

            {{-- <li class="nav-title">Components</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-puzzle"></i> Base
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="base/breadcrumb.html">
                            <i class="nav-icon icon-puzzle"></i> Breadcrumb</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>