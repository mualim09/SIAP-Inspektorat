<script type="text/javascript">
function generate_tabel_dupak(dupak_pendidikan, sumDiklat, sumLamaDiklat, sumPengawasan, sumLamaPengawasan, sumPengembangan, sumLamaPengembangan, sumPenunjang, sumLamaPenunjang){    
    var user_id = ( $( "#user-id" ).length>0 ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var can_input = ( user_id == "{{ Auth::user()->id }}" || "{{ Auth::user()->hasRole('Super Admin') }}") ? true : false;
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    var unit_kerja = "Inspektorat Kabupaten Sidoarjo";
    $.ajax({
      url: "{{ route('dupak_lama')}}",
      type: "GET",
      //dataType: "JSON",
      data: {user_id: user_id, semester: semester, tahun: tahun},
      success: function(response){
        //console.log(response.user);
          nama_user = ('undefined' !== response.user.full_name_gelar) ? response.user.full_name_gelar : '';
          nip_user = ('undefined' !== response.user.nip) ? response.user.nip : '';
          jabatan_user = ('undefined' !== response.user.jabatan) ? response.user.jabatan : '';
          gender = ('undefined' !== response.user.sex) ? response.user.sex : '';
          tempat_lahir_user = (null != response.user.tempat_lahir) ? response.user.tempat_lahir+', ' : '';
          tgl_lahir_user = ('undefined' !== response.user.tanggal_lahir) ? response.user.tanggal_lahir : '';         
          pendidikan = ('undefined' !== response.user.pendidikan.tingkat ) ? response.user.pendidikan.tingkat : '';
          pangkat_user = ('undefined' !== response.user.pangkat) ? response.user.pangkat : '';
          //setup variabel pejabat penetap ak [0].user.full_name_gelar
          nama_pejabat_pak = ('undefined' !== response.pejabat[0].user.full_name_gelar) ? response.pejabat[0].user.full_name_gelar : ''
          nip_pejabat_pak = ('undefined' !== response.pejabat[0].user.nip) ? response.pejabat[0].user.nip : '';
          pangkat_pejabat_pak = ('undefined' !== response.pejabat[0].user.pangkat) ? response.pejabat[0].user.pangkat : '';
          jabatan_pejabat_pak = ('undefined' !== response.pejabat[0].user.jabatan) ? response.pejabat[0].user.jabatan : '';

          //setup var ak lama
          //console.log(response.user.dupak);
          data_diklat_lama = 0;
          data_pengembangan_lama = 0;
          data_pengawasan_lama = 0;
          ak_lama = [];
          if(response.user.dupak.length>0){
            $.each(response.user.dupak, function(i, item){
              ak_lama[item.unsur_dupak] = item.dupak;
              /*if(item.unsur_dupak == "diklat"){
                data_diklat_lama = item.dupak;
              }
              if(item.unsur_dupak == "pengembangan"){
                data_pengembangan_lama = item.dupak;
              }
              if(item.unsur_dupak == "pengawasan"){
                data_pengawasan_lama = item.dupak;
              }*/
            });
            /*for (var i = response.user.dupak.length - 1; i >= 0; i--) {
              data_diklat_lama = ( response.user.dupak[i].unsur_dupak == "diklat" ) ? response.user.dupak[i].dupak : 0;
              data_pengembangan_lama = ( response.user.dupak[i].unsur_dupak == "pengembangan" ) ? response.user.dupak[i].dupak : 0;
              data_pengawasan_lama = ( response.user.dupak[i].unsur_dupak == "pengawasan" ) ? response.user.dupak[i].dupak : 0;
            }*/
          }
          
          var header = '<div class="col-print-12 col-md-12 print-center text-center"><h3>DAFTAR USULAN PENETAPAN ANGKA KREDIT</h3></div>'
                +'<div class="row">'
                  +'<div class="col-print-2 col-md-2"></div>'
                  +'<div class="col-print-4 col-md-4">NOMOR</div>'
                  +'<div class="col-print-4 col-md-4">: </div>'
                  +'<div class="col-print-2 col-md-2"></div>'
                +'</div>'
                +'<div class="row">'
                  +'<div class="col-print-2 col-md-2"></div>'
                  +'<div class="col-print-4 col-md-4">MASA PENILAIAN TANGGAL</div>'
                  +'<div class="col-print-4 col-md-4">: '+periode+' '+tahun+'</div>'
                  +'<div class="col-print-2 col-md-2"></div>'
                +'</div>';
          var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="user-dupak-table">'
                +'<tr style="text-align: center; font-weight:bold;">'
                  +'<td>I.</td>'
                  +'<td colspan="2">KETERANGAN PERORANGAN</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>1.</td>'
                  +'<td>Nama</td>'
                  +'<td><strong>'+nama_user+'</strong></td>'
                +'</tr>'
                +'<tr>'
                  +'<td>2.</td>'
                  +'<td>NIP / Nomor Seri Karpeg</td>'
                  +'<td><strong>'+nip_user+'</strong></td>'
                +'</tr>'
                +'<tr>'
                  +'<td>3.</td>'
                  +'<td>Tempat dan tanggal lahir</td>'
                  +'<td>'+tempat_lahir_user+tgl_lahir_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>4.</td>'
                  +'<td>Jenis Kelamin</td>'
                  +'<td>'+gender+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>5.</td>'
                  +'<td>Pendidikan tertinggi</td>'
                  +'<td>'+dupak_pendidikan+' ('+pendidikan+') '+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>6.</td>'
                  +'<td>Pangkat/Gol. Ruang/TMT</td>'
                  +'<td>'+pangkat_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>7.</td>'
                  +'<td>Jabatan Auditor</td>'
                  +'<td>'+jabatan_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>8.</td>'
                  +'<td>Unit Kerja</td>'
                  +'<td>'+unit_kerja+'</td>'
                +'</tr>'
                +'</table>';

          table += '<div class="col-md-12 col-print-12" style="padding-bottom:15px;display:block"></div>';
          //input_diklat = (true == response.penilai ) ? '<span>Inputan lama dari tiap auditor</span>' : '';
          inputan = '<input type="text" class="col-md-12 no-print" name="input_diklat" id="input-diklat"><span class="hide-from-view print-show">data_ak_lama</span>';
          input_diklat_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_diklat" id="input-diklat" value="'+ak_lama['diklat']+'"><span class="hide-from-view print-show">'+ak_lama['diklat']+'</span>' : '<span class="print-show">'+ak_lama['diklat']+'</span>' ;
          input_pengembangan_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_pengembangan" id="input-pengembangan" value="'+ak_lama['pengembangan']+'"><span class="hide-from-view print-show">'+ak_lama['pengembangan']+'</span>' : '<span class="print-show">'+ak_lama['pengembangan']+'</span>' ;
          input_pengawasan_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_penunjang" id="input-pengawasan" value="'+ak_lama['pengawasan']+'"><span class="hide-from-view print-show">'+ak_lama['pengawasan']+'</span>' : '<span class="print-show">'+ak_lama['pengawasan']+'</span>' ;
          /*PENDIDIKAN  
PENGAWASAN  
PENGEMBANGAN PROFESI  */


          table += '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="ak-dupak-table">'
                      +'<tr style="text-align: center; font-weight:bold;">'
                        +'<th style="width:196px;">II.</th>'
                        +'<th colspan="7">UNSUR YANG DINILAI</th>'
                      +'</tr>'
                      +'<tr style="text-align: center; font-weight:bold;">'
                        +'<th rowspan="3">No.</th>'
                        +'<th rowspan="3">UNSUR & SUB UNSUR</th>'
                        +'<th colspan="6">ANGKA KREDIT MENURUT</th>'
                      +'</tr>'
                      +'<tr style="text-align: center; font-weight:bold;">'
                        +'<th colspan="3">INSTANSI PENGUSUL</th>'
                        +'<th colspan="3">TIM PENILAI</th>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;text-align:center;">'
                        +'<th style="width:150px;">LAMA</th>'
                        +'<th style="width:150px;">BARU</th>'
                        +'<th style="width:150px;">JUMLAH</th>'
                        +'<th style="width:150px;">LAMA</th>'
                        +'<th style="width:150px;">BARU</th>'
                        +'<th style="width:150px;">JUMLAH</th>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: center">I</td>'
                        +'<td>PENDIDIKAN SEKOLAH</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                        +'<td>0</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                        +'<td>0</td>'
                        +'<td>0</td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: center">II</td>'
                        +'<td>ANGKA KREDIT</td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: right">A</td>'
                        +'<td>UNSUR UTAMA</td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">a. Pendidikan</td>'
                        +'<td>'+input_diklat_lama+'</td>' //input form
                        +'<td>'+sumDiklat+'</td>'
                        +'<td></td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">b. Pengawasan</td>'
                        +'<td>'+input_pengawasan_lama+'</td>' //input form
                        +'<td>'+sumPengawasan+'</td>'
                        +'<td></td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">c. Pengembangan Profesi</td>'
                        +'<td>'+input_pengembangan_lama+'</td>' //input form
                        +'<td>'+sumPengembangan+'</td>'
                        +'<td></td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'

          $("#dupak-dupak-wrapper").html(header+table);
        
      },
      error: function(error){}
    });
  }
  </script>