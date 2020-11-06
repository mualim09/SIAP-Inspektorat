<script type="text/javascript">

    /*datatable setup*/    
    var table = $('#list-spt-table').DataTable({        
        'pageLength': 50,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
        fixedColumns:   {
            heightMatch: 'auto'
        },
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
        ajax: '{{ route("get_data_spt","data") }}',
        /*deferRender: true,*/
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            {data: 'nomor', name: 'nomor', 'title': "{{ __('No SPT') }}"},
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}", width: '300px'},
            {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}", width: '300px'},
            {data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}", width: '150px'},
            {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}", width: '150px'},
            {data: 'lama', name: 'lama', 'title': "{{ __('Lama (Hari)') }}", width: '80px'},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

    

    $('#btn-new-spt').on('click', function(){
        save_method = 'new';
        id_spt_pengawasan = null;
        clearSessionAnggota();
        clearJenis();
    });

    //butuh revisi
    function editForm(id){        
        save_method = 'edit';
        id_spt = id;
        //avoid false ajax url. read url first, then add it to te prefixed url
        //alert(window.location.pathname);
        var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/' : 'spt/';
        url = url_prefix+id+"/edit";
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){                
                $('#spt-form')[0].reset();
                $('#id-jenis-spt').val(data.id_jenis_spt);

                //variabel jenis spt               
                lokasi = (data.jenis_spt.input_lokasi == true) ? data.lokasi_id : '';
                tambahan = (data.jenis_spt.input_tambahan == true) ? data.tambahan : '';                
                input_lokasi = data.jenis_spt.input.lokasi;
                input_tambahan = data.jenis_spt.input.tambahan;
                cek_radio = data.jenis_spt.cek_radio;
                jenis_spt_id = data.jenis_spt_id;

                $('#id').val(data.id);
                $('#name').val(data.name);
                //$('#jenis-spt-'+data.jenis_spt_id).prop('selected','selected');
                //$('#jenis-spt')[0].selectize.setValue(data.jenis_spt_id);
                if(data.info_lanjutan == 1){
                    $('#info-lanjutan').prop('checked',true);
                }else{
                    $('#info-lanjutan').prop('checked',false);
                }
                $('#tgl-mulai').val(data.tgl_mulai);
                $('#tgl-akhir').val(data.tgl_akhir);
                $('#lama').val(data.lama);
                $('#lokasi').val(data.lokasi);
                $('#formModal').modal('show');
                $('#formModal').attr('data-id-spt-pengawasan', data.id);
                //$("#modal-body-anggota #spt-id-anggota").val( id );
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    

    //butuh revisi
    function deleteData(id){
        save_method = 'delete';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){                       
                        //url = "spt/" +id;
                        url = (window.location.pathname == '/admin') ? 'admin/spt/'+id : 'spt/'+id;
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                //table.ajax.reload();
                                $('#penomoran-spt').DataTable().ajax.reload(null, false );
                            }
                        });
                    },
                },
                cancel: function(){
                    $.alert('Canceled!');
                }
            }
        });
    }
    
    function clearSessionAnggota(){
        $.ajax({
            url: "{{ route('clear_session_anggota') }}",
            type: "GET",
            success: function(data){
                //$('#list-anggota-session').DataTable().ajax.reload();
                $('#list-anggota-session').DataTable().clear().destroy();
                //console.log(data);
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.methods.teks = function( value, element ) {
      return this.optional( element ) || /^[a-zA-Z]+$/.test( value );
    }


    $("#spt-form").validate({
        rules: {
            jenis_spt_id : {required: true},
            tgl_mulai: {required: true},
            tgl_akhir: {required: true},
            input_tambahan : {teks: true},
        },

        submitHandler: function(form){
            var jenis_spt_id = $('#id-jenis-spt').val();
            var tgl_mulai = $('#tgl-mulai').val();
            var tgl_akhir = $('#tgl-akhir').val();
            var lama = $('#lama').val();
            var lokasi_id = ($('#input-lokasi').val() == 1 ) ? $('#lokasi-id').val() : null ;
            var tambahan = $('#tambahan').val();
            var lanjutan = ( typeof $('.info-lanjutan:checked').val() !== 'undefined' ) ? '"lanjutan":"'+$('.info-lanjutan:checked').val()+'"' : '"lanjutan":'+null;
            var input_radio = ( typeof $('input[name=radio_input]:checked').val() !== 'undefined' ) ? '"radio":"'+$('input[name=radio_input]:checked').val()+'"' : '"radio":'+null;
            var info = JSON.parse('{'+lanjutan+','+input_radio+'}');
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var id = $('#id').val();
            //save_method = (id == '') ? 'new' : save_method;
            base_url = "spt";
            var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/' : 'spt/';
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            url = (save_method == 'new') ? "{{ route('spt.store') }}" : url_prefix + id ;
            method = (save_method == 'new') ? "POST" : "PUT";
            type = "POST";            
            

            $.ajax({
                url: url,
                type: type,
                data: {jenis_spt_id:jenis_spt_id, lokasi_id:lokasi_id, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, lama:lama, tambahan:tambahan, info:info, _method: method},
                //data: $('#spt-form').serialize(),
                //dataType: 'json',

                /*data: $('#spt-form').serialize(),*/
                success: function(data){
                    $("#spt-form")[0].reset();
                    $('#formModal').modal('hide');
                    if(save_method == 'new') clearSessionAnggota();
                    //table.ajax.reload();
                    $('#penomoran-spt').DataTable().ajax.reload(null, false );
                },
                error: function(error){
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
                    console.log(error);
                    $.alert({
                        content: '<ul id="error-list">'+err_list+'</ul>' , 
                        title: 'Error!',
                        theme: 'modern',
                        type: 'red'
                    });
                    /*$('.ajax-form')[0].reset();*/
                    /*table.ajax.reload();*/
                }
            });
        }
    });

    function viewAnggota(sptid){
        $('#spt-id').val(sptid);
        $('data').attr('spt',sptid);
        $('#formAnggotaSptModal').modal('show');
    }
    function clearJenis(){
        var optJenis = $('#jenis-spt').selectize();
        var controlJenis = optJenis[0].selectize;
        controlJenis.clear();
    }

    $('#formModal').on('shown.bs.modal', function(){
        if(save_method == 'edit') $('#tgl-akhir').prop('disabled',false);
    });

    $('#formModal').on('hidden.bs.modal', function(){
        $('#tgl-akhir').prop('disabled',true);
        //delete id_spt;
        //delete save_method;
    });

    $( "#formAnggotaSptModal" ).on('shown.bs.modal', function(){
        /* Anggota SPT table */
        //var sptid = $('#spt-id').val();
        var sptid = $('data').attr('spt');
        var anggotaTable = $('#anggota-spt-table').DataTable({            
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
            retrieve: true,
            ajax: '{{ url("/admin/spt/get-anggota") }}/'+sptid,
            deferRender: true,
            columns: [
                {
                    'defaultContent' : '',
                    'data'           : 'DT_RowIndex',
                    'name'           : 'DT_RowIndex',
                    'title'          : 'No',
                    'orderable'      : false,
                    'searchable'     : false,
                    'exportable'     : true,
                    'printable'      : true,
                },
                {data: 'full_name', name: 'full_name', 'title': "{{ __('Nama') }}"},
                {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}"},
                {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
                {data: 'action', name: 'action', orderable: false, searchable: false, 'title': "{{ __('Action') }}"},
            ]
        });
        
    });

    $('#formAnggotaSptModal').on('hidden.bs.modal', function () {
    // do something…
        $('#anggota-spt-table').DataTable().clear().destroy();
    });

    
</script>
