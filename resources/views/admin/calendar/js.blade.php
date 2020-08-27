<script>
 
         
    var SITEURL = "{{url('/admin')}}";    
    var contentBuatEvent = '' +
                '<form id="addEvent">' +
                '<div class="form-group">' +
                    '<input type="text" placeholder="Nama acara dalam kalender" class="name form-control" required  id="event-title"/>' +
                '</div>' +
                '<div class="form-group">' +                        
                    '<div class="form-check form-check-inline">' +
                      '<input class="form-check-input" type="radio" name="jenis" id="jenis1" value="cuti">' +
                      '<label class="form-check-label" for="jenis1">Libur/ Ijin/ Cuti/ Sakit</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline">' +
                      '<input class="form-check-input" type="radio" name="jenis" id="jenis2" value="pengembangan">' +
                      '<label class="form-check-label" for="jenis2">Pengembangan profesi</label>' +
                    '</div>' +
                    '<div class="form-check form-check-inline">' +
                      '<input class="form-check-input" type="radio" name="jenis" id="jenis3" value="penunjang">' +
                      '<label class="form-check-label" for="jenis3">Penunjang</label>' +
                    '</div>' +
                '</div>' +
                '</form>';
       
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
for (i = 0; i <= 11; i++) {
    
    var x = new Date();   
   x.setMonth(0 + i);
   
   if(i%2 == 1 ){
        right = 'prev,next';
    }else{
        right = '';
    }
 
    $('#calendar'+i).fullCalendar({
       
        header: {
            left: 'title',
            center: '',
            right: ''
          },
        plugins: [ 'dayGrid' ],
        editable: true,
        events: 
        {
            url: SITEURL + "/calendar",
            color: '#f4511e',
            textColor: '#fff',            
        },
        defaultDate: x,
        /*fixedWeekCount: false,
        showNonCurrentDates: false,*/
        displayEventTime: false,
        editable: true,
        locale: 'id',           
        selectable: true,
        selectHelper: true,
        visibleRange: {
          start: moment(x).startOf('month').format('YYYY-MM-DD'),
          end: moment(x).endOf('month').format('YYYY-MM-DD')
        },
        //start select function
        dayClick: function (date,jsEvent,view){
            allDay:true;
            
            //var start = $.fullCalendar.formatDate(date, "Y-MM-DD HH:mm:ss");
            var start = moment(date).format('Y-MM-DD HH:mm:ss');
            //var end = $.fullCalendar.formatDate(date.setDate(date.getDate() + 1), "Y-MM-DD HH:mm:ss");
            var end = moment(date).add(1, 'days').format('Y-MM-DD HH:mm:ss');
            $.confirm({
                theme: 'modern',
                title: 'Buat acara',
                columnClass: 'l',
                type: 'blue',
                content: '' +
                '<form id="addEvent">' +
                    '<div class="form-group">' +
                        '<input type="text" placeholder="Nama acara dalam kalender" class="name form-control" required  id="event-title"/>' +
                    '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var csrf_token = $('meta[name="csrf-token"]').attr('content');
                            var title = $('#event-title').val();
                            var jenis = $('input[name="jenis"]:checked').val();
                            $.ajax({
                                url: SITEURL + "/calendar/create",
                                type: "POST",
                                data: { '_token' : csrf_token, title: title, start: start, end: end, jenis: jenis},
                                success: function(data){
                                    $.alert({
                                        content:'Event '+data.title+' created Successfully!' , 
                                        title: 'Success',
                                        theme: 'modern',
                                        type: 'blue'
                                    });
                                    //$('#calendar'+i).fullCalendar('refetchEvents');                                    i
                                      setTimeout(function(){// wait for 5 secs(2)
                                           location.reload(); // then reload the page.(3)
                                      }, 5000); 
                                },
                                error: function(error){                                    
                                    $.alert({
                                        content:'Event error! ' +error.responseJSON.message , 
                                        title: 'Error',
                                        theme: 'modern',
                                        type: 'red'
                                    });
                                }
                            });
                            //refetch event
                            
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        },

        //end select function
         eventRender: function (event, element, view) {
           var startDate = moment(event.start).format('YYYY-MM-DD');
           var stopDate = moment(event.end).format('YYYY-MM-DD');
           var calMonth = moment(view.start).format('YYYY-MM-DD');
           var eventMonth = moment(event.start).format('MM');
           var dates = getDates(startDate, stopDate);

           //start test
           /*var eventDate = event.start;
            var calendarDate = $('#calendar'+i).fullCalendar('getDate');
            if (eventDate.get('month') !== calendarDate.get('month')) {
                return false;
            }
*/
           //finish test

           if (event.info) {
               //info = spt
               if(event.info.type == 'spt'){
                   if(event.info.jenis == 'umum'){
                    dates.forEach(function (dataToFind){
                       if (!$("td[data-date='"+dataToFind+"']").is(".fc-sat, .fc-sun")){
                           $("td[data-date='"+dataToFind+"']").addClass('spt-umum-day');
                       }
                      });
                    }
                    if(event.info.jenis == 'pengawasan'){
                           //console.log(JSON.stringify(dates));
                           last_date = dates[dates.length -1];
                           first_date = dates[0];
                           //console.log(first_date+'='+last_date);
                           dates.forEach(function (dataToFind){
                               if (!$("td[data-date='"+dataToFind+"']").is(".fc-sat, .fc-sun") ){
                                    $("td[data-date='"+dataToFind+"']").addClass('spt-pengawasan-day');
                                    if(dataToFind == last_date){
                                        $("td[data-date='"+dataToFind+"']").addClass('last');
                                    }
                                    if(dataToFind == first_date){
                                        $("td[data-date='"+dataToFind+"']").addClass('first');
                                    }
                               }
                               
                          });
                           
                    }
                   return $('<div class="fc-day-grid-event fc-h-event fc-event spt-event fc-start fc-end fc-draggable " style="color:#fff;"><div class="fc-content"> <span class="fc-title">'+event.title+'</span></div></div>');
               }
            }else{                
               
                dataToFind = dates[0];
                if (!$("td[data-date='"+dataToFind+"']").is(".fc-sat, .fc-sun")){
                        $("td[data-date='"+dataToFind+"']").addClass('holiday');
                    }
            }

            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        eventAfterRender: function(event, element, view){
           //console.log(event);
           var startDate = moment(event.start).format('YYYY-MM-DD');
           var stopDate = moment(event.end).format('YYYY-MM-DD');           
           var dates = getDates(startDate, stopDate);
           if (event.info) {
            if(event.info.type == 'spt' && event.info.jenis == 'pengawasan'){
                dates.forEach(function (dataToFind){
                   if ($("td[data-date='"+dataToFind+"']").is(".last.first") ){
                        $("td[data-date='"+dataToFind+"']").addClass('spt-multi-pengawasan-day');
                   }
              });
            }
           }
           $('td.fc-other-month .fc-day-number').attr('style','background-color:#ccc !important; color: #ccc;');
           $('div.fc-bg table tbody tr td.fc-other-month').attr('style','background-color:#ccc !important; color: #ccc;');
           //hide event other month
            var col=element.closest('td').index()+1;
            var $cellh=element.closest('table').find('thead td:nth-child('+col+')');
            if ($cellh.hasClass('fc-other-month') == true)
                    element.css('visibility','hidden')

           //finish
        },
    });
}

function getDates(startDate, stopDate) {
    var dateArray = [];
    var currentDate = moment(startDate);
    var stopDate = moment(stopDate);
    while (currentDate <= stopDate) {
        dateArray.push( moment(currentDate).format('YYYY-MM-DD') )
        currentDate = moment(currentDate).add(1, 'days');
    }
    return dateArray;
}
    
  

  function userEventChange(event_id){  
   save_method = 'user_event_change';
    url = "calendar/user-event/" +event_id+"/change";
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function(data){
           //start
           $.confirm({
                    theme: 'modern',
                    title: 'Ubah acara',
                    columnClass: 'l',
                    type: 'blue',                    
                    content: '' +
                    '<form id="addEvent">' +
                    '<input type="hidden" id="id-event" />' +
                    '<div class="form-group">' +
                        '<input type="text" placeholder="Nama acara dalam kalender" class="name form-control" required  id="event-title" value="'+data.title+'"/>' +
                    '</div>' +
                    '<div class="form-group">'+
                        '<div class="col-md-5 pl-0" style="float:left;">'+
                            '<input type="text" class="form-control datepicker" name="start" id="tgl-mulai" autocomplete="off" placeholder="Tanggal Mulai">'+
                        '</div>'+
                        '<div class="col-md-5 pr-0" style="float:right;">'+
                            '<input type="text" class="form-control datepicker" name="end" id="tgl-akhir" autocomplete="off" placeholder="Tanggal Selesai">'+
                        '</div>'+
                        '<div style="clear:both;"></div>'+
                    '</div>'+
                    '<div class="form-group">' +                        
                        '<div class="form-check form-check-inline">' +
                          '<input class="form-check-input" type="radio" name="jenis" id="jenis1" value="cuti">' +
                          '<label class="form-check-label" for="jenis1">Libur/ Ijin/ Cuti/ Sakit</label>' +
                        '</div>' +
                        '<div class="form-check form-check-inline">' +
                          '<input class="form-check-input" type="radio" name="jenis" id="jenis2" value="pengembangan">' +
                          '<label class="form-check-label" for="jenis2">Pengembangan profesi</label>' +
                        '</div>' +
                        '<div class="form-check form-check-inline">' +
                          '<input class="form-check-input" type="radio" name="jenis" id="jenis3" value="penunjang">' +
                          '<label class="form-check-label" for="jenis3">Penunjang</label>' +
                        '</div>' +
                    '</div>' +
                    '</form>',
                    buttons: {
                        delete:{
                            text: 'Delete',
                            btnClass: 'btn-danger',
                            action: function(){
                                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                                var event_id = $('#id-event').val();
                                $.ajax({
                                    url: SITEURL + "/calendar/delete-user-event/"+event_id,
                                    type: "POST",
                                    data: { _method: 'delete', '_token' : csrf_token},
                                    success: function(data){
                                        $.alert({
                                            content:'Event deleted Successfully!' , 
                                            title: 'Success',
                                            theme: 'modern',
                                            type: 'blue'
                                        });
                                        calendar.fullCalendar('refetchEvents');
                                    },
                                    error: function(error){
                                        $.alert({
                                            content:'Event error! ' +error.responseJSON.message , 
                                            title: 'Error',
                                            theme: 'modern',
                                            type: 'red'
                                        });
                                    }
                                });
                            }
                        },
                        cancel: function () {
                            
                        },
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-blue',
                            action: function () {
                                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                                var event_id = $('#id-event').val();
                                var title = $('#event-title').val();
                                var jenis = $('input[name="jenis"]:checked').val();
                                var start = $('#tgl-mulai').val();
                                var end = $('#tgl-akhir').val();
                                $.ajax({
                                    url: SITEURL + "/calendar/update-user-event",
                                    type: "POST",
                                    data: { '_token' : csrf_token, event_id: event_id, title: title, start: start, end: end, jenis: jenis},
                                    success: function(data){
                                        console.log(data);
                                        $.alert({
                                            content:'Event '+data.title+' updated Successfully!' , 
                                            title: 'Success',
                                            theme: 'modern',
                                            type: 'blue'
                                        });
                                        calendar.fullCalendar('refetchEvents');
                                    },
                                    error: function(error){
                                        //console.log(error);
                                        err_list = '';
                                        $.each(error.responseJSON, function(i,v){
                                            //console.log(v);
                                            if(i == 'errors'){
                                                $.each(v, function(a,b){
                                                    //err_arr.push([a.charAt(0).toUpperCase() + a.slice(1)+' '+b.toString().replace('validation.','')+'\n']);
                                                    err_list += '<li style="text-align:left;">'+a.charAt(0).toUpperCase() + a.slice(1)+' '+b.toString().replace('validation.','')+'</li>';
                                                });
                                            }
                                        });
                                        $.alert({
                                            content: '<ul id="error-list">'+err_list+'</ul>' , 
                                            title: error.responseJSON.message,
                                            theme: 'modern',
                                            type: 'red'
                                        });
                                    }
                                });
                                //refetch event
                                
                            }
                        },
                        

                    },
                    onContentReady: function () {
                        $('#id-event').val(data.id);
                        $('input[value="'+data.event_jenis+'"]').prop('checked',true);
                        //datepicker
                        $('.datepicker').each(function() {
                            $(this).datepicker({
                                language: "{{ config('app.locale')}}",
                                format: 'dd-mm-yyyy',
                                autoclose: true,
                                todayHighlight: true,
                            });     
                        });
                        $("#tgl-mulai").on('changeDate', function(selected) {
                            var startDate = new Date(selected.date.valueOf());
                            $("#tgl-akhir").datepicker('setStartDate', startDate);
                            if($("#tgl-mulai").val() > $("#tgl-akhir").val()){
                              $("#tgl-akhir").val($("#tgl-mulai").val());
                            }
                            $(this).closest('div').next().find('input').focus();
                        });
                        //end datepicker
                        $('#tgl-mulai').val(data.start);
                        $('#tgl-akhir').val(data.end);
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
           //end
        },
        error: function(err){
            console.log(err);
        }
    });
  }
</script>