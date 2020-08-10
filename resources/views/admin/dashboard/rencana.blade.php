<div class="col-md-12 dasboard-bg-color">
	<div class="card">
	  <div class="card-header">
	    TU Perencanaan
	  </div>
	  <div class="card-body">
	    <div class="card-body table-responsive">
        	<table id="spt-perencanaan" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
        	    <thead></thead>
        	    <tbody></tbody>
        	</table>
        	<!-- <p>1. button untuk pengawas belum terpisah antara ketuatim dan pengawas dll <br> 2. printnya ada error untuk status['dalnis']</p> -->
        </div>
	  </div>
	</div>
</div>

<script type="text/javascript">
	var table = $('#spt-perencanaan').DataTable({        
        'pageLength': 50,
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
        ajax: '{{ url("/admin/spt/getdata") }}',
        /*deferRender: true,*/
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis Pemeriksaan') }}"},
            {data: 'tanggal_mulai', name: 'tanggal_mulai', 'title': "{{ __('Tgl Mulai') }}"},
            {data: 'tanggal_akhir', name: 'tanggal_akhir', 'title': "{{ __('Tgl Akhir') }}"},
            {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
            {data: 'lokasi', name: 'lokasi', 'title': "{{ __('Lokasi') }}"},
            // {data: 'approval', name: 'approval', 'title': "{{ __('Status') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

</script>
