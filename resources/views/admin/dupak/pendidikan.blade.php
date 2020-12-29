 <script type="text/javascript">
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
      var header = generate_header(response.user, response.pejabat, 'Pendidikan');
      var footer = generate_footer(response.user, response.pejabat);
      var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pendidikan-table">';

      table += '<tr style="background: #ccc; text-align: center">'
              +'<th>No.</th>'
              +'<th>Uraian Sub Unsur</th>'
              +'<th>Butir Kegiatan</th>'
              +'<th>Angka Kredit</th>'
              +'<th>Keterangan</th>'
            +'</tr>';
     
      table += '<tr style="height:300px">'
              +'<td></td>'
              +'<td></td>'
              +'<td></td>'
              +'<td style="text-align: center"></td>'
              +'<td></td>'
              '</tr>';
      table += '<tr class="col-print-data">'
          +'<td colspan="3" style="text-align: center; font-weight:bold;">JUMLAH</td>'
          +'<td colspan="2"></td>'
          +'</tr>';

        //close table tag
        table += '</table>';
        $( "#dupak-pendidikan-wrapper" ).html(header+table+footer);
    }
  });
  }
  //end table pendidikan
  </script>