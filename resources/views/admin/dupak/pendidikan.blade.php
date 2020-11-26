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
      if(response.length>0){
	    
	    var header = generate_header(response,'pendidikan');
      var footer = generate_footer(response);

      //No	Uraian Sub Unsur  class="col-print-th"
      var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pendidikan-table">';

          table += '<tr style="background: #ccc; text-align: center">'
              +'<th>No.</th>'
              +'<th>Uraian Sub Unsur</th>'
              +'<th>Butir Kegiatan</th>'
              +'<th>Angka Kredit</th>'
              +'<th>Keterangan</th>'
            +'</tr>';
            //response[0].user_dupak.pendidikan.tingkat
        $.each(response, function (i, item) {
          var n = i+1;
            table += '<tr>'
              +'<td>' + n + '</td>'
              +'<td>' + item.user_dupak.pendidikan.tingkat + '</td>'
              +'<td>' + item.user_dupak.pendidikan.jurusan + '</td>'
              +'<td style="text-align: center">'+ item.dupak +'</td>'
              +'<td></td>'
              '</tr>';
          dupak = item.dupak++;
        });
        table += '<tr class="col-print-data">'
          +'<td colspan="3">JUMLAH</td>'
          +'<td colspan="2">'+ dupak +'</td>'
          +'</tr>';

        //close table tag
        table += '</table>';
        
        $( "#dupak-pendidikan-wrapper" ).html( header+table+footer );
        //$('#dupak-pendidikan-table').html(trHTML);
      }else{
        $("#dupak-pendidikan-wrapper").html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
        $('#dupak-pendidikan-wrapper').addClass('no-print');
      }
    }
  });
  }
  //end table pendidikan
  </script>