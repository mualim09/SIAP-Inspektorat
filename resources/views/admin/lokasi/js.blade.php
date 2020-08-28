<script type="text/javascript">
	
	var table = $('#lokasi-table').DataTable({        
        'pageLength': 15,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' ,
            },
        },
        
        "opts": {
          "theme": "bootstrap",
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('get_data_lokasi') }}",
        /*deferRender: true,*/
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            {data: 'nama_lokasi', name: 'nama_lokasi', 'title': "{{ __('Lokasi') }}"},
            {data: 'jenis_lokasi', name: 'jenis_lokasi', 'title': "{{ __('Kategori') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

	$("#lokasi-form").validate({
        rules: {
            lokasi : {required: true, minlength: 3},
            sebutan_pimpinan : {required: true},
            lokasi : {required: true}
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            var id = $('#id').val();
            base_url = "{{ route('store_lokasi') }}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        
            $.ajax({
                url: url,
                type: type,
                data: $('.ajax-form').serialize(),
                dataType: 'text',
                success: function(res){
                    //str = res.responseText;
                    
                    if(res.match(/(error|validation)/i)){
                        alert(res);
                    }else{
                        $('.ajax-form')[0].reset();
                        table.ajax.reload();
                        console.log(res);
                    }
                    
                },
                error: function(request, status, error){
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value){
                        $(".invalid-"+key).show();
                        $('.invalid-'+key).append('<p>'+value+'</p>');
                    });
                   /* console.log('parsed json :',json);*/
                }
            });
        }
    });

    function editLokasi(id){
        // kondisi untuk menghide kecamatan
        if ($("#id_kecamatan").is(":checked") == false) {
            $("#id_kecamatan").hide();
        }if($("#id_kecamatan").prop("checked") == true){
            $("#id_kecamatan").show();
        }
        save_method = 'edit';
        var url = "/admin/getDataLokasi/" +id ;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    // console.log(data);
                    var item = data[0];
                    console.log(item);
                    $('.ajax-form')[0].reset();
                    $('#id').val(item.id);
                    $('.nama_lokasi').val(item.nama_lokasi);
                    $('.sebutan_pimpinan').val(item.sebutan_pimpinan);
                    if (item.kecamatan != null) {
                        $('.kecamatan')[0].selectize.setValue(item.kecamatan);
                    }
                    $('#kateg_lokasi-'+item.jenis_lokasi).prop('checked',true);
                }
            });


    }

</script>