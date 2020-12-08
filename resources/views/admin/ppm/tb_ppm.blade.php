@section('nav_ppm')
@foreach(auth()->user()->menuPpm() as $ppm)
@if((auth()->user()->id == $ppm->id) ? true : false === true)
@hasanyrole('Auditor')
<li class="nav-item">
  <a class="nav-link" id="ppm-nav" href="#ppm-tab" role="tab" aria-controls="ppm-tab" aria-selected="false">SATGAS PPM</a>
</li>
<script type="text/javascript">
  /*disable button tambah ppm*/
  $('.nav-link').click(
     function() {
      $this = $(this);
      
      var ctest = $('#ppm-nav').hasClass('active');
      if (ctest == true) {
        $('#btn-input-ppm').hide('fast');
      }
      if (ctest != true) {
        $('#btn-input-ppm').show('fast');
      }
      // console.log(ctest);
      }
    );

</script>
@endhasanyrole
@endif
@endforeach

@hasanyrole('Super Admin|TU Umum')
<!-- <li class="nav-item">
  <a class="nav-link"  href="#ppm-tab" role="tab" aria-controls="ppm-tab" aria-selected="false">Data PPM</a>
</li> -->
@endhasanyrole

@endsection



@section('content_ppm')
@hasanyrole('Auditor')

<div class="tab-pane" id="ppm-tab" role="tabpanel" aria-labelledby="ppm-tab">
  <h4 class="text-center">{{ __('Data Program Pelatihan Mandiri') }}</h4>
<div class="modal-body">           
    <div class="card-body table-responsive">
        <div class="table-responsive">
            <!-- start tabel data ppm -->
            <div class="table-responsive">
                <table id="tabel-ppm" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- end tabel -->
        </div>
    </div>
</div>
</div>
@endhasanyrole
@hasanyrole('Super Admin|TU Umum')
<!-- <div class="tab-pane" id="ppm-tab" role="tabpanel" aria-labelledby="ppm-tab"> -->
  <h4 class="text-center">{{ __('Data Program Pelatihan Mandiri') }}</h4>
<div class="modal-body">           
    <div class="card-body table-responsive">
        <div class="table-responsive">
            <!-- start tabel data ppm -->
            <div class="table-responsive">
                <table id="tabel-ppm" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- end tabel -->
        </div>
    </div>
</div>
<!-- </div> -->
@endhasanyrole

<!-- modal list anggota -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="modalListAnggotaPpm">
  <div class="modal-dialog modal-xl" style="max-width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mySmallModalPemeriksaan">List Anggota PPM</h4>
        <button type="button" class="close" id="close-modalData-pemeriksaan" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card-body table-responsive">
            <!-- start tabel list data anggota ppm -->
            <div class="table-responsive">
                <table id="tabel-list-anggota-ppm" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
            <!-- end tabel -->
          </div>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->


@endsection

@section('js_ppm')
    <!-- starat js tabel pelatihan mandiri tanpa spt -->
    <script type="text/javascript">
        var table = $('#tabel-ppm').DataTable({        
            'pageLength': 10,
            autoWidth: false,
            // dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
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
            ajax: "{{ route('getdata_ppm') }}",
            /*deferRender: true,*/
            columns: [
                {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
                },
                {data: 'kegiatan', name: 'kegiatan', 'title': "{{ __('Kegiatan') }}"},
                {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
                {data: 'jenis_ppm', name: 'jenis_ppm', 'title': "{{ __('Jenis PPM') }}"},
                // {data: 'nota', name: 'nota', 'title': "{{ __('Nota Dinas') }}"},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            ],        
            columnDefs : [
              {"width": '2%', "targets": 0},
              // {"width": '5%', "targets": 2},
              {"width": '19%', "targets": 1},
              {
                "width": '10%', 
                "targets": 2,
                //"data" : null,
                /*"render": function ( data, type, row, meta ) {
                  tambahan = (data.tambahan.length > 0 ) ? '<br/><small class="text-muted">'+data.tambahan+'</small>' : ''
                  return data.jenis+tambahan;
                }*/
              },
              {"width": '20%', "targets": 3},
              {"width": '5%', "targets": 4},
              // {"width": '15%', "targets": 6},
            ]
        });

        // show modal list anggota ppm
        function showModalListPpm(id){
            // $('#modalListAnggotaPpm').modal('show');
            $('#modalListAnggotaPpm').modal('show');

            url = (window.location.pathname == '/admin/ppm/index' || window.location.pathname == '/public/admin/ppm/index') ? "{{ url('admin/ppm/get-ppm-byid') }}" +'/'+id : '/ppm/get-ppm-byid';

            // var table = $('#tabel-list-anggota-ppm').DataTable({

            //     retrieve: true,
            //     paging: false,
            //     ajax: url,
            //     type: "GET",
            //     dataType: "JSON",
            //     columns: [
            //         {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            //         },
            //         {data: 'kegiatan', name: 'kegiatan', 'title': "{{ __('Kegiatan') }}"},
            //         {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
            //         // {data: 'nota', name: 'nota', 'title': "{{ __('Nota Dinas') }}"},
            //         {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            //     ],        
            //     "order": [[ 1, 'asc' ]],
            // });

            var table = $('#tabel-list-anggota-ppm').DataTable({        
                'pageLength': 10,
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
                ajax: url,
                /*deferRender: true,*/
                columns: [
                    {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
                    },
                    {data: 'nama', name: 'nama', 'title': "{{ __('Nama') }}"},
                    {data: 'peran', name: 'peran', 'title': "{{ __('Keterangan') }}"},
                    // {data: 'nota', name: 'nota', 'title': "{{ __('Nota Dinas') }}"},
                    // {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
                ],        
                "order": [[ 1, 'asc' ]],
            });
        }

    </script>
    <!-- end js -->
@endsection

<!-- </div> -->