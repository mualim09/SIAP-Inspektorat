
@section('nav_tab_penomoran')
<li class="nav-item">
  <a class="nav-link" href="#penomoran-tab" role="tab" aria-controls="penomoran-tab" aria-selected="true">Daftar SPT Pengawasan</a>
</li>
@endsection

@section('tab_content_penomoran')
<div class="tab-pane" id="penomoran-tab" role="tabpanel">
  <h4 class="text-center"> Daftar SPT Pengawasan </h4>
  <table id="penomoran-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
      <thead></thead>
      <tbody></tbody>
  </table>
</div>
@endsection

<!-- Start Form penomoran -->
@section('form_penomoran')
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="formPenomoranModal" aria-hidden="true" id="modalFormPenomoranSpt">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="header-form-penerusan">{{__('Teruskan SPT')}}</h4>        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="ajax-form" id="form-penomoran" enctype="multipart/form-data">
            <input type="hidden" name="spt_id" id="spt-id">
            <div class="form-group row">
                <label for="nomor" class="col-md-3 col-form-label text-md-right">{{ __('Nomor')}} </label>
                <input type="text" name="nomor" class="form-control col-md-8" required placeholder="Nomor SPT" id="nomor-spt">                    
            </div>

            <div class="form-group row">                
                <label for="tgl-register" class="col-md-3 col-form-label text-md-right">{{ __('Tanggal') }}</label>
                <input type="text" class="form-control datepicker col-md-8" name="tgl_register" id="tgl-register" autocomplete="off" placeholder="{{ __('Tanggal Register')}}" value="{{ date('d-m-Y') }}">
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
                <input type="file" class="custom-file-input" id="customFile" name="file_spt" accept=".pdf">
                <label class="custom-file-label" for="customFile">Pilih Scan File SPT</label>                    
              </div>
              <div class="offset-md-3">File format pdf, max 2MB</div>
            </div>
            <!-- <small id="formPenomoranHelp" class="form-text text-muted">Form teruskan SPT secara otomatis mendeteksi nomor SPT dan meneruskan SPT kepada pegawai SPT yang bersangkutan.</small> -->
            <script>
              // Add the following code if you want the name of the file appear on select
              $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

                //upload on change
                var formData = new FormData();
                var file = this.files[0];
                var id = $('#spt-id').val();
                formData.append('formData', file);
                formData.append('id', id);
                $.ajax({
                    url: "{{ route('ajax_upload_spt')}}",  //Server script to process data
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    //Ajax events
                    success: function(response){
                        document.getElementById("nomor-spt").value = response;
                    }
                });
              });
            </script>
            
            
            
            <button type="submit" class="btn btn-primary col"><i class="fa fa-save"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- form upload scan SPT dijadikan satu dengan penomoran, karena fungsi upload ada pada proses penomoran -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="formPenomoranModal" aria-hidden="true" id="modalFormUploadSpt">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="formUploadSptModal">Upload SPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="ajax-form" id="form-upload" enctype="multipart/form-data">
            <input type="hidden" name="spt_id" id="spt-id-upload">
            <div class="row">
              <div class="col-md-3 text-md-right">Scan</div>
              <div class="custom-file col-md-8">
                <input type="file" class="custom-file-input" id="fileSpt" name="file_spt" accept=".pdf">
                <label class="custom-file-label" for="fileSpt">Pilih Scan File SPT</label>                    
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
<!-- End form upload SPT -->

@endsection
<!-- End form penomoran -->

@section('js_penomoran')
  <script type="text/javascript">
      function showFormModal(spt_id){
          $('#spt-id').val(spt_id);
          $('#modalFormPenomoranSpt').modal('show');          
          url = "{{ route('last_data', 'nomor') }}";
          $.ajax({
              url : url,
              success: function(results) {                  
                  $('#nomor-spt').val(results.nomor);
              },
              error: function(error) {
                  console.log(error);
              }
          });
      }

      //show modal upload SPT
      function uploadSpt(spt_id){
          $('#spt-id-upload').val(spt_id);
          $('#modalFormUploadSpt').modal('show');          
      }
      
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    //proses upload SPT
    $("#form-upload").validate({
        rules: {
            file_spt : {required: true}
        },
        submitHandler: function(form){
            var id = $('#spt-id-upload').val();              
            //url ='spt/upload-scan/' + id ;
            url = (window.location.pathname == '/admin') ? 'admin/spt/upload-scan/'+id : 'spt/upload-scan/'+id;
            type = "POST";
            var formData = new FormData($(form)[0]);
            $.ajax({
                url: url,
                type: type,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                  //console.log('success:',data);
                  $('#modalFormUploadSpt').modal('hide');
                  $('#penomoran-spt').DataTable().ajax.reload();
                  $('#arsip-spt').DataTable().ajax.reload();
                  $('#form-upload')[0].reset();                      
                },
                error: function(request, status, error){                      
                  console.log(error);
                }
            });
            return false;
        }
    });


     $("#form-penomoran").validate({
        rules: {            
            tgl_register : {required: true}
        },
        submitHandler: function(form){
            var id = $('#spt-id').val();
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
                  //console.log('success:',data);
                  $('#modalFormPenomoranSpt').modal('hide');
                  $('#penomoran-spt').DataTable().ajax.reload();
                  $('#arsip-spt').DataTable().ajax.reload();
                  $('#form-penomoran')[0].reset();                      
                },
                error: function(request, status, error){                      
                  console.log(request);
                }
            });
            return false;
        }
    });

     //datatable penomoran SPT
     $('#penomoran-spt').DataTable({
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
          ajax: '{{ route("get_data_spt","penomoran") }}',
          deferRender: true,
          columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true},
            {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}"},
            /*{data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
            {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},*/
            {data: 'periode', name: 'periode', 'title': "{{ __('Tanggal') }}"},
            {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
          ],
          columnDefs : [
            {"width": '2%', "targets": 0},
          /*{"width": '10%', "targets": 2},*/
          {
            "width": '58%', 
            "targets": 1,
            //"data" : null,
            /*"render": function ( data, type, row, meta ) {
              tambahan = (data.tambahan.length > 0 ) ? '<br/><small class="text-muted">'+data.tambahan+'</small>' : ''
              return data.jenis+tambahan;
            }*/
          },
          {"width": '20%', "targets": 2},
          {"width": '5%', "targets": 3},
          {"width": '15%', "targets": 4},
          ]
      });

  </script> 
  @endsection