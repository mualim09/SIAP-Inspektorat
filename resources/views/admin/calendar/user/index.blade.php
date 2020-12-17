
    
<div class="col-md-12 dashboard-bg-color">
  <div class="card">
      <div class="card-header no-print">      
        <ul class="nav  nav-tabs card-header-tabs justify-content-center" id="semester-list">
          <li class="nav-item">
            <a class="nav-link" aria-controls="semester-1" id="semester-1-tab" href="#semester-1" role="tab" aria-selected="true" data-toggle="tab" >Januari - Juni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-controls="semester-2" id="semester-2-tab" href="#semester-2" role="tab" aria-selected="false" data-toggle="tab" >Juli - Desember</a>
          </li>            
        </ul>
      </div>
      <div class="card-body" id="calendar-user">
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

@include('admin.calendar.user.js')

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/fullcalendar.css') }}" />
  <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fullcalendar/fullcalendar.print.min.css') }}" media="print"/> -->
@endpush
@push('js')  
  <script src="{{ asset('assets/vendor/jquery/moment.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/fullcalendar.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/id.js') }}"></script>
  <script src="{{ asset('assets/vendor/fullcalendar/gcal.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jspdf/html2canvas.min.js') }}"></script>
@endpush