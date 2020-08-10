<script>
 
         
    var SITEURL = "{{url('/admin')}}";    
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
for (i = 0; i <= 1; i++) {
    
    var x = new Date();   
   x.setMonth(x.getMonth() + i);
   if(i%2 == 1 ){
        right = 'prev,next';
    }else{
        right = '';
    }
 
    $('#calendar'+i).fullCalendar({
        header: {
            left: 'title',
            center: '',
            right: right
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

        displayEventTime: false,
        editable: true,
        locale: 'id',           
        selectable: true,
        selectHelper: true,
        //start select function
       

        //end select function
         eventRender: function (event, element, view) {
           var startDate = moment(event.start).format('YYYY-MM-DD');
           var stopDate = moment(event.end).format('YYYY-MM-DD');
           var dates = getDates(startDate, stopDate);
           if (event.info) {
               /*jenis_class = (event.info.jenis) ? event.info.jenis : '';
               type_class = (event.info.type && event.info.type === 'user_event' ) ? 'user-event' : '';
               return $('<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable '+type_class+' '+jenis_class+'" onclick="userEventChange('+event.id+')" style="color:#fff;"><div class="fc-content"> <span class="fc-title">'+event.event_user_full_name+' : '+event.title+'</span></div></a>');*/              
               

               //info = spt
               if(event.info.type == 'spt' && event.info.jenis == 'umum'){
                   dates.forEach(function (dataToFind){
                    if (!$("td[data-date='"+dataToFind+"']").is(".fc-sat, .fc-sun")){
                        $("td[data-date='"+dataToFind+"']").addClass('spt-umum-day');
                    }
                   });
                   return $('<div class="fc-day-grid-event fc-h-event fc-event spt-umum fc-start fc-end fc-draggable " style="color:#fff;"><div class="fc-content"> <span class="fc-title">'+event.title+'</span></div></div>');
               }
            }else{
                
                dates.forEach(function (dataToFind){
                    
                });
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
</script>