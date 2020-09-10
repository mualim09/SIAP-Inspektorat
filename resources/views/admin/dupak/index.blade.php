{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 20px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item> 
      <breadcrumb-item>/ Dupak</breadcrumb-item> 
      <breadcrumb-item active>/ Data Dupak</a></breadcrumb-item>
    </breadcrumb>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent d-flex justify-content-between row">
                   <h1 class="col-md-8">{{ __('Data Dupak') }}</h1>
                   <div class="col justify-content-end">
                       <div class="form-group row">                    
                            <form class="form-inline">
                              <div class="form-group mb-2 ">
                                <label for="tgl-mulai" class="sr-only">{{ __('Tanggal') }}</label>
                                <input type="text" class="form-control datepicker" id="tgl-mulai" name="tgl_mulai" placeholder="{{ __('Tanggal Mulai')}}">
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                                <label for="tgl-akhir" class="sr-only">{{ __('s.d') }}</label>
                                <input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl-akhir" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}">
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm mb-2">Cari</button>
                            </form>
                            
                        </div>
                   </div>
               </div>
                   
                <div class="card-body">
                    @include('admin.dupak.form_isi_dupak')
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#pengawasan">Pengawasan</a></li>
                      <li><a data-toggle="tab" href="#pendidikan">Pendidikan</a></li>
                      <li><a data-toggle="tab" href="#penunjang">Penunjang</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="pengawasan" class="tab-pane fade in active">
                        <h3>Angka Kredit Pengawasan</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-bordered ajax-table" id="dupak-pengawasan-table">                                   
                            </table>
                        </div>
                      </div>
                      <div id="pendidikan" class="tab-pane fade">
                        <h3>Angka Kredit Pendidikan</h3>
                        <p>Some content in menu 1.</p>
                      </div>
                      <div id="penunjang" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Some content in menu 2.</p>
                      </div>
                    </div>                 
                                        
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.dupak.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
@endpush