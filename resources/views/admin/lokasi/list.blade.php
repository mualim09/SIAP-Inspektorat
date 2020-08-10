{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: -50px !important;padding-top: 75px;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item>
      <breadcrumb-item>/ Dokumen</breadcrumb-item>  
      <breadcrumb-item active>/ Data Lokasi Pemeriksaan</a></breadcrumb-item>
    </breadcrumb>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent d-flex justify-content-between">
                    <h1 class="text-center">{{ __('Data Lokasi Pemeriksaan') }}</h1>
                </div>
                <div class="card-body row">
                    <div class="col-md-6" style="border-right: 1px solid #ccc;">
                        <ul id="tree-view">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm ajax-table" id="lokasi-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>{{ __('Lokasi') }}</th>
                                            <th>{{ __('Jenis Lokasi') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h3>{{ __('Tambah Lokasi')}}</h3> <br>
                        @include('admin.lokasi.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.lokasi.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">    
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
