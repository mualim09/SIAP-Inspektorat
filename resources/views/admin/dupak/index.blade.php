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

                <div class="card-body">
                    <div class="col-md-12 justify-content-between row">
                       

                       <!-- dibawah ini adalah form pencariandupak berdasarkan nama auditor, semester dan tahun -->
                       <div class="col-md-6 mb-3">
                            @include('admin.dupak.form_cari')
                       </div>
                    </div>
                    
                    <div id="btn-show-dupak" class="col-md-12 row justify-content-end" style="margin-bottom: 30px;">
                      <!-- <button onclick="printDiv('calendar-user')" class="btn btn-default" >Print Calendar</button> -->
                      <!-- <button onclick="printJS('calendar-user', 'html')" class="btn btn-default" >Print Calendar</button> -->
                      <button onclick="printDiv('print-dupak')" class="btn btn-default" >Print AK</button>
                    </div>                    

                    <ul class="nav nav-tabs justify-content-end" id="dupak-tab" >
                     <!-- generated tab content -->
                    </ul>

                    <div class="tab-content" id="print-dupak">
                      <div id="dupak-pengawasan" class="tab-pane fade show active" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive" id="dupak-pengawasan-wrapper">                            
                           
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>
                      
                      <div id="dupak-pendidikan" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-pendidikan-wrapper">
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>
                      
                      <div id="dupak-penunjang" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-penunjang-wrapper">                            
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>

                      <div id="dupak-pengembangan" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-pengembangan-wrapper">                            
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>

                      <div id="dupak-diklat" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-diklat-wrapper">                            
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>

                      <div id="dupak-lak" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-lak-wrapper">                            
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>

                      <div id="dupak-dupak" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-dupak-wrapper">                            
                        </div>
                      </div>
                      <div class="clearfix page-break"></div>

                      <div id="dupak-pak" class="tab-pane fade" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        <div class="table-responsive " id="dupak-pak-wrapper">                            
                        </div>
                      </div>                      

                      @hasanyrole('Auditor|Super Admin')
                      <div id="dupak-calendar" class="tab-pane fade no-print" role="tabpanel" style="margin-bottom: 30px; page-break-after: always;">
                        @include('admin.calendar.user.index')
                      </div>
                      @endhasanyrole
                      
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
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/jquery/print.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/datatables/xlsx.full.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/jquery/print.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/datatables/FileSaver.min.js') }}"></script>
@endpush
