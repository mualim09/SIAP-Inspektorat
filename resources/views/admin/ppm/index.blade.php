{{-- PPM index page --}}
@extends('layouts.backend')


@include('admin.ppm.tb_ppm')


@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Dashboard</a></breadcrumb-item> 
      <breadcrumb-item>/ Dokumen</breadcrumb-item> 
      <breadcrumb-item active>/ PPM</a></breadcrumb-item>
    </breadcrumb>
    
    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header"> 
          <ul class="nav nav-tabs card-header-tabs" id="spt-list" role="tablist">
            <!-- tab button -->
            <li class="nav-item ml-auto">
                <button id="btn-input-ppm" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#formPpm" style="margin-bottom: 20px;">{{ __('Tambah PPM') }}</button>
            </li>

          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
          <!-- content -->
            @yield('content_ppm')
            @include('admin.ppm.form_ppm')
          </div>
        </div>
    </div>     
  </div>

  <script type="text/javascript">
    $('#spt-list a').on('click', function (e) {
      e.preventDefault()
      $(this).tab('show')
    });
    //show the first tab
    $('.nav-tabs a:first').tab('show')
  </script>

</div>

@yield('js_ppm')

@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>    
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
