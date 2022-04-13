<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/back-dashboard">
        <div class="sidebar-brand-icon">
        <i><img src="{{asset('image/logo/logo.svg')}}" style="width: 60%;" alt="Logo"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BPBD BWS</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item @if (Request::segment(1) == 'back-dashboard') active @endif">
        <a class="nav-link" href="{{url('/back-dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Bencana
    </div>

    <li class="nav-item @if (Request::segment(1) == 'back-kategori-bencana') active @endif">
        <a class="nav-link" href="{{url('/back-kategori-bencana')}}">
            <i class="fas fa-fw fa-vector-square"></i>
            <span>Kategori Bencana</span>
        </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'back-mitigasi') active @endif">
        <a class="nav-link" href="{{url('/back-mitigasi')}}">
            <i class="fas fa-fw fa-shield-alt"></i>
            <span>Mitigasi Bencana</span>
        </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'back-laporan-bencana') active @endif">
        <a class="nav-link" href="{{url('/back-laporan-bencana')}}">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Laporan Bencana</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        MENU
    </div>

    <li class="nav-item @if (Request::segment(1) == 'back-berita') active @endif">
        <a class="nav-link" href="{{url('/back-berita')}}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Berita</span>
        </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'back-berita') active @endif">
        <a class="nav-link" href="{{ route('back-laporan.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Laporan</span>
        </a>
    </li>
    {{-- <li class="nav-item @if (Request::segment(1) == 'back-instagram-embed') active @endif">
        <a class="nav-link" href="{{url('/back-instagram-embed')}}">
            <i class="fas fa-fw fa-paperclip"></i>
            <span>Embed Instagram</span>
        </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'back-feedback') active @endif">
        <a class="nav-link" href="{{url('/back-feedback')}}">
            <i class="fas fa-fw fa-comment-alt"></i>
            <span>Feedback</span>
        </a>
    </li> --}}
    {{-- @role('Superadmin')
    <li class="nav-item @if ($onSide == 'pekerjaan' || $onSide == 'statusHubungan' || $onSide == 'dusun') active @endif">
        <a class="nav-link @if ($onSide == 'pekerjaan' || $onSide == 'statusHubungan' || $onSide == 'dusun') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-box"></i>
            <span>Master</span>
        </a>
        <div id="collapseMaster" class="collapse @if ($onSide == 'pekerjaan' || $onSide == 'statusHubungan' || $onSide == 'dusun') show @endif" aria-labelledby="headingPortfolio" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Master : </h6>
                <a class="collapse-item @if ($onSide == 'pekerjaan') active @endif" href="{{url('/back-master/pekerjaan')}}">Pekerjaan</a>
                <a class="collapse-item @if ($onSide == 'statusHubungan') active @endif" href="{{url('/back-master/status-hubungan')}}">Status Hubungan</a>
                <a class="collapse-item @if ($onSide == 'dusun') active @endif" href="{{url('/back-master/dusun')}}">Dusun</a>
                <a class="collapse-item @if ($onSide == 'bidan') active @endif" href="{{url('/back-master/bidan')}}">Bidan</a>
                <a class="collapse-item @if ($onSide == 'perawat') active @endif" href="{{url('/back-master/perawat')}}">Perawat</a>
                <a class="collapse-item @if ($onSide == 'kader') active @endif" href="{{url('/back-master/kader')}}">Kader</a>
                <a class="collapse-item @if ($onSide == 'nomor_kader') active @endif" href="{{url('/back-master/nomor_kader')}}">No. Darurat Kader</a>
                <a class="collapse-item @if ($onSide == 'nomor_kades') active @endif" href="{{url('/back-master/nomor_kades')}}">No. Darurat Kades</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
