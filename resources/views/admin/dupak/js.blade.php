<script type="text/javascript">    
    /*datatable setup*/
    
    var dupak_table = $('#list-dupak-table').DataTable({        
        'pageLength': 50,
        'searching': false,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {
            extend:'excel',
            title:'Daftar Perolehan Angka Kredit',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            }
        },
        {
            extend:'pdf',
            title:'Daftar Perolehan Angka Kredit',
            exportOptions: {
                columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
            }
        } ],
       
  
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' 
            }
        },
        "opts": {
          "theme": "bootstrap",
        },
        processing: true,
        serverSide: true,
        /*ajax: '{{ route("data_dupak") }}',*/
        ajax: {
            url:'{{ route("data_dupak") }}',
            //data:{tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir}
           },
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '2%'},
            {data: 'tanggal_spt', name: 'tanggal_spt', 'title': "{{ __('Tanggal SPT') }}",  width: '15%'},
            {data: 'lama_spt', name: 'lama_spt', 'title': "{{ __('Lama SPT') }}", width: '10%'},
            {data: 'efektif', name: 'efektif', 'title': "{{ __('Efektif') }}",  width: '10%'},
            {data: 'kegiatan', name: 'kegiatan', 'title': "{{ __('Kegiatan') }}", width: '23%'},
            {data: 'koefisien', name: 'koefisien', 'title': "{{ __('Koefisien') }}", width: '10%'},
            {data: 'dupak', name: 'dupak', 'title': "{{ __('AK') }}",  width: '5%'},
            {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}",  width: '10%'},
            {data: 'lembur', name: 'lembur', 'title': "{{ __('Lembur') }}",  width: '10%'},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });
    

    function isiDupakUser(user_id){
        $('#user-id').val(user_id);
        $('#modalFormIsiDupak').modal('show');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
 

  //form cari dupak user
  $("#form-cari-dupak").validate({
        rules: {
            semester : {required: true},
            tahun: {required: true}
        },

        submitHandler: function(form){
            var user_id = ( $( "#user_id" ).length ) ? $("#myselect option:selected").val() : "{{ Auth::user()->id }}";
            var semester = $('#semester').val();            
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            url = "{{  route('data_dupak') }}" ;
            type = "GET";
            $.ajax({
                url: url,
                type: type,
                data: {user_id:user_id, semester:semester},
                
                success: function(data){
                    $("#form-cari-dupak")[0].reset();
                    dupak_table.draw();
                },
                error: function(error){                    
                    console.log(error);
                }
            });
        }
    });

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
  
</script>
