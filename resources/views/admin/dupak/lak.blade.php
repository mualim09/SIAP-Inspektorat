<script type="text/javascript">
//tabel LAK
  function generate_tabel_lak(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
      url : ' {{ route("data_dupak_lak") }}',
      type : 'GET',
      data: {user_id: user_id, semester: semester, tahun: tahun},
      success: function(response){
        var year = new Date().getFullYear();
        pendidikan = ('undefined' !== typeof response.user.pendidikan.tingkat) ? response.user.pendidikan.tingkat : '';
        header = '<div class="d-none">'
          +'<div class="col-print-12 col-md-12"><h3 class="print-center text-center" style="margin-bottom:0px;">LAPORAN ANGKA KREDIT</h3>'
          +'<h5 class="print-center text-center"  style="margin-top:0px;">Masa Penilaian '+periode+' '+tahun+'</h5></div>'
          +'<div class="h-20"></div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Nama</div>'
            +'<div class="col-print-8 col-md-8">: <strong>'+ response.user.full_name_gelar +'</strong></div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">NIP</div>'
            +'<div class="col-print-8 col-md-8">: '+response.user.nip+'</div>'
          +'</div>'            
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Jabatan</div>'
            +'<div class="col-print-8 col-md-8">: '+response.user.jabatan+'</div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Pendidikan terakhir</div>'
            +'<div class="col-print-8 col-md-8">: '+pendidikan+'</div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Unit kerja</div>'
            +'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
          +'</div>'
          +'<div class="h-20"></div>'
          +'</div>';
         
        table = '<div class="table-responsive-sm">'
              +'<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border col-md-12" id="dupak-lak-table">'       
              +'<tr style="background: #ccc; text-align: center">'
                +'<th rowspan="2" class="col-md-1">No.</th>'
                +'<th rowspan="2" class="col-md-3">Uraian Sub Unsur</th>'
                +'<th colspan="2" class="col-md-2">Jumlah Angka Kredit</th>'
                +'<th colspan="2" class="col-md-2">Jumlah Hari</th>'
                +'<th rowspan="2" class="col-md-2">Perbedaan</th>'
                +'<th rowspan="2" class="col-md-2">Ket Perbedaan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>Diusulkan</th>'
                  +'<th>Disetujui</th>'
                  +'<th>Diusulkan</th>'
                  +'<th>Disetujui</th>'
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

          //AK pendidikan
          dupak_pendidikan = 0;
          table += '<tr>'
                  +'<td style="text-align: center;"><strong>I</strong></td>'
                  +'<td><strong>Pendidikan Sekolah</strong></td>';
          if(response.pendidikan.length>0 && 'undefined' !== response.pendidikan[0].dupak){            
            table += '<td style="text-align: center">'+response.pendidikan[0].dupak+'</td>'; 
            dupak_pendidikan = parseFloat(response.pendidikan[0].dupak).toFixed(0);
          }else{
            table += '<td></td>';
          }
          table +='<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //table breaker
          table += '<tr>'
                  +'<td style="text-align: center;"><strong>II</strong></td>'
                  +'<td><strong>Angka Kredit Penjenjangan</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          table += '<tr>'
                  +'<td style="text-align: right;"><strong>A</strong></td>'
                  +'<td><strong>Unsur Utama</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>1. Pendidikan dan Pelatihan</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK diklat 
          var sumDiklat=0 , sumLamaDiklat = 0;
          if(response.diklat.length > 0){
            $.each(response.diklat, function(i,item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumDiklat += parseFloat(item.info_dupak.dupak);
              sumLamaDiklat += parseFloat(item.info_dupak.lama);
            });          
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pendidikan dan Pelatihan</strong></td>'
                  +'<td>'+sumDiklat.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaDiklat+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker AK diklat
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>2. Pengawasan</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK Pengawasan 
          var sumPengawasan = 0, sumLamaPengawasan = 0;
          if(response.pengawasan.length > 0){                        
            $.each(response.pengawasan, function(i,item){
              n = i+1;
              lokasi_spt =  ( typeof item.spt !== 'undefined' && item.spt.lokasi_spt != null ) ? ' di '+item.spt.lokasi_spt : '';
              table += '<tr>'
                +'<td></td>' //pengawasan[0].spt.kegiatan.sebutan
                +'<td style="padding-left:50px;">'+n+'. '+item.spt.kegiatan.name+lokasi_spt+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.spt.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPengawasan += parseFloat(item.info_dupak.dupak);
              sumLamaPengawasan += parseFloat(item.spt.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pengawasan</strong></td>'
                  +'<td>'+sumPengawasan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPengawasan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker AK pengawasan
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>3. Pengembangan profesi</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK pengembangan profesi 
          var sumPengembangan = 0, sumLamaPengembangan = 0;
          if(response.pengembangan.length > 0){            
            $.each(response.pengembangan, function(i, item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPengembangan += parseFloat(item.info_dupak.dupak);
              sumLamaPengembangan += parseFloat(item.info_dupak.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pengembangan Profesi</strong></td>'
                  +'<td>'+sumPengembangan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPengembangan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
            sumUtama = sumDiklat+sumPengawasan+sumPengembangan;
            sumLamaUtama = sumLamaDiklat+sumLamaPengawasan+sumLamaPengembangan;

            table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Unsur Utama</strong></td>'
                  +'<td>'+sumUtama.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaUtama+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker unsur utama
          table += '<tr>'
                  +'<td style="text-align: right;"><strong>B</strong></td>'
                  +'<td><strong>Unsur Penunjang</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK Penunjang 
          var sumPenunjang = 0, sumLamaPenunjang = 0;
          if(response.penunjang.length > 0){            
            $.each(response.penunjang, function(i, item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPenunjang += parseFloat(item.info_dupak.dupak);
              sumLamaPenunjang += parseFloat(item.info_dupak.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Unsur Penunjang</strong></td>'
                  +'<td>'+sumPenunjang.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPenunjang+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          sumPenjenjangan = sumUtama+sumPenunjang;
          sumLamaPenjenjangan = sumLamaUtama+sumLamaPenunjang;
          //jumlah AK Penjenjangan
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>jumlah AK Penjenjangan</strong></td>'
                  +'<td>'+sumPenjenjangan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPenjenjangan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

        //penutup tabel
        table +='</table></div>';

        var penilai = new Object(), inspektur = new Object();
        if(response.pejabat){
          $.each(response.pejabat, function(i, item){
            //console.log(item);
            if(item.name == 'Inspektur Kabupaten'){
              inspektur.name = item.user.full_name_gelar;
              inspektur.pangkat = item.user.formatted_pangkat;
              inspektur.nip = 'NIP. '+item.user.nip;
              inspektur.status = ('undefined' !== typeof inspektur.status) ? inspektur.status+' ' : '';
            }
            if(item.name == 'Ketua Penilai AK'){
              penilai.name = item.user.full_name_gelar;
              penilai.pangkat = item.user.formatted_pangkat;
              penilai.nip = 'NIP. '+item.user.nip;
            }
          });
        }        
        var footer = '<div class="d-none">'
            +'<div style="height:20px;display:block;"></div>'
            +'<div class="row">'
              +'<div class="col-md-4 col-print-4 text-center print-center">Sidoarjo,<span style="min-width:130px;display:inline-block;">&nbsp;</span>'+year+'</div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">Diperiksa</div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">Direview</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-4 col-print-4 text-center print-center"></div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">Ketua Tim Penilai</div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">'+inspektur.status+'Inspektur Kabupaten</div>'
            +'</div>'
            +'<div class="h-100"></div>' //separator ttd atasan
            +'<div class="row">'
              +'<div class="col-md-4 col-print-4 text-center print-center"><strong><u>'+ response.user.full_name_gelar +'</u></strong></div>'
              +'<div class="col-md-4 col-print-4 text-center print-center"><strong><u>'+penilai.name+'</u></strong></div>'
              +'<div class="col-md-4 col-print-4 text-center print-center"><strong><u>'+inspektur.name+'</u></strong></div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-4 col-print-4 text-center print-center">'+response.user.formatted_pangkat+'<br/>NIP. '+ response.user.nip +'</div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">'+penilai.pangkat+'<br/>'+penilai.nip+'</div>'
              +'<div class="col-md-4 col-print-4 text-center print-center">'+inspektur.pangkat+'<br/>'+inspektur.nip+'</div>'
            +'</div>'
            +'</div>';            
            
        $("#dupak-lak-wrapper").html(header+table+footer);
        generate_tabel_dupak(dupak_pendidikan, sumDiklat, sumLamaDiklat, sumPengawasan, sumLamaPengawasan, sumPengembangan, sumLamaPengembangan, sumPenunjang, sumLamaPenunjang);
        generate_tabel_pak(dupak_pendidikan, sumDiklat, sumLamaDiklat, sumPengawasan, sumLamaPengawasan, sumPengembangan, sumLamaPengembangan, sumPenunjang, sumLamaPenunjang);
        
      },
      error: function(error){
        console.log(error);
      }
    });
  }
  //end tabel LAK
  </script>