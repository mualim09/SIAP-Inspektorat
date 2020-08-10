<!-- handebar detail -->
<script type="text/javascript">
    
    var table = $('#laporan-table').DataTable({        
        language: {
            paginate: {
              next: '&lt;', 
              previous: '&gt;'  
            }
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: '{{ url("/getLaporan") }}',
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
            {data: 'name', name: 'name', title: 'Nama Spt'},
            {data: 'lokasi', name: 'lokasi', title: 'Lokasi'},
            {data: 'first_name', name: 'first_name', title:'Uploader'},
            {data: 'file', name: 'file',title:'Doc.'},
            {data: 'laporan_status', name: 'laporan_status', title:'Status Laporan'},
            // {data: 'jabatan', name: 'jabatan', title:'Jabatan'},
            {data: 'laporan_status', name: 'laporan_status', title:'Status Laporan'},

            {data: 'action', name: 'action', orderable: false, searchable: false,title: 'Action'},
        ],
        columnDefs: [             
              { "width": "150px", "targets": 3 },
              { "searchable": false, "orderable": false, "targets": 0 },            
            ],
        "order": [[ 1, 'asc' ]],
        
    });
     

    $("#laporan-form").validate({
        rules: {
            file : {required: true},         
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "{{url('laporan-auditor')}}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        

            $.ajax({
                url: url,
                type: type,
                data: $("#laporan-form").serialize(),
                success: function($data){
                    $("#laporan-form")[0].reset();
                    // table.ajax.reload();
                    console.log('Success!', $data);
                },
                error: function($data){
                    console.log('Error:', $data);
                    $("#laporan-form")[0].reset();
                    // table.ajax.reload();
                }
            });
        }
    });
    
</script>