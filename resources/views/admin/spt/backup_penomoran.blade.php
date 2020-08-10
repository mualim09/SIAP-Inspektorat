 <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="spt-list" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#penomoran-tab" role="tab" aria-controls="penomoran-tab" aria-selected="true">Penomoran SPT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="#arsip-tab" role="tab" aria-controls="arsip-tab" aria-selected="false">Arsip SPT</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
            <div class="tab-pane active" id="penomoran-tab" role="tabpanel">
              <h4 class="text-center"> Penomoran SPT </h4>
              <table id="penomoran-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
                  <thead></thead>
                  <tbody></tbody>
              </table>
            </div>

            <div class="tab-pane" id="arsip-tab" role="tabpanel" aria-labelledby="arsip-tab">
              <h4 class="text-center"> Arsip SPT </h4>
              <table id="arsip-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
                  <thead></thead>
                  <tbody></tbody>
              </table>
            </div>
            
          </div>
          
        </div>
    </div>     
  </div>
  <script type="text/javascript">
    $('#spt-list a').on('click', function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
  </script>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="formPenomoranModal" aria-hidden="true" id="modalFormPenomoranSpt">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="formPenomoranModal">Penomoran SPT</h4>
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
                    <input type="text" class="form-control datepicker col-md-8" name="tgl_register" id="tgl-register" autocomplete="off" placeholder="{{ __('Tanggal Register')}}">
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

    <script type="text/javascript">
        function showFormModal(spt_id){
            $('#spt-id').val(spt_id);
            $('#modalFormPenomoranSpt').modal('show');
            $.ajax({
                url: '{{ url("/admin/spt/last-data/nomor") }}',
                success: function(results) {
                    console.log(results);
                    $('#nomor-spt').val(results.nomor);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


       $("#form-penomoran").validate({
          rules: {
              nomor : {required: true},
              tgl_register : {required: true}
          },
          submitHandler: function(form){
              var id = $('#spt-id').val();              
              url ='spt/update-nomor/' + id ;
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
                    $('#modalFormPenomoranSpt').modal('hide');
                    $('#penomoran-spt').DataTable().ajax.reload();
                    $('#form-penomoran')[0].reset();                      
                  },
                  error: function(request, status, error){                      
                    console.log(request);
                  }
              });
              return false;
          }
      });
    </script>

    <script type="text/javascript">
      /*datatable setup*/
      
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
              {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
              {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}"},
              {data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
              {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},
              {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
              {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            ],
            columnDefs : [
              {"width": '2%', "targets": 0},
              {"width": '10%', "targets": 1},
              {"width": '45%', "targets": 2},
              {"width": '10%', "targets": 3},
              {"width": '10%', "targets": 4},
              {"width": '10%', "targets": 5, "tooltip" : "Lama hari"},
              {"width": '13%', "targets": 6},
            ]
        });

       $('#arsip-spt').DataTable({
            'pageLength': 50,
            autoWidth: false,
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
            ajax: '{{ route("get_data_spt","arsip") }}',
            deferRender: true,
            columns: [
              {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true},
              {data: 'nomor', name: 'nomor', 'title': "{{ __('Nomor') }}"},
              {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
              {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}"},
              {data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
              {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},
              {data: 'lama', name: 'lama', 'title': "{{ __('Lama (Hari)') }}"},
              {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            ],
            columnDefs : [
              {"width": '2%', "targets": 0},
              {"width": '5%', "targets": 1},
              {"width": '10%', "targets": 2},
              {"width": '45%', "targets": 3},
              {"width": '10%', "targets": 4},
              {"width": '10%', "targets": 5},
              {"width": '5%', "targets": 6},
              {"width": '13%', "targets": 7},
            ]
        });
    </script>


@push('css')
  <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
  <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
@endpush