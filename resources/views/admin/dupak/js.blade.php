<script type="text/javascript">
    /*datatable setup*/

    var dupak_pengawasan_table = $('#dupak-pengawasan-tablez').DataTable({
        'pageLength': 50,
        'searching': false,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[
            {
                extend:'excelHtml5',
                text: 'Excel',
                title:'Daftar Perolehan Angka Kredit',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                },
                customize: function( xlsx ) {
                  setSheetName(xlsx, 'Pengawasan');
                  //exportText('pengawasan');
                  //addSheet(xlsx, '#dupak-pendidikan-table', 'Pendidikan', 'Pendidikan', '2');
                },

            },
            /*{
                extend:'pdf',
                title:'Daftar Perolehan Angka Kredit',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            } */
        ],


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
        /*ajax: '{{ route("data_dupak") }}',*/
        ajax: {
            url:'{{ route("data_dupak") }}',
            //data:{tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir}
            data: function(d){
                d.user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
                d.semester = $('#semester option:selected').val();
                d.tahun = $('#tahun').val();
            }
           },
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '2%'},
            {data: 'tanggal_spt', name: 'tanggal_spt', 'title': "{{ __('Tanggal SPT') }}",  width: '15%'},
            {data: 'lama_spt', name: 'lama_spt', 'title': "{{ __('Lama SPT') }}", width: '10%'},
            {data: 'efektif', name: 'efektif', 'title': "{{ __('Efektif') }}",  width: '10%'},
            {data: 'kegiatan', name: 'kegiatan', 'title': "{{ __('Kegiatan') }}", width: '23%'},
            {data: 'koefisien', name: 'koefisien', 'title': "{{ __('Koefisien') }}", width: '10%'},
            {data: 'dupak', name: 'dupak', 'title': "{{ __('AK') }}",  width: '5%'},
            {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}",  width: '10%'},
            {data: 'lembur', name: 'lembur', 'title': "{{ __('Lembur') }}",  width: '10%'},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
        ],
        "order": [[ 1, 'asc' ]],
    });

    var dupak_pendidikan_table = $('#dupak-pendidikan-tablez').DataTable({
        'pageLength': 50,
        'searching': false,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[
            {
                extend:'excelHtml5',
                text: 'Excel',
                title:'Angka Kredit Pendidikan',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                },
                customize: function( xlsx ) {
                  setSheetName(xlsx, 'Pendidikan');
                  //exportText('pengawasan');
                  //addSheet(xlsx, '#dupak-pengawasan-table', 'Pengawasan', 'Pengawasan', '1');
                },

            },
        ],
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
        /*ajax: '{{ route("data_dupak") }}',*/
        ajax: {
            url:'{{ route("data_dupak_pendidikan") }}',
            //data:{tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir}
            data: function(d){
                d.user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
            }
           },
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '2%'},
            {data: 'sub_unsur', name: 'tanggal_spt', 'title': "{{ __('Sub Unsur') }}"},
            {data: 'butir_kegiatan', name: 'butir_kegiatan', 'title': "{{ __('Butir Kegiatan') }}"},
            {data: 'dupak', name: 'dupak', 'title': "{{ __('Angka Kredit') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('') }}", 'exportable' : false,'printable': false},
        ],
        "order": [[ 1, 'asc' ]],
    });


    function isiDupakUser(user_id){
        $('#user-id').val(user_id);
        $('#modalFormIsiDupak').modal('show');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $('#form-cari-dupak').on('submit', function(e) {
        //dupak_pengawasan_table.draw();//versi datatable
        //dupak_pendidikan_table.draw();//versi datatable
        //e.preventDefault();
        tab = '<li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#dupak-pengawasan">Pengawasan</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-pendidikan">Pendidikan</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-penunjang">Penunjang</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-pengembangan">Pengembangan</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-diklat">Diklat</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-lak">LAK</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-dupak">DUPAK</a></li>'
              +'<li class="nav-item"><a data-toggle="tab" class="nav-link" href="#dupak-pak">PAK</a></li>';
        $('#dupak-tab').html(tab);

        //coba versi html biasa
        generate_tabel_pengawasan();
        generate_tabel_pendidikan();
        generate_tabel_penunjang();
        generate_tabel_pengembangan();
        generate_tabel_diklat();
        generate_tabel_lak();
        //generate_tabel_pak();
        e.preventDefault();
    });

$('.datepicker').each(function() {
        $(this).datepicker({
            language: "{{ config('app.locale')}}",
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        });
    });
    $("#tgl-mulai").on('changeDate', function(selected) {
        var startDate = new Date(selected.date.valueOf());
        $("#tgl-akhir").datepicker('setStartDate', startDate);
        if($("#tgl-mulai").val() > $("#tgl-akhir").val()){
          $("#tgl-akhir").val($("#tgl-mulai").val());
        }
        $(this).closest('div').next().find('input').focus();
    });

function printDiv(divName){
 //printJS(divName, 'html');
 //$( "div.no-print" ).parents().css( 'display','none' );
  printJS({
    printable : divName,
    type: 'html',
    css: "{{ asset('css/print.css') }}",
    scanStyles: false
  });
  //return false;
}

</script>

@include('admin.dupak.export')
@include('admin.dupak.pengawasan')
@include('admin.dupak.pendidikan')
@include('admin.dupak.diklat')
@include('admin.dupak.penunjang')
@include('admin.dupak.pengembangan')
@include('admin.dupak.lak')
@include('admin.dupak.dupak')
@include('admin.dupak.pak')
