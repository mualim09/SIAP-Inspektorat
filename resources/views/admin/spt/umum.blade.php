
@section('nav_tab_spt_umum')
<li class="nav-item">
  <a class="nav-link" href="#spt-umum-tab" role="tab" aria-controls="spt-umum-tab" aria-selected="true">Penomoran SPT Umum</a>
</li>
@endsection

@section('tab_content_spt_umum')
<div class="tab-pane" id="spt-umum-tab">
  <div class="card">
    <h4 class="text-center"> Penomoran SPT Umum </h4>
    <div class="card-body table-responsive">
      <div class="table-responsive">
        <table id="spt-umum" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
            <thead></thead>
            <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <h4 class="text-center"> Arsip SPT Umum</h4>
    <div class="card-body table-responsive">
      <div class="table-responsive">
          <table id="arsip-spt-umum" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
              <thead></thead>
              <tbody></tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="formPenomoranModal" aria-hidden="true" id="modalFormPenomoranSptUmum">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formPenomoranModal">Penomoran SPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="ajax-form" id="form-penomoran-umum" enctype="multipart/form-data">
            <input type="hidden" name="spt_id" id="spt-id-umum">
            <input type="hidden" name="jenis_spt_umum" id="jenis-spt-umum">
            <div class="form-group row">
                <label for="nomor" class="col-md-3 col-form-label text-md-right">{{ __('Nomor')}} </label>
                <input type="text" name="nomor_umum" class="form-control col-md-8" required placeholder="Nomor SPT" id="nomor-spt-umum">                    
            </div>

            <div class="form-group row">                
                <label for="tgl-register" class="col-md-3 col-form-label text-md-right">{{ __('Tanggal') }}</label>
                <input type="text" class="form-control datepicker col-md-8" name="tgl_register_umum" id="tgl-register-umum" autocomplete="off" placeholder="{{ __('Tanggal Register')}}">
            </div>
            <script type="text/javascript">
              $('.datepicker').each(function() {
                  $(this).datepicker({
                      language: "{{ config('app.locale')}}",
                      format: 'dd-mm-yyyy',
                      autoclose: true,
                      todayHighlight: true,
                  });
              });
            </script>

            <div class="row">
              <div class="col-md-3 text-md-right">Scan</div>
              <div class="custom-file col-md-8">
                <input type="file" class="custom-file-input" id="customFile" name="file_spt_umum" accept=".pdf">
                <label class="custom-file-label" for="customFile">Pilih Scan File SPT</label>                    
              </div>
              <div class="offset-md-3">File format pdf, max 2MB</div>
              
            </div>
            <script>
              // Add the following code if you want the name of the file appear on select
              $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              });
            </script>
            
            
            
            <button type="submit" class="btn btn-primary col"><i class="fa fa-save"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('js_umum')
<script type="text/javascript">
  // show modal by id from controller
  function showFormModalUmum(spt_id){
      $('#spt-id-umum').val(spt_id);
      $('#modalFormPenomoranSptUmum').modal('show');
      url = "{{ route('last_data_umum', 'nomor') }}";
      $.ajax({
          url : url,
          success: function(results) {                  
              $('#nomor-spt-umum').val(results.nomor);
          },
          error: function(error) {
              console.log(error);
          }
      });
  }

  $(document).on('show.bs.modal','#modalFormPenomoranSptUmum', function () { //fungsi ketika modal hide mendestroy data table yg di dlm modal
        // alert('jalan');
        // $('#dataKKA-perAuditor').dataTable().fnDestroy(); //mendestroy data table
        var id = $('#spt-id-umum').attr('value');
        // console.log(id);
        url = "{{ url('admin/spt/get-spt-umum-byid') }}" +'/'+id;
        $.ajax({
            type: "GET",
            url : url,
            success: function(data) {
                $('input[name=jenis_spt_umum]').val(data.jenis_spt_umum);
                // console.log(data.jenis_spt_umum);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

  // validate data from form penomoran umum
  $("#form-penomoran-umum").validate({
        rules: {
            nomor_umum : {required: true},
            tgl_register_umum : {required: true},
            // file_spt_umum : {required: true}
        },
        submitHandler: function(form){
            var id = $('#spt-id-umum').val();
            //url ='spt/update-nomor/' + id ;
            url = (window.location.pathname == '/admin') ? 'admin/spt/update-nomor/'+id : 'spt/update-nomor/'+id;
            type = "POST";
            var formData = new FormData($(form)[0]);
            $.ajax({
                url: url,
                type: type,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                  console.log('success:',data);
                  $('#modalFormPenomoranSptUmum').modal('hide');
                  $('#spt-umum').DataTable().ajax.reload();
                  $('#arsip-spt-umum').DataTable().ajax.reload();
                  $('#form-penomoran-umum')[0].reset();                      
                },
                error: function(request, status, error){                      
                  console.log(request);
                }
            });
            return false;
        }
    });

  //datatable penomoran SPT
     $('#spt-umum').DataTable({
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
          ajax: '{{ route("penomoran_umum") }}',
          deferRender: true,
          columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true},
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
            // {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}"},
            // {data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
            // {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},
            // {data: 'periode', name: 'periode', 'title': "{{ __('Tanggal') }}"},
            {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
          ],
      });

     $('#arsip-spt-umum').DataTable({
        'pageLength': 50,
        autoWidth: false,
        //dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
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
        ajax: '{{ route("arsip_spt_umum") }}',
        deferRender: true,
        columns: [
          {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true},
          {data: 'nomor', name: 'nomor', 'title': "{{ __('Nomor') }}"},
          {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
          // {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}", 'allowHTML': true},
          /*{data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
          {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},*/
          {data: 'periode', name: 'periode', 'title': "{{ __('Tanggal') }}"},
          {data: 'lama', name: 'lama', 'title': "{{ __('Lama ') }}"},
          {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
        ],
        // columnDefs : [
        //   {"width": '2%', "targets": 0},
        //   {"width": '5%', "targets": 1},
        //   {"width": '10%', "targets": 2},
        //   {
        //     "width": '45%', 
        //     "targets": 3,
        //     //"data" : null,
        //     "render": function ( data, type, row, meta ) {
        //       tambahan = (data.tambahan.length > 0 ) ? '<br/><small class="text-muted">'+data.tambahan+'</small>' : ''
        //       return data.jenis+tambahan;
        //     }
        //   },
        //   {"width": '20%', "targets": 4},
        //   {"width": '5%', "targets": 5},
        //   {"width": '15%', "targets": 6},
        // ]
    });
</script>
@endsection