{{-- Users index page --}}
@extends('layouts.backend')

{{-- Include blade template per semester (smt1 dan smt2)--}}


@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    
    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">           
          <!-- <ul class="nav nav-tabs card-header-tabs" id="semester" role="tablist">
            @yield('nav_tab_semester_1')
            @yield('nav_tab_semester_2')
          </ul> -->
          
          <ul class="nav  nav-tabs card-header-tabs justify-content-center" id="semester-list">
            <li class="nav-item">
              <a class="nav-link" aria-controls="semester-1" id="semester-1-tab" href="#semester-1" role="tab" aria-selected="true" data-toggle="tab" >Januari - Juni</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-controls="semester-2" id="semester-2-tab" href="#semester-2" role="tab" aria-selected="false" data-toggle="tab" >Juli - Desember</a>
            </li>            
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
           <!--  Content untuk semester 1 -->
            <div class="tab-pane" id="semester-1" role="tabpanel" aria-labelledby="semester-1-tab">
              <!-- <h4 class="text-center"> Periode Januari - Juni {{ now()->year }} </h4> -->
                <div class="row">
                 <div id='calendar0' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar1' class="col-md-6 col-print-6 calendar"></div>
               </div>
               <div class="row">
                 <div id='calendar2' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar3' class="col-md-6 col-print-6 calendar"></div>
               </div>
               <div class="row">
                 <div id='calendar4' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar5' class="col-md-6 col-print-6 calendar"></div>
               </div>
            </div>

            <!-- Content untuk semester 2 -->
            <div class="tab-pane" id="semester-2" role="tabpanel" aria-labelledby="semester-2-tab">
              <!-- <h4 class="text-center"> Periode Juli - Desember {{ now()->year }} </h4> -->
              <div class="row">
                 <div id='calendar6' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar7' class="col-md-6 col-print-6 calendar"></div>
               </div>
               <div class="row">
                 <div id='calendar8' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar9' class="col-md-6 col-print-6 calendar"></div>
               </div>
               <div class="row">
                 <div id='calendar10' class="col-md-6 col-print-6 calendar"></div>
                 <div id='calendar11' class="col-md-6 col-print-6 calendar"></div>
               </div>
            </div>
          </div>
          
        </div>
    </div>     
  </div>
  <script type="text/javascript">    
    var date = new Date();
    var curr_month = date.getMonth();
    if(curr_month<=5){      
      $('.nav-tabs a[href="#semester-1"]').tab('show');      
    }else{
      $('.nav-tabs a[href="#semester-2"]').tab('show');
    }
  </script>

  <!-- modal event description untuk spt per auditor saja-->
  @role('auditor')

  <!-- begin modal -->
<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  <!-- end modal -->

  @endrole
  
</div>

@include('admin.calendar.user.js')

@include('layouts.footers.auth')
@endsection
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/fullcalendar.css') }}" />
  <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/fullcalendar.print.min.css') }}" media="print"/> -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/jquery/jquery-confirm.min.css') }}" />
  <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
  
  <script src="{{ asset('assets/vendor/jquery/moment.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/fullcalendar.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/id.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/gcal.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery/jquery-confirm.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
  <script src="{{ asset('assets/vendor/jquery/divjs.js') }}"></script>
  <script src="{{ asset('assets/vendor/jspdf/jspdf.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jspdf/html2canvas.min.js') }}"></script>
@endpush