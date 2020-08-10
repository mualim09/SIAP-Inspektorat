{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: -50px !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center" style="margin-bottom: 40px;">
                        <h1>{{ __('Uploaded Laporan Data') }}</h1>
                    </div>
                    <div class="table-responsive">                        
                        <table class="table table-striped table-sm ajax-table" id="laporan-table">
                            <thead>
                            
                            </thead>
                            <tbody></tbody>                          
                        </table>
                    </div>
                    <!-- <h4>1. fungsi button download belum bisa <br>2. fungsi preview doc belum ada<br>3. semua auditor masih bisa melihat data(seharusnya auditor terkait yg bisa melihat data tsb)</h4> -->

                    <h4>2. fitur preview doc belum ada<br>3. can't delete file in storage</h4>

                </div>            
            </div>
        </div>
    </div>
</div>
@include('admin.spt.jslaporan')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
@endpush

