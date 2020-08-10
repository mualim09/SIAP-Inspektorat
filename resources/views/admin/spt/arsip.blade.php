@section('nav_tab_arsip')
<li class="nav-item">
  <a class="nav-link"  href="#arsip-tab" role="tab" aria-controls="arsip-tab" aria-selected="false">Arsip SPT</a>
</li>
@endsection

@section('tab_content_arsip')
<div class="tab-pane" id="arsip-tab" role="tabpanel" aria-labelledby="arsip-tab">
  <h4 class="text-center"> Arsip SPT </h4>
  <table id="arsip-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;table-layout: fixed;">
      <thead></thead>
      <tbody></tbody>
  </table>
</div>
@endsection

@section('js_arsip')
<script type="text/javascript">
  /*datatable setup*/

   $('#arsip-spt').DataTable({
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
        ajax: '{{ route("get_data_spt","arsip") }}',
        deferRender: true,
        columns: [
          {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true},
          {data: 'nomor', name: 'nomor', 'title': "{{ __('Nomor') }}"},
          {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
          {data: 'ringkasan', name: 'ringkasan', 'title': "{{ __('Ringkasan') }}", 'allowHTML': true},
          /*{data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tanggal Mulai') }}"},
          {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tanggal Akhir') }}"},*/
          {data: 'periode', name: 'periode', 'title': "{{ __('Tanggal') }}"},
          {data: 'lama', name: 'lama', 'title': "{{ __('Lama ') }}"},
          {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
        ],
        columnDefs : [
          {"width": '2%', "targets": 0},
          {"width": '5%', "targets": 1},
          {"width": '10%', "targets": 2},
          {
            "width": '45%', 
            "targets": 3,
            //"data" : null,
            /*"render": function ( data, type, row, meta ) {
              tambahan = (data.tambahan.length > 0 ) ? '<br/><small class="text-muted">'+data.tambahan+'</small>' : ''
              return data.jenis+tambahan;
            }*/
          },
          {"width": '20%', "targets": 4},
          {"width": '5%', "targets": 5},
          {"width": '15%', "targets": 6},
        ]
    });
</script>
@endsection


