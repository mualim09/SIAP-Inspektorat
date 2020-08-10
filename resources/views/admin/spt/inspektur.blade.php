<div class="col-md-12 dasboard-bg-color">
    <div class="card">
      <div class="card-header">
        Pengajuan Persetujuan SPT
      </div>
      <div class="card-body">
        <table id="processing-spt" class="table spt-table table-striped table-sm ajax-table">
            <thead></thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
</div>
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalFormPenolakanSpt">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalLabel">Form penolakan SPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="ajax-form" id="form-penolakan">
            <input type="hidden" name="spt_id" id="spt-id">
            <div class="form-group row">
                <label for="nomor" class="col-sm-4 col-form-label">{{ __('Catatan')}} </label>                
                <textarea rows="5" id="notes" class="summernote form-control form-control-alternative @error('notes') is-invalid @enderror" name="notes" ></textarea>                
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
        </form>
      </div>
    </div>
  </div>
</div>
    

<script type="text/javascript">

    /*datatable setup*/
    
    var table = $('#processing-spt').DataTable({        
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
        ajax: '{{ route("get-processing-spt") }}',
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

    function sign(spt_id){
        var spt_id = spt_id;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var approval_status = 'approved';        
        $.ajax({
            url : 'spt/sign-reject',
            type: 'POST',
            data: {spt_id:spt_id, '_token' : csrf_token, approval_status:approval_status},
            success : function(data){
                console.log('success:',data);
                $('#processing-spt').DataTable().ajax.reload();
            },
            error: function(error){
                console.log('Error:', error);
            }
        });
    }

    function showRejectFormModal(spt_id){
        $('#modalFormPenolakanSpt').modal('show');
        $('#spt-id').val(spt_id);
    }

    $('#form-penolakan').submit(function(event){
            event.preventDefault();
            var form = $(this);
            var spt_id = $('#spt-id').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var approval_status = 'rejected';
            var notes = $('#notes').val();
            $.ajax({
                url: "spt/sign-reject",
                type: 'post',
                data: {spt_id:spt_id, approval_status:approval_status, '_token' : csrf_token, notes:notes},
                success: function(data){                    
                    console.log('success:',data);
                    $('#modalFormPenolakanSpt').modal('hide');
                    form[0].reset();
                    table.ajax.reload();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        });
</script>