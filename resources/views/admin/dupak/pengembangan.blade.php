<script type="text/javascript">
//start generate tabel pengembangan

function generate_tabel_pengembangan(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak_pengembangan") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {	    
      var header = generate_header(response.user, response.pejabat, 'Pengembangan Profesi');
      var footer = generate_footer(response.user, response.pejabat);
      var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pengembangan-table">';
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
      var sumPengembangan = 0, sumLamaPengembangan=0, sumLamaJamPengembangan=0;
      var n=1;

      //if response ak spt or ppm has data
      if(response.ak.spt.length>0 || response.ak.ppm.length>0){
      var year = new Date().getFullYear();
      if(response.ak.spt.length>0){
        //console.log(response.ak.spt);
        $.each(response.ak.spt, function (i, item) {
        
           table += '<tr>'
           +'<td >' + n + '</td>'
           +'<td></td>'
           +'<td>'+ item.spt_umum.info_untuk_umum+'</td>'
           //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
           +'<td style="text-align: center;">' + item.spt_umum.periode + '</td>'
           +'<td style="text-align: center">'+ item.info_dupak.koefisien +'</td>'
           +'<td style="text-align: center">'+ item.info_dupak.lama_jam +'</td>' 
           +'<td style="text-align: center">'+ parseFloat(item.info_dupak.dupak).toFixed(3) +'</td>'
           +'<td>'+ item.peran+'<br/><br/></td>'
           +'</tr>';
           sumPengembangan += parseFloat(item.info_dupak.dupak);
           sumLamaPengembangan += parseInt(item.spt_umum.lama);
           sumLamaJamPengembangan += parseInt(item.info_dupak.lama_jam);
           n = ++n;
         });
      }
      if(response.ak.ppm.length>0){        
        $.each(response.ak.ppm, function (i, item) {
               
               table += '<tr>'
               +'<td >' + n + '</td>'
               +'<td></td>'
               +'<td>'+ item.ppm.format_kegiatan+'</td>'
               //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'info_dupak: "{"lama_jam":3,"efektif":1,"lembur":0,"dupak":0.03,"koefisien":0.01}"
               +'<td style="text-align: center;">' + item.ppm.periode + '</td>'
               +'<td style="text-align: center">'+ item.info_dupak.koefisien +'</td>'
               +'<td style="text-align: center">'+ item.info_dupak.lama_jam +'</td>' 
               +'<td style="text-align: center">'+ parseFloat(item.info_dupak.dupak).toFixed(3) +'</td>'
               +'<td>'+ item.peran+'<br/><br/></td>'
               +'</tr>';
           sumPengembangan += parseFloat(item.info_dupak.dupak);
           sumLamaPengembangan += parseInt(item.ppm.lama);
           sumLamaJamPengembangan += parseInt(item.info_dupak.lama_jam);
           n = ++n;
         });
      }
      }else{
        table += '<tr style="height:300px;">'
              +'<td ></td>'
              +'<td></td>'
              +'<td></td>'
              +'<td style="text-align: center;"></td>'
              +'<td style="text-align: center"></td>'
              +'<td style="text-align: center"></td>' 
              +'<td style="text-align: center"></td>'
              +'<td></td>'
              +'</tr>';
      }
       table += '<tr style="text-align:center; font-weight: bold;">'
              +'<td ></td>'
              +'<td></td>'
              +'<td>JUMLAH</td>'
              +'<td>'+sumLamaPengembangan+'</td>'
              +'<td></td>'
              +'<td>'+sumLamaJamPengembangan+'</td>' 
              +'<td>'+sumPengembangan.toFixed(3)+'</td>'
              +'<td></td>'
              +'</tr>';
       table += '</table>';
       $( "#dupak-pengembangan-wrapper" ).html(header+table+footer);
    }
  });
  }
//end generate tabel pengembangan
</script>