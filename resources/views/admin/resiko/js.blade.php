<script type="text/javascript">
    
    var table = $('#resiko-table').DataTable({        
        language: {
            paginate: {
              next: '&lt;', 
              previous: '&gt;'  
            }
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: '{{ url("/admin/resiko/getdata") }}',
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
            },
            {data: 'opd', name: 'opd', title: 'Nama OPD'},
            {data: 'nama_kegiatan', name: 'nama_kegiatan', title: 'Nama Kegiatan'},
            {data: 'tujuan_kegiatan', name: 'tujuan_kegiatan', title: 'Tujuan Kegiatan'},
            {data: 'action', name: 'action',title: 'Action', orderable: false, searchable: false},
        ],
        columnDefs: [             
              { "width": "150px", "targets": 1 },
              { "searchable": false, "orderable": false, "targets": 0 },            
            ],
        "order": [[ 1, 'asc' ]],
    });

    $("#resiko-form").validate({
        rules: {
            opd : {required: true},
            nama_kegiatan : {required: true, minlength: 5},
            tujuan_kegiatan : {required: true, minlength: 5},
            tujuan_pd : {required: true, minlength: 5},
            sasaran_pd : {required: true, minlength: 5},
            capaian : {required: true, minlength: 5},
            tujuan : {required: true, minlength: 5}          
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "{{url('insertDataResiko')}}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        

            $.ajax({
                url: url,
                type: type,
                data: $('#resiko-form').serialize(),
                success: function($data){
                    $('#resiko-form')[0].reset();
                    table.ajax.reload();
                    console.log('Success!', $data);
                },
                error: function($data){
                    console.log('Error:', $data);
                    $('#resiko-form')[0].reset();
                    table.ajax.reload();
                }
            });
        }
    });

</script>