<!-- handebar detail -->
<script id="details-template" type="text/x-handlebars-template">
    @verbatim
    <table class="table details-table" id="role-{{id}}">
        <thead>
        <tr>
            <th>Id</th>
            <th>Permissions Name</th>
        </tr>
        </thead>
    </table>
    @endverbatim
</script>


<script type="text/javascript">

    /*datatable setup*/
    var template = Handlebars.compile($("#details-template").html());
    var table = $('.ajax-table').DataTable({        
        language: {
            paginate: {
              next: '&#8594;', // or '→'
              previous: '&#8592;' // or '←' 
            }
        },
        processing: true,
        serverSide: true,
        ajax: '{{ url("/admin/roles/getdata") }}',
        deferRender: true,
        columns: [            
            {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": '<a href="javascript:void(0);"><i class="fa fa-plus"></i></a>'
          },
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
            {data: 'name', name: 'name'},
            {data: 'guard_name', name: 'guard_name'},            
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [             
              { "width": "150px", "targets": 3 },
              { "searchable": false, "orderable": false, "targets": 0 },            
            ],
        "order": [[ 2, 'asc' ]],
    });


     // Add event listener for opening and closing details
      $('.ajax-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'role-' + row.data().id;
        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Open this row
          row.child(template(row.data())).show();
          initTable(tableId, row.data());
          //console.log(row.data());
          tr.addClass('shown');
          tr.next().find('td').addClass('no-padding bg-clear');
        }
      });
      function initTable(tableId, data) {
        $('#' + tableId).DataTable({
          language: {
            paginate: {
              next: '&gt;', // or '→'
              previous: '&lt;' // or '←' 
            }
        },
          processing: true,
          serverSide: true,
          ajax: data.details_url,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
          ]
        })
      }

    //end event listener
    function editForm(id){        
        save_method = 'edit';
        url = "{{ url('admin/roles') }}/" +id+"/edit";
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('.ajax-form')[0].reset();
                $('#id').val(data.id);
                $('#name').val(data.name);
                $(data.permissions).each(function(i,val){
                    $('#permission-'+val.id).prop('checked',true);
                    //console.log('data', val.id);
                });
            },
            error: function(err){
                
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
                        url = "{{ url('admin/roles') }}/" +id;
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
    $(".ajax-form").validate({
        rules: {
            name : {required: true, minlength: 3},            
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "roles";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        

            $.ajax({
                url: url,
                type: type,
                data: $('.ajax-form').serialize(),
                success: function($data){
                    $('.ajax-form')[0].reset();
                    table.ajax.reload();
                    /*console.log('Success!', $data);*/
                },
                error: function($data){
                    /*console.log('Error:', $data);*/
                    $('.ajax-form')[0].reset();
                    table.ajax.reload();
                }
            });
        }
    });
</script>