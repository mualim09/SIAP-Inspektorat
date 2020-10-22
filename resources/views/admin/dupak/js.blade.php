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

        //coba versi html biasa
        generate_tabel_pengawasan();
        generate_tabel_pendidikan();
        e.preventDefault();
    });

  function generate_tabel_pengawasan(){
    //url:'{{ route("data_dupak") }}'
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak") }}',
    type: 'GET',
    // data: function(d){
    //     d.user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    //     d.semester = $('#semester option:selected').val();
    //     d.tahun = $('#tahun').val();
    // },
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
      //console.log(response);
      //No.	Tanggal SPT			Hari SPT	hari Efektif	Kegiatan	Output		Koefisien	AK	PERAN	Lembur
      //info_dupak: {dupak: 0.26, lembur: 0, efektif: 4, lama_jam: 26, koefisien: 0.01}

        /*var trHTML = '<tr style="background:#fff; border:0px solid #000;><td colspan="10" align="center">SURAT PERNYATAAN</td></tr>'
            +'<tr style="background:#fff; border:0px solid #000;><td colspan="10" align="center">MELAKUKAN KEGIATAN PENGAWASAN</td></tr>'
            +'<tr style="background:#fff; border:0px solid #000;><td colspan="10">Jumlah jam = 6.5 jam</td></tr>'
            +'<tr style="background:#fff; border:0px solid #000;><td colspan="10">Jumlah hari efektif pertahun= 245 hari</td></tr>';
        */
        var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
        var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
        var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
        var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
          var trHTML = '<tr style="background:#fff"><td colspan="10" align="center">SURAT PERNYATAAN</td></tr>'
              +'<tr style="background:#fff; border:0px solid #000;"><td colspan="10" align="center">MELAKUKAN KEGIATAN PENGAWASAN</td></tr>'
              +'<tr style="background:#fff"><td colspan="10">Yang bertandatangan dibawah ini :</td></tr>' //typeof yourVariable === 'object' && yourVariable !== null
              +'<tr style="background:#fff"><td colspan="4">Nama</td><td colspan="6"> : '+ irban_kepala_name +'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">NIP</td><td colspan="6"> : '+ irban_kepala_nip +'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">Pangkat / golongan ruang</td><td colspan="6"> : '+ irban_kepala_pangkat +'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">J a b a t a n</td><td colspan="6"> : '+irban_kepala_jabatan+'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">Unit Kerja</td><td colspan="6"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
              +'<tr style="background:#fff"></tr>'
              +'<tr style="background:#fff"><td colspan="10">Menyatakan Bahwa :</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">Nama</td><td colspan="6"> : '+response[0].user_dupak.full_name_gelar+'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">NIP</td><td colspan="6"> : '+response[0].user_dupak.nip+'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">Pangkat / golongan ruang</td><td colspan="6"> : '+response[0].user_dupak.pangkat+'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">J a b a t a n</td><td colspan="6"> : '+response[0].user_dupak.jabatan+'</td></tr>'
              +'<tr style="background:#fff"><td colspan="4">Unit Kerja</td><td colspan="6"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
              +'<tr style="background:#fff" height="5"><td colspan="10"></td></tr>'
              +'<tr style="background:#fff" ><td colspan="10">Sudah melakukan kegiatan pengawasan sebagai berikut :</td></tr>';

            trHTML += '<tr><td colspan="10"></td></tr>'
              +'<tr class="table-dark">'
              +'<th>No.</th>'
              +'<th>Tanggal SPT</th>'
              +'<th>Lama SPT</th>'
              +'<th>Efektif</th>'
              +'<th>Kegiatan</th>'
              +'<th>Koefisien</th>'
              +'<th>Dupak</th>'
              +'<th>Peran</th>'
              +'<th>Lembur</th>'
              +'</tr>';
        $.each(response, function (i, item) {
          //console.log(item);
          var n = i+1;
            trHTML += '<tr>'
              +'<td>' + n + '</td>'
              +'<td>' + item.spt.periode + '</td>'
              +'<td>' + item.spt.lama + '</td>'
              +'<td>'+ item.info_dupak.efektif +'</td>'
              +'<td>'+ item.spt.kegiatan.sebutan +'</td>'
              +'<td>'+ item.info_dupak.koefisien +'</td>'
              +'<td>'+ item.info_dupak.dupak +'</td>'
              +'<td>'+ item.peran +'</td>'
              +'<td>'+ item.info_dupak.lembur +'</td>'
              '</tr>';
        });

        trHTML += '<tr>'
          +'<td colspan="10">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</td>'
          +'</tr>';

        trHTML += '<tr><td colspan="5"></td><td colspan="5">Atasan langsung</td>'
          +'<tr><td colspan="5"></td><td colspan="5">Inspektur Pembantu Wilayah</td>'
          +'<tr><td colspan="5"></td><td colspan="5"></td>'
          +'<tr><td colspan="5"></td><td colspan="5"></td>'
          +'<tr><td colspan="5"></td><td colspan="5"></td>'
          +'<tr><td colspan="5"></td><td colspan="5">'+irban_kepala_name+'</td>'
          +'<tr><td colspan="5"></td><td colspan="5">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+' </td>'
          +'<tr><td colspan="5"></td><td colspan="5">'+irban_kepala_nip+'</td>';
        //$( "#dupak-pengawasan-wrapper" ).prepend( "<h3 style=\"margin-top:20px;\">Angka Kredit Pengawasan</h3>" );
        $('#dupak-pengawasan-table').html(trHTML);
    }
  });
  }

  // start generate table pendidikan

  function generate_tabel_pendidikan(){
    //url:'{{ route("data_dupak") }}'
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak_pendidikan") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
      //console.log(response[0].irban_kepala);
      var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
      var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
      var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
      var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
        var trHTML = '<tr style="background:#fff" class="col-print-header"><td colspan="5" align="center">SURAT PERNYATAAN</td></tr>'
            +'<tr style="background:#fff;" class="col-print-header"><td colspan="5" align="center">MELAKUKAN KEGIATAN PENDIDIKAN SEKOLAH</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5">Yang bertandatangan dibawah ini :</td></tr>' //typeof yourVariable === 'object' && yourVariable !== null
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Nama</td><td colspan="3"> : '+ irban_kepala_name +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">NIP</td><td colspan="3"> : '+ irban_kepala_nip +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Pangkat / golongan ruang</td><td colspan="3"> : '+ irban_kepala_pangkat +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">J a b a t a n</td><td colspan="3"> : '+irban_kepala_jabatan+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Unit Kerja</td><td colspan="3"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5">Menyatakan Bahwa :</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Nama</td><td colspan="3"> : '+response[0].user_dupak.full_name_gelar+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">NIP</td><td colspan="3"> : '+response[0].user_dupak.nip+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Pangkat / golongan ruang</td><td colspan="3"> : '+response[0].user_dupak.pangkat+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">J a b a t a n</td><td colspan="3"> : '+response[0].user_dupak.jabatan+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Unit Kerja</td><td colspan="3"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5"></td></tr>';

            //No	Uraian Sub Unsur  class="col-print-th"

            trHTML += '<tr><td colspan="5"></td></tr>'
              +'<tr class="table-dark col-print-th">'
              +'<th>No.</th>'
              +'<th>Uraian Sub Unsur</th>'
              +'<th>Butir Kegiatan</th>'
              +'<th>Angka Kredit</th>'
              +'<th>Keterangan</th>'
              +'</tr>';
              //response[0].user_dupak.pendidikan.tingkat
        $.each(response, function (i, item) {

          var n = i+1;
            trHTML += '<tr class="col-print-data">'
              +'<td>' + n + '</td>'
              +'<td>' + item.user_dupak.pendidikan.tingkat + '</td>'
              +'<td>' + item.user_dupak.pendidikan.jurusan + '</td>'
              +'<td>'+ item.dupak +'</td>'
              +'<td></td>'
              '</tr>';
          dupak = item.dupak++;
        });
        trHTML += '<tr class="col-print-data">'
          +'<td colspan="3">JUMLAH</td>'
          +'<td colspan="2">'+ dupak +'</td>'
          +'</tr>';

        trHTML += '<tr>'
          +'<td colspan="5">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</td>'
          +'</tr>';

        trHTML += '<tr><td colspan="3"></td><td colspan="2">Atasan langsung</td>'
          +'<tr><td colspan="3"></td><td colspan="2">Inspektur Pembantu Wilayah</td>'
          +'<tr><td colspan="3"></td><td colspan="2"></td>'
          +'<tr><td colspan="3"></td><td colspan="2"></td>'
          +'<tr><td colspan="3"></td><td colspan="2"></td>'
          +'<tr><td colspan="3"></td><td colspan="2">'+irban_kepala_name+'</td>'
          +'<tr><td colspan="3"></td><td colspan="2">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+' </td>'
          +'<tr><td colspan="3"></td><td colspan="2">'+irban_kepala_nip+'</td>';
        //$( "#dupak-pendidikan-wrapper" ).prepend( "<h3 style=\"margin-top:20px;\">Angka Kredit Pendidikan</h3>" );
        $('#dupak-pendidikan-table').html(trHTML);
    }
  });
  }


  //end table pendidikan

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
  printJS({
    printable : divName,
    type: 'html',
    css: "{{ asset('css/print.css') }}",
    scanStyles: false
  });
}

</script>

@include('admin.dupak.export_tool')
@include('admin.dupak.export')
