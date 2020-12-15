<script type="text/javascript">

    /*datatable setup*/    
    var table = $('.ajax-table').DataTable({        
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' 
            }
        },
        pageLength: 50,
        processing: true,
        serverSide: true,
        ajax: '{{ url("/admin/jenis-spt/getdata") }}',
        deferRender: true,
        columns: [
            {
                'defaultContent' : '',
                'data'           : 'DT_RowIndex',
                'name'           : 'DT_RowIndex',
                'title'          : 'No',
                'render'         : null,
                'orderable'      : false,
                'searchable'     : false,
                'exportable'     : false,
                'printable'      : true,
                'footer'         : '',
                'width'          : '5%'
            },
            {data: 'name', name: 'name', title: 'jenis spt', width: '10%'},
            {data: 'dasar', name: 'dasar', width: '45%', title: 'Dasar'},
            {data: 'kode_kelompok', name: 'kode_kelompok', title: 'Kode', width: '10%'},
            {data: 'action', name: 'action', orderable: false, searchable: false, title: 'Action'},
        ],       
        "order": [[ 1, 'asc' ]],
    });

    
    function editForm(id){        
        save_method = 'edit';
        url = "jenis-spt/" +id+"/edit";
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){                
                console.log(data);
                $('#jenis-spt-form')[0].reset();
                $('#id').val(data.id);
                $('#sebutan').val(data.sebutan);
                $('#name').val(data.name);
                $('#dasar').val(data.dasar);
                $('#kode-kelompok').val(data.kode_kelompok);
                if(data.input_lokasi == true){
                    $('#lokasi-yes').prop('checked', true);
                }else{
                    $('#lokasi-no').prop('checked', true);
                }

                if(data.input_tambahan == true){
                    $('#input-yes').prop('checked', true);
                }else{
                    $('#input-no').prop('checked', true);
                }

                if(data.cek_radio == true){
                    $('#radio-yes').prop('checked', true);
                    $.each(data.radio, function(key, value){
                        $('#radio-'+key).val(value);
                    });
                    $('#radio-tambahan').show();
                }else{
                    $('#radio-tambahan').hide();
                }
                /*$('#dasar').summernote('code',data.dasar);
                $('#isi').summernote( 'code',data.isi);*/
                $('.modal-form').modal('show');
            },
            error: function(err){
                console.log('err spt/jenis/js.blade : editForm');
            }
        });
    }

    
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
                        url = "jenis-spt/" +id;
                        $.ajax({
                            url: url,
                            type: "POST",                
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                table.ajax.reload();                        
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
    $("#jenis-spt-form").validate({
        ignore: ":hidden, [contenteditable='true']:not([name])",
        rules: {            
            kode_kelompok: {required: true, minlength: 1}
        },
        submitHandler: function(form){
            var id = $('#id').val();
            save_method = (id == '') ? 'new' : save_method;
            //save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "jenis-spt";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";


            $.ajax({
                url: url,
                type: type,
                data: $('#jenis-spt-form').serialize(),                
                success: function($data){                    
                    console.log($data);
                    $('#jenis-spt-form')[0].reset();
                    $('#dasar').val('');
                    $('#isi').val('');
                    $('#formModal').modal('hide');
                    table.ajax.reload();
                   
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
                    $.alert({
                        content: '<ul id="error-list">'+err_list+'</ul>' , 
                        title: error.responseJSON.message,
                        theme: 'modern',
                        type: 'red'
                    });
                    table.ajax.reload();
                }
            });
        }
    });

    $('#formModal').on('hidden.bs.modal', function (){
        $('#jenis-spt-form')[0].reset();
       $('#id').val('');
       console.log($('#id').val());
        $('#dasar').val('');
        $('#isi').val('');
        $('#radio-tambahan').hide();
    })
</script>