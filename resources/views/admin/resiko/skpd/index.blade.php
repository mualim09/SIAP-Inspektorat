{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7" style="margin-top: -50px !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent ">
                    <h1 class=""><center>{{ __('Form Resiko') }}</center></h1>
                  <div class="card-body">
                      @include('admin.resiko.skpd.form')
                  </div>
                </div>
                                  
            </div>
        </div>
    </div>
</div>
@include('admin.resiko.skpd.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
@endpush