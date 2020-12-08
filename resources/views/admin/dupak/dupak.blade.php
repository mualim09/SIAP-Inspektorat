<script type="text/javascript">
function generate_tabel_dupak(dupak_pendidikan, sumDiklat, sumLamaDiklat, sumPengawasan, sumLamaPengawasan, sumPengembangan, sumLamaPengembangan, sumPenunjang, sumLamaPenunjang){    
    var user_id = ( $( "#user-id" ).length>0 ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    var unit_kerja = "Inspektorat Kabupaten Sidoarjo";
    var can_input = ( user_id == "{{ Auth::user()->id }}" || "{{ Auth::user()->hasRole('Super Admin') }}") ? true : false;
    $.ajax({
      url: "{{ route('dupak_lama')}}",
      type: "GET",
      //dataType: "JSON",
      data: {user_id: user_id, semester: semester, tahun: tahun},
      success: function(response){        
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
          pangkat_pejabat_pak = ('undefined' !== response.pejabat[0].user.formatted_pangkat) ? response.pejabat[0].user.formatted_pangkat : '';
          jabatan_pejabat_pak = ('undefined' !== response.pejabat[0].user.jabatan) ? response.pejabat[0].user.jabatan : '';

          //setup var ak lama
          data_diklat_lama = 0;
          data_pengembangan_lama = 0;
          data_pengawasan_lama = 0;
          data_penunjang_lama = 0;
          ak_lama = [];
          sum_ak_lama = 0;
          if(response.user.dupak.length>0){
            $.each(response.user.dupak, function(i, item){
              ak_lama[item.unsur_dupak] = parseFloat(item.dupak);
              //sum_ak_lama += parseFloat(item.dupak);
            });
            data_diklat_lama = ('undefined' !== typeof ak_lama['diklat']) ? ak_lama['diklat'] : 0;
            data_pengembangan_lama = ('undefined' !== typeof ak_lama['pengembangan']) ? ak_lama['pengembangan'] : 0;
            data_pengawasan_lama = ('undefined' !== typeof ak_lama['pengawasan']) ? ak_lama['pengawasan'] : 0;
            data_penunjang_lama = ('undefined' !== typeof ak_lama['penunjang']) ? ak_lama['penunjang'] : 0;
          }
          sum_ak_lama = data_diklat_lama+data_pengembangan_lama+data_pengawasan_lama;

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
                  +'<td colspan="3">KETERANGAN PERORANGAN</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>1.</td>'
                  +'<td colspan="2">Nama</td>'
                  +'<td><strong>'+nama_user+'</strong></td>'
                +'</tr>'
                +'<tr>'
                  +'<td>2.</td>'
                  +'<td colspan="2">NIP / Nomor Seri Karpeg</td>'
                  +'<td><strong>'+nip_user+'</strong></td>'
                +'</tr>'
                +'<tr>'
                  +'<td>3.</td>'
                  +'<td colspan="2">Tempat dan tanggal lahir</td>'
                  +'<td>'+tempat_lahir_user+tgl_lahir_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>4.</td>'
                  +'<td colspan="2">Jenis Kelamin</td>'
                  +'<td>'+gender+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>5.</td>'
                  +'<td colspan="2">Pendidikan yang telah<br/>diperhitungkan angka kreditnya</td>'
                  +'<td>'+dupak_pendidikan+' ('+pendidikan+') '+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>6.</td>'
                  +'<td colspan="2">Pangkat/Gol. Ruang/TMT</td>'
                  +'<td>'+pangkat_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td>7.</td>'
                  +'<td colspan="2">Jabatan Auditor</td>'
                  +'<td>'+jabatan_user+'</td>'
                +'</tr>'
                +'<tr>'
                  +'<td rowspan="2">8.</td>'
                  +'<td rowspan="2">Masa Kerja Golongan</td>'                  
                +'</tr>'
                +'<tr><td>Lama</td><td></td></tr>'
                +'<tr><td></td><td></td><td>Baru</td><td></td></tr>'
                +'<tr>'
                  +'<td>9.</td>'
                  +'<td colspan="2">Unit Kerja</td>'
                  +'<td>'+unit_kerja+'</td>'
                +'</tr>'
                +'</table>';

          table += '<div class="col-md-12 col-print-12" style="padding-bottom:15px;display:block"></div>';
          
          //setup var untuk yang bisa input form
          form_open = ( can_input == true ) ? '<form id="input-dupak" class="needs-validation" novalidate>' : '';
          //inputan = (can_input == true) ? '<input type="hidden" name="return_to" value=""'
          input_diklat_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_diklat" id="input-diklat" value="'+data_diklat_lama.toFixed(3)+'"><span class="hide-from-view print-show">'+data_diklat_lama.toFixed(3)+'</span>' : '<span class="print-show">'+data_diklat_lama.toFixed(3)+'</span>' ;
          input_pengembangan_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_pengembangan" id="input-pengembangan" value="'+data_pengembangan_lama.toFixed(3)+'"><span class="hide-from-view print-show">'+data_pengembangan_lama.toFixed(3)+'</span>' : '<span class="print-show">'+data_pengembangan_lama.toFixed(3)+'</span>' ;
          input_pengawasan_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_pengawasan" id="input-pengawasan" value="'+data_pengawasan_lama.toFixed(3)+'"><span class="hide-from-view print-show">'+data_pengawasan_lama.toFixed(3)+'</span>' : '<span class="print-show">'+data_pengawasan_lama.toFixed(3)+'</span>' ;
          input_penunjang_lama = ( can_input === true ) ? '<input type="text" class="col-md-12 no-print" name="input_penunjang" id="input-penunjang" value="'+data_penunjang_lama.toFixed(3)+'"><span class="hide-from-view print-show">'+data_penunjang_lama.toFixed(3)+'</span>' : '<span class="print-show">'+data_penunjang_lama.toFixed(3)+'</span>' ;
          input_submit = (can_input == true) ? '<div class="col-md-12 no-print pt-10"><button class="btn btn-primary float-right" id="submit-input-dupak" onclick="submitDupakLama();">Simpan</button></div>' : '';
          form_close = (can_input == true) ? '</form>' : '';
          sumUpdateDiklat = data_diklat_lama+sumDiklat;
          sumUpdatePengawasan = data_pengawasan_lama+sumPengawasan;
          sumUpdatePengembangan = data_pengembangan_lama+sumPengembangan;
          sumUpdatePenunjang = data_penunjang_lama+sumPenunjang;
          sum_ak_baru = sumDiklat+sumPengawasan+sumPengembangan;
          sum_sum = sum_ak_baru+sum_ak_lama;
          sum_penjenjangan_lama = sum_ak_lama+data_penunjang_lama;
          sum_penjenjangan_baru = sum_ak_baru+sumPenunjang;
          sum_penjenjangan = sum_penjenjangan_lama+sum_penjenjangan_baru;
          sum_total_lama = sum_penjenjangan_lama+parseFloat(dupak_pendidikan);
          sum_total_baru = sum_penjenjangan_baru+0;
          sum_total_jumlah = sum_total_lama+sum_total_baru;


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
                        +'<td style="text-align: right">A.</td>'
                        +'<td>UNSUR UTAMA</td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr>'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">a. Pendidikan</td>'
                        +form_open
                        +'<td>'+input_diklat_lama+'</td>' //input form
                        +'<td>'+sumDiklat.toFixed(3)+'</td>'
                        +'<td>'+sumUpdateDiklat.toFixed(3)+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr>'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">b. Pengawasan</td>'
                        +'<td>'+input_pengawasan_lama+'</td>' //input form
                        +'<td>'+sumPengawasan.toFixed(3)+'</td>'
                        +'<td>'+sumUpdatePengawasan.toFixed(3)+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr>'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">c. Pengembangan Profesi</td>'
                        +'<td>'+input_pengembangan_lama+'</td>' //input form
                        +'<td>'+sumPengembangan.toFixed(3)+'</td>'
                        +'<td>'+sumUpdatePengembangan.toFixed(3)+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="text-align:right">JUMLAH</td>'
                        +'<td>'+sum_ak_lama.toFixed(3)+'</td>' //input form
                        +'<td>'+sum_ak_baru.toFixed(3)+'</td>'
                        +'<td>'+sum_sum.toFixed(3)+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: right">B.</td>'
                        +'<td>UNSUR PENUNJANG</td>'
                        +'<td>'+input_penunjang_lama+'</td>' //input form
                        +'<td>'+sumPenunjang+'</td>'
                        +'<td>'+sumUpdatePenunjang.toFixed(3)+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="text-align:right">JUMLAH AK. PENJENJANGAN</td>'
                        +'<td>'+sum_penjenjangan_lama+'</td>' 
                        +'<td>'+sum_penjenjangan_baru+'</td>'
                        +'<td>'+sum_penjenjangan+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="text-align:right">JUMLAH (I + II)</td>'
                        +'<td>'+sum_total_lama+'</td>' //input form
                        +'<td>'+sum_total_baru+'</td>'
                        +'<td>'+sum_total_jumlah+'</td>' //jumlah lama+baru
                        +'<td></td>' 
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>'
                      +'</table>';
          table += input_submit+form_close;
          sign_column = '<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">Sidoarjo,_______________'+tahun+'</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">Pejabat Pengusul</div>'
            +'</div>'
            +'<div class="h-100"></div>' //separator ttd atasan
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4"><strong>'+nama_pejabat_pak+'</strong></div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+pangkat_pejabat_pak+'</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+nip_pejabat_pak+'</div>'
            +'</div>';

          table += '<div class="hide-from-view col-print-12">'
                +'<table class="col-print-12" style="border:1px solid #000">'
                +'<tr>'
                  +'<td style="font-weight:bold">III.</td>'
                  +'<td>LAMPIRAN PENDUKUNG PAK</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>1 SMPK PENDIDIKAN</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>2 SMPK PENDIDIKAN DAN PELATIHAN</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>3 SMPK PENGAWASAN</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>4 SPMK PENGEMBANGAN PROFESI</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>5 SMPK PENUNJANG</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>6 FOTO COPY SURAT TUGAS / SURAT PERINTAH</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>7 NORMA HASIL</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td>8 FOTO COPY SK PAK</td>'
                +'</tr>'
                +'<tr>'
                  +'<td></td>'
                  +'<td></td>'
                +'</tr>'
                +'</table>'
                +'<table class="col-print-12" style="border:1px solid #000">'
                +'<tr>'
                  +'<td style="font-weight:bold">IV.</td>'
                  +'<td>CATATAN PEJABAT PENGUSUL</td>'
                +'</tr>'
                +'<tr>'
                  +'<td colspan="2">'
                  +sign_column
                  +'</td>'
                +'</tr>'
                +'</table>'
                +'</div>';

          $("#dupak-dupak-wrapper").html(header+table);

          generate_tabel_pak(dupak_pendidikan, data_diklat_lama, sumDiklat, sumUpdateDiklat, data_pengembangan_lama, sumPengembangan, sumUpdatePengembangan, data_pengawasan_lama, sumPengawasan, sumUpdatePengawasan, data_penunjang_lama, sumPenunjang, sumUpdatePenunjang, sum_ak_lama, sum_ak_baru, sum_sum, sum_penjenjangan_lama, sum_penjenjangan_baru, sum_penjenjangan, sum_total_lama, sum_total_baru, sum_total_jumlah);        
      },
      error: function(error){}
    });
  }
  function submitDupakLama(){
    var val_diklat = $('#input-diklat').val();
    var val_pengembangan = $('#input-pengembangan').val();
    var val_penunjang = $('#input-penunjang').val();
    var val_pengawasan = $('#input-pengawasan').val();
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var user_id = ( $( "#user-id" ).length>0 ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    $.ajax({
      url: "{{ route('submit_dupak_lama')}}",
      type: "POST",
      //dataType: "JSON",
      data: {user_id: user_id, semester:semester, tahun:tahun, diklat: val_diklat, pengembangan: val_pengembangan, penunjang:val_penunjang, pengawasan:val_pengawasan, '_token':csrf_token},
      success: function(response){        
        $( "#form-cari-dupak" ).submit();
      },
      error: function(error){
        console.log(error);
      },
    });
  }
  </script>