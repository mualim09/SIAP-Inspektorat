{{-- Users index page --}}
@extends('layouts.backend')

{{-- Hanya super admin, TU perencanaan dan Umum yang berhak mengakses list SPT yang akan diberikan penomoran--}}
@hasanyrole('Super Admin|TU Perencanaan')
  @include('admin.spt.penomoran')
@endhasrole

@hasanyrole('Super Admin|TU Umum')
  @include('admin.spt.umum')
@endhasrole

{{-- Hanya Auditor yang berhak mengakses list SPT yang akan diberikan penomoran--}}
@hasanyrole('Auditor')
    @include('admin.laporan.pemeriksaan_kka.index_kka')
@endhasanyrole

@if(auth()->user()->hasRole('Inspektur'))
    @include('admin.laporan.pemeriksaan_kka.tabel_inspektur')
@endif

@include('admin.spt.arsip')


@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item> 
      <breadcrumb-item>/ Dokumen</breadcrumb-item> 
      <breadcrumb-item active>/ Data SPT</a></breadcrumb-item>
    </breadcrumb>
    
    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">           
          <ul class="nav nav-tabs card-header-tabs" id="spt-list" role="tablist">
            @yield('nav_tab_penomoran')
            @yield('nav_tab_spt_umum')
            @yield('nav_tab_arsip')
            @yield('nav_table_inspektur')

            <!-- tombol tambah spt berdasarkan role -->
            <li class="nav-item ml-auto">
            @hasanyrole('Super Admin|TU Perencanaan')            
                <button id="btn-new-spt" type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formModal">{{ __('Tambah SPT') }}</button>             
            @endhasrole
            @hasanyrole('Super Admin|TU Umum')
                <button id="btn-new-spt-umum" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#formSptUmum">{{ __('Tambah SPT Umum') }}</button>
            @endhasrole
            </li>            
            <!-- end tombol tambah spt -->

          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
            @yield('tab_content_penomoran')
            @yield('tab_content_spt_umum')
            @yield('tab_content_arsip')
            @yield('content_auditor')
            @yield('content_inspektur')
            @yield('tab_content_ppm')
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
  @yield('js_tabel_auditor')
  @yield('form_penomoran')
  @yield('js_penomoran')
  @yield('js_umum')
  @yield('js_arsip')
  @yield('js_tabel_inspektur')

</div>
<!-- core spt js and form -->
@include('admin.spt.form')
@include('admin.spt.js')
<!-- end core spt -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
