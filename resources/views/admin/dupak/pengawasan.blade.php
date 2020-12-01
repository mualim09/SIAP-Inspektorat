<!-- start table dupak pengawasan 
<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered ajax-table" id="list-dupak-table">
        <thead>
        <tr>
            <th rowspan="3" width="1" valign="middle" class="text-center">{{ __('No') }}</th> 
            <th rowspan="3" valign="middle" class="text-center">{{ __('Nama') }}</th>
            <th rowspan="3" valign="middle" class="text-center">{{ __('NIP') }}</th>
            <th colspan="6" class="text-center">{{ __('Dupak') }}</th>
            <th rowspan="3" valign="middle" class="text-center">{{ __('Action') }}</th> 
        </tr>
        <tr>
            <th colspan="2" class="text-center">{{ __('Pendidikan') }}</th>
            <th colspan="2" class="text-center">{{ __('Utama') }} </th>
            <th colspan="2" class="text-center">{{ __('Penunjang') }} </th>
        </tr>
        <tr>
            <th>{{ __('Lama') }}</th>
            <th>{{ __('Baru') }} </th>
            <th>{{ __('Lama') }} </th>
            <th>{{ __('Baru') }} </th>
            <th>{{ __('Lama') }} </th>
            <th>{{ __('Baru') }} </th>
        </tr>                            
        </thead>
        <tbody></tbody>                          
    </table>
</div>
end table dupak pengawasan -->
<script type="text/javascript">
      //start generate tabel pengawasan
    function generate_tabel_pengawasan(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {      
      if(response.length>0){
        var header = generate_header(response, 'pengawasan');
            var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pengawasan-table">';

              table += '<tr style="background: #ccc; text-align: center">'
                  +'<th rowspan="2">No.</th>' //1
                  +'<th colspan="2">Uraian Kegiatan</th>' //2
                  +'<th rowspan="2" colspan="2">Tgl Jml Hari Efektif</th>' //3
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
                  +'<th colspan="2">4</th>'
                  +'<th>5</th>'
                  +'<th>6</th>'
                  +'<th>7</th>'
                  +'<th>8</th>'
              +'</tr>';

        $.each(response, function (i, item) {
          //console.log(item);
          //file_url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'storage/spt/'
          var year = new Date().getFullYear();
          var n = i+1;
          if (typeof item.spt !== 'undefined' && item.spt.file !== null) {
            file = document.location.origin+'/storage/spt/'+item.spt.file;
            target = "_blank";
            link = '<td rowspan="2"><a href="'+file+'" target="'+target+'" >SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</a><br/><br/></td>';
          }else{
            file = "#";
            target= "_self";
            link = '<td rowspan="2">SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'<br/><br/></td>';
          }

          lokasi_spt =  ( typeof item.spt !== 'undefined' && item.spt.lokasi_spt != null ) ? ' di '+item.spt.lokasi_spt : '';
          
          table += '<tr>'
          +'<td rowspan="2">' + n + '</td>'
          +'<td rowspan="2"></td>'
          +'<td rowspan="2">'+ item.spt.kegiatan.name +lokasi_spt+'</td>'
          //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
          +'<td colspan="2" style="text-align: center;">' + item.spt.periode + '</td>'
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.koefisien +'</td>'
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.lama_jam +'</td>' 
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.dupak +'</td>'
          //+'<td rowspan="2"><a href="'+file+'" target="'+target+'" >SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</a><br/><br/></td>'
          +link
          +'</tr>';
          table += '<tr>'
                +'<td style="width:50%">' + item.spt.lama + ' hari</td>'
                +'<td style="width:50%">'+ item.peran +'</td>'
                +'</tr>';
        });
        
        table += '</table>';
        var footer = generate_footer(response);
        
        $( "#dupak-pengawasan-wrapper" ).html(header+table+footer);
      }else{
        $( "#dupak-pengawasan-wrapper" ).html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
        $('#dupak-pengawasan-wrapper').addClass('no-print');
      }
    }
  });
  }
//end generate tabel pengawasan
</script>