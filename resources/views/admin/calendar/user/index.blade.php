
    
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
        <div class="tab-content mt-0">
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
  <script type="text/javascript">
    $('#print-btn').on('click', function(){
    var elem = document.getElementById("print-cal");
    //var printable = ($('#semester-2').hasClass( "show" )) ? "#semester-2" : "#semester-1" ;
    var printable = document.getElementById("calendar-user");
    var HTML_Width = $(printable).width();
    var HTML_Height = $(printable).height()+10;
    var top_left_margin = 5;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.6) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

   /* html2canvas($(printable)[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("calendar.pdf");
    });*/
    html2canvas($(printable)[0]).then(function(canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'mm', [400, 480]);
        margins = {
          top: 40,
          bottom: 60,
          left: 40
        };
        pdf.addImage(imgData, 'JPEG', 0, 0, 400, 480);
        pdf.save("calendar.pdf");
    });

    });
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
    <script src="{{ asset('assets/vendor/jquery/divjs.js') }}"></script>
  <script src="{{ asset('assets/vendor/jspdf/jspdf.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jspdf/html2canvas.min.js') }}"></script>
@endpush