{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: -50px !important;padding-top: 70px;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item>
      <breadcrumb-item>/ Dokumen</breadcrumb-item>  
      <breadcrumb-item active>/ Data Jenis SPT</a></breadcrumb-item>
    </breadcrumb>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent d-flex justify-content-between">
                    <h1 class="text-center">{{ __('Data Jenis SPT') }}</h1>
                    <div class="mb-2 mb-md-0">
                    @hasanyrole('TU Perencanaan|Super Admin')
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#formModal">{{ __('Tambah Jenis SPT') }}</button>
                    @endhasanyrole
                    </div>
                </div>
                <div class="card-body">
                	@include('admin.spt.jenis.form')
                    <div class="table-responsive">
                        <table class="table table-striped table-sm ajax-table" id="jenis-spt-table">
                            
                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.spt.jenis.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-lite.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/summernote/summernote-lite.min.js') }}"></script>
@endpush