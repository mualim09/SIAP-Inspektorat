<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8 default-color">
    <div class="container-fluid">
        <div class="header-body" style="margin-top: 70px;">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">SPT dalam peninjauan</h5>
                                    <span class="h2 font-weight-bold mb-0">{{count($spt['unsigned'])}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ url('/admin/spt')}}">
                                <span class="text-nowrap">Lihat daftar SPT</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">SPT yang ditolak</h5>
                                    <span class="h2 font-weight-bold mb-0">{{count($spt['rejected'])}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ url('/admin/spt')}}">
                                <span class="text-nowrap">Lihat daftar SPT</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">SPT yang disetujui</h5>
                                    <span class="h2 font-weight-bold mb-0">{{count($spt['approved'])}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ url('/admin/spt')}}">
                                <span class="text-nowrap">Lihat daftar SPT</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Lihat Laporan</h5>
                                    <span class="h2 font-weight-bold mb-0">100%</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ url('/lihatLaporan')}}">
                                <span class="text-nowrap">Lihat Upload Laporan</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>