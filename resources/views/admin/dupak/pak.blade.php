<script type="text/javascript">
function generate_tabel_pak(dupak_pendidikan, sumDiklat, sumLamaDiklat, sumPengawasan, sumLamaPengawasan, sumPengembangan, sumLamaPengembangan, sumPenunjang, sumLamaPenunjang){    
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    var unit_kerja = "Inspektorat Kabupaten Sidoarjo";
    $.ajax({
      url: "{{ route('user_pak')}}",
      type: "GET",
      dataType: "JSON",
      data: {user_id: user_id, semester: semester, tahun: tahun},
      success: function(response){
        console.log(response.user);
        
          nama_user = ('undefined' !== response.user.full_name_gelar) ? response.user.full_name_gelar : '';
          nip_user = ('undefined' !== response.user.nip) ? response.user.nip : '';
          jabatan_user = ('undefined' !== response.user.jabatan) ? response.user.jabatan : '';
          gender = ('undefined' !== response.user.sex) ? response.user.sex : '';
          tempat_lahir_user = (null != response.user.tempat_lahir) ? response.user.tempat_lahir+', ' : '';
          tgl_lahir_user = ('undefined' !== response.user.tanggal_lahir) ? response.user.tanggal_lahir : '';         
          pendidikan = ('undefined' !== response.user.pendidikan.tingkat ) ? response.user.pendidikan.tingkat : '';
          pangkat_user = ('undefined' !== response.user.formatted_pangkat) ? response.user.formatted_pangkat : '';
          //setup variabel pejabat penetap ak [0].user.full_name_gelar
          nama_pejabat_pak = ('undefined' !== response.pejabat[0].user.full_name_gelar) ? response.pejabat[0].user.full_name_gelar : ''
          nip_pejabat_pak = ('undefined' !== response.pejabat[0].user.nip) ? response.pejabat[0].user.nip : '';
          pangkat_pejabat_pak = ('undefined' !== response.pejabat[0].user.pangkat) ? response.pejabat[0].user.pangkat : '';
          jabatan_pejabat_pak = ('undefined' !== response.pejabat[0].user.jabatan) ? response.pejabat[0].user.jabatan : '';
          var header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center">PENETAPAN ANGKA KREDIT JABATAN FUNGSIONAL AUDITOR</h3></div>'
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
          var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="user-pak-table">'
                +'<tr style="text-align: center">'
                  +'<td colspan="3">KETERANGAN PERORANGAN</td>'
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

          table += '<div class="h-10" style="margin-bottom:15px;"></div>'

          table += '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="ak-pak-table">'
                      +'<tr style="text-align: center">'
                        +'<td colspan="6">PENETAPAN ANGKA KREDIT</td>'
                      +'</tr>'
                      +'<tr style="text-align: center">'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td>LAMA</td>'
                        +'<td>BARU</td>'
                        +'<td>JUMLAH</td>'
                        +'<td>ANGKA KREDIT UNTUK KENAIKAN PANGKAT</td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;text-align:center;">'
                        +'<td>1</td>'
                        +'<td>2</td>'
                        +'<td>3</td>'
                        +'<td>4</td>'
                        +'<td>5</td>'
                        +'<td>6</td>'
                      +'</tr>'
                      +'<tr style="font-weight: bold;text-align: center">'
                        +'<td>I</td>'
                        +'<td>PENDIDIKAN SEKOLAH</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                        +'<td>0</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                        +'<td>'+dupak_pendidikan+'</td>'
                      +'</tr>';
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: center">II</td>'
                        +'<td>ANGKA KREDIT</td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>';
                      +'<tr style="font-weight: bold;">'
                        +'<td style="text-align: right">A</td>'
                        +'<td>UNSUR UTAMA</td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>';
                      +'<tr style="font-weight: bold;">'
                        +'<td></td>'
                        +'<td style="padding-left:20px;">a. Pendidikan</td>'
                        +'<td></td>'
                        +'<td>'+sumDiklat+'</td>'
                        +'<td></td>'
                        +'<td></td>'
                      +'</tr>';

          $("#dupak-pak-wrapper").html(header+table);
        
      },
      error: function(error){}
    });
  }
  </script>