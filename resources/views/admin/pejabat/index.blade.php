{{-- Pejabat index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 20px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Dashboard</a></breadcrumb-item> 
      <breadcrumb-item>/ Kepegawaian</breadcrumb-item> 
      <breadcrumb-item active>/ Penunjukan Pejabat</a></breadcrumb-item>
    </breadcrumb>
	<div class="row">
        <div class="col">
            <!-- <div class="card shadow"> -->
                <!-- <div class="card-header bg-transparent text-center">
                    <h1 class="">{{ __('Penunjukan Pejabat') }}</h1>
                </div> -->
                <div class="alert"></div>
                <!-- <div class="card-body"> -->
                    @include('admin.pejabat.form')
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>
</div>

@include('layouts.footers.auth')

@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>    
@endpush