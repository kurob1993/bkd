<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i> DASHBOARD
                </a>
            </li>

            <li class="nav-title">Menu</li>
            @role('administrator|admin super')
            <li class="nav-item nav-dropdown {{ 
                (
                    (Request::segment(1) == 'pengguna')
                ) 
                    ? 
                'active open' : '' 
            }}">
                <a class="nav-link nav-dropdown-toggle " href="#">
                    <i class="nav-icon icon-people"></i> Pengguna
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ">
                        <a class="nav-link active {{ (Request::segment(2) == 'user') ? 'active' : '' }}" 
                        href="{{ route('user.index') }}">
                            Akun Pengguna
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('admin super')
            <li class="nav-item nav-dropdown {{ (Request::segment(1) == 'master') ? 'active open' : '' }}">
                <a class="nav-link nav-dropdown-toggle " href="#">
                    <i class="nav-icon icon-screen-desktop"></i> Master
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ">
                        <a class="nav-link {{ (Request::segment(2) == 'opd') ? 'active' : '' }}" 
                        href="{{ route('opd.index') }}">
                            Master OPD
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('admin super|admin opd')
            <li class="nav-item nav-dropdown {{ (Request::segment(1) == 'tenaga-kerja') ? 'active open' : '' }}">
                <a class="nav-link nav-dropdown-toggle " href="#">
                    <i class="nav-icon icon-cup"></i> Tenaga Kerja
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ">
                        <a class="nav-link {{ (Request::segment(2) == 'honorer') ? 'active' : '' }}" href="{{ route('honorer.index') }}">
                            Tenaga Kerja Kontrak
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ (Request::segment(2) == 'tks') ? 'active' : '' }}" href="{{ route('tks.index') }}">
                            Tenaga Kerja Sukarela
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ (Request::segment(1) == 'struktur-organisasi') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('struktur-organisasi.index') }}">
                    <i class="nav-icon icon-grid"></i> Struktur Organisasi
                </a>
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