{{-- Navbar for unauthenticated users--}}
<nav class="navbar navbar-top navbar-expand-md navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <!-- penambahan style gambar logo hir -->
            <img src="{{ asset('assets/img/brand/logo_dinas.png') }}" style="height:50px !important; margin-left: 50%;" />
            <!-- sampai hir -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('admin') }}">
                            <img src="{{ asset('assets/img/brand/logo_dinas.png') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navbar items -->
            <ul class="navbar-nav align-items-center d-flex d-md-flex menu-nav-kiri">
                <!-- <li class="nav-item">                    
                    <a class="nav-link nav-link-icon" href="{{ route('admin') }}">
                        <i class="ikon ni ni-istanbul"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('Beranda') }}</span>
                    </a>
                </li> -->
                <li class="nav-item dropdown">                    
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ikon ni ni-single-copy-04"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('Dokumen') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">                        
                        <a  class="dropdown-item" href="{{ url('/admin/spt') }}"><i class="ikon ni ni-bullet-list-67"></i><span id="menu_id">{{ __('Data SPT') }}</span></a>
                        @hasanyrole('Super Admin|TU Perencanaan')
                        <a class="dropdown-item" href="{{ url('/admin/jenis-spt') }}"><i class="ikon ni ni-book-bookmark"></i><span id="menu_id">{{ __('Data Jenis SPT') }}</span></a>
                        <a class="dropdown-item" href="{{ url('/admin/lokasi') }}"><i class="ikon ni ni-map-big"></i><span id="menu_id">{{ __('Informasi Lokasi Pemeriksaan') }}</span></a>
                        <a class="dropdown-item" href="{{ url('/admin/kode') }}"><i class="ikon ni ni-ruler-pencil"></i><span id="menu_id">{{ __('Informasi Kode Temuan') }}</span></a>
                        <a class="dropdown-item" href="{{ route('calendar')}}"><i class="ikon ni ni-calendar-grid-58"></i><span id="menu_id" class="nav-link-inner--text">{{ __('Calendar') }}</span></a>
                        @endhasanyrole
                        @hasanyrole('Super Admin|Administrasi Umum')
                        <a class="dropdown-item" href="{{ route('satgas_ppm')}}"><i class="ikon fa fa-hand-point-right"></i><span id="menu_id" class="nav-link-inner--text">{{ __('Penunjukan Pejabat') }}</span></a>
                        @endhasanyrole

                        <!-- @if(auth()->user()->menuPpm() === true || auth()->user()->hasAnyRole(['Super Admin']))
                        
                        @endif -->
                    </div>
                </li>

                @hasanyrole('Super Admin|Administrasi Umum')
                <li class="nav-item dropdown">                    
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ikon ni ni-single-02"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('Kepegawaian') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a  class="dropdown-item" href="{{ url('/admin/users') }}"><i class="ikon ni ni-single-02"></i><span id="menu_id">{{ __('Data Pegawai') }}</span></a>

                        @hasanyrole('Super Admin')
                        <a  class="dropdown-item" href="{{ route('viewlog') }}"><i class="ikon ni ni-user-run"></i><span id="menu_id">{{ __('Kegiatan User') }}</span></a>
                        @endhasanyrole

                        @can('Administer roles & permissions')
                        <a  class="dropdown-item" href="{{ route('roles.index') }}"><i class="ikon ni ni-lock-circle-open"></i><span id="menu_id">{{ __('Role') }}</span></a>
                        <a class="dropdown-item" href="{{ route('permissions.index') }}"><i class="ikon ni ni-check-bold"></i><span id="menu_id">{{ __('Permission') }}</span></a>
                        @endcan
                    </div>
                </li>
                @endhasanyrole

                @hasanyrole('Super Admin|Administrasi Umum|Auditor')
                <li class="nav-item dropdown">                    
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="ikon ni ni-bullet-list-67"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('Dupak') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">                        
                        <a  class="dropdown-item" href="{{ route('list_dupak') }}"><i class="ikon ni ni-bullet-list-67"></i><span id="menu_id">{{ __('Data Dupak') }}</span></a>
                        @hasanyrole('Super Admin|Administrasi Umum')
                        <!-- <a class="dropdown-item" href="{{ route('reviu_dupak') }}"><i class="ni ni-book-bookmark"></i><span>{{ __('Reviu Dupak') }}</span></a> -->
                        @endhasanyrole
                    </div>
                </li>
                @endhasanyrole   

                @hasanyrole('Auditor')
               
                @endhasanyrole
                <!-- auth()->user()->hasAnyRole(['Super Admin']) -->
                <!-- @if(auth()->user()->menuPpm() === true || auth()->user()->hasAnyRole(['Super Admin']))
                <li class="nav-item dropdown">                    
                    <a class="nav-link nav-link-icon dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-universal-access" aria-hidden="true"></i>
                        <span id="menu_id" class="nav-link-inner--text">{{ __('SATGAS') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">                        
                        
                    </div>
                </li>
                @endif -->
                <!-- end -->

            </ul>

            @if(config('rivela.searchbar')==true)
            <!-- Form search-->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
            </form>
            @endif

            @include('layouts.navbars.navs.user')
        </div>
    </div>
</nav>