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
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered ajax-table" id="list-dupak-table">
                            <thead>
                            <tr>
                                <th rowspan="3" width="1" valign="middle" class="text-center">{{ __('No') }}</th> 
                                <th rowspan="3" valign="middle" class="text-center">{{ __('Nama') }}</th>
                                <th rowspan="3" valign="middle" class="text-center">{{ __('NIP') }}</th>
                                <th colspan="6" class="text-center">{{ __('Dupak') }}</th>
                                <th rowspan="3" valign="middle" class="text-center">{{ __('Action') }}</th> 
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">{{ __('Pendidikan') }}</th>
                                <th colspan="2" class="text-center">{{ __('Utama') }} </th>
                                <th colspan="2" class="text-center">{{ __('Penunjang') }} </th>
                            </tr>
                            <tr>
                                <th>{{ __('Lama') }}</th>
                                <th>{{ __('Baru') }} </th>
                                <th>{{ __('Lama') }} </th>
                                <th>{{ __('Baru') }} </th>
                                <th>{{ __('Lama') }} </th>
                                <th>{{ __('Baru') }} </th>
                            </tr>
                            
                            </thead>
                            <tbody></tbody>
                          
                        </table>
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