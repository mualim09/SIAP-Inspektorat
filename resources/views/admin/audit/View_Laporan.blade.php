{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: -50px !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <h1>{{ __('Form Upload Laporan') }}</h1>
                    </div>
                    @include('admin.audit.form')
                </div>             
            </div>
        </div>
    </div>
</div>
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
@endpush