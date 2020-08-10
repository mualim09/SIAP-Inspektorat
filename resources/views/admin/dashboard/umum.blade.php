<div class="col-md-12 dasboard-bg-color">
    <div class="card">
      <div class="card-header">
        Penomoran SPT
      </div>
      <div class="card-body">
        <table id="penomoran-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
            <thead></thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalFormPenomoranSpt">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Penomoran SPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="ajax-form" id="form-penomoran">
            <input type="hidden" name="spt_id" id="spt-id">
            <div class="form-group row">
                <label for="nomor" class="col-sm-4 col-form-label">{{ __('Nomor')}} </label>                
                <input type="text" name="nomor" class="form-control-sm" required placeholder="Nomor SPT" id="nomor-spt">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function showFormModal(spt_id){        
        $('#spt-id').val(spt_id);
        $('#modalFormPenomoranSpt').modal('show');
    }
    //form ajax submit handler
        $('.ajax-form').submit(function(event){
            event.preventDefault();
            var form = $(this);
            var spt_id = $('#spt-id').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var nomor = $('#nomor-spt').val();
            $.ajax({
                url: "spt/update-nomor",
                type: 'post',
                data: {spt_id:spt_id, nomor:nomor,'_token' : csrf_token},
                success: function(data){                    
                    console.log('success:',data);
                    $('#modalFormPenomoranSpt').modal('hide');
                    $('#penomoran-spt').DataTable().ajax.reload();
                    form[0].reset();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        });
</script>

<script type="text/javascript">

    /*datatable setup*/
    
    var table = $('#penomoran-spt').DataTable({        
        'pageLength': 50,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
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
        ajax: '{{ route("get-penomoran") }}',
        deferRender: true,
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            {data: 'name', name: 'name', 'title': "{{ __('Nama') }}"},
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis') }}"},
            {data: 'lokasi', name: 'lokasi', 'title': "{{ __('Lokasi') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

    

</script>