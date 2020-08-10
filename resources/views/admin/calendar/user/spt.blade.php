{{-- Calendar index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
	<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">    
    <div class="row">
      <div class="col-md-10">
        <breadcrumb list-classes="breadcrumb-links">
          <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item>
          <breadcrumb-item>/ Dokumen</breadcrumb-item> 
          <breadcrumb-item active>/ Kalender</a></breadcrumb-item>
        </breadcrumb>
      </div>        
      <div class="col text-right">
        <button class="btn btn-sm btn-secondary" id="print-btn"><i class="fas fa-print"></i><span>Print Calendar</span></button>
      </div>
    </div>

    <div class="row" id="printable">
        <div class="col col-print-12">
            <div class="card shadow" id="print-select">              
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
        </div>
    </div>
  </div>
  <script type="text/javascript">
    $('#print-btn').on('click', function(){
      
    var HTML_Width = $("#printable").width();
    var HTML_Height = $("#printable").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#printable")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("calendar.pdf");
        //$("#printable").hide();
    });

    });
  </script>

    <!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calendarModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
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