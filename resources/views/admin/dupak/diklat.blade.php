<script type="text/javascript">
//start generate table dupak diklat
    function generate_tabel_diklat(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak_diklat") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
      //console.log(response[0].irban_kepala.pejabat);
      var header = generate_header(response.user, response.pejabat, 'Pendidikan dan Pelatihan');
      var footer = generate_footer(response.user, response.pejabat);
      var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-diklat-table">';       
        table += '<tr style="background: #ccc; text-align: center">'
                +'<th rowspan="2">No.</th>'
                +'<th colspan="2">Uraian Kegiatan</th>'
                +'<th rowspan="2">Tanggal</th>'
                +'<th rowspan="2">Satuan AK</th>'
                +'<th rowspan="2">Jumlah Jam</th>'
                +'<th rowspan="2">Jumlah AK</th>'
                +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>Kode</th>'
                  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>1</th>'
                  +'<th>2</th>'
                  +'<th>3</th>'
                  +'<th>4</th>'
                  +'<th>5</th>'
                  +'<th>6</th>'
                  +'<th>7</th>'
                  +'<th>8</th>'
              +'</tr>';
      if(response.ak.length > 0) {
        var year = new Date().getFullYear();
        $.each(response.ak, function (i, item) {
          var n = i+1;            
              table += '<tr>'
              +'<td>' + n + '</td>'
              +'<td></td>'
              +'<td>'+ item.spt_umum.info_untuk_umum+'</td>'
              //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td style="text-align: center;">' + item.spt_umum.periode + '</td>'
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td style="text-align: center">'+ item.info_dupak.lama +'</td>' 
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td>SPT No.700/'+ item.spt_umum.nomor +'/438.4/'+year+'<br/><br/></td>'
              +'</tr>';
        });       
        
        //$( "#dupak-diklat-wrapper" ).html(header+table+footer);
      }else {       
        table += '<tr style="height:300px;">'
              +'<td></td>'
              +'<td></td>'
              +'<td></td>'
              //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td style="text-align: center;"></td>'
              +'<td style="text-align: center"></td>'
              +'<td style="text-align: center"></td>' 
              +'<td style="text-align: center"></td>'
              +'<td></td>'
              +'</tr>';
      }
      table += '</table>';
      $( "#dupak-diklat-wrapper" ).html(header+table+footer);
    }
  });
  }
  //end tabel diklat
  </script>