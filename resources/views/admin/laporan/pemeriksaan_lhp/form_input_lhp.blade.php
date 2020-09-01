{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<?php
    $i=0; 
    $dasar_spt = array_filter(explode("\n",strip_tags($data_jenis_spt->dasar))); //explode by new line (ENTER)
    $dasar = '';
    
    if(count($dasar_spt)>1){
        foreach($dasar_spt as $dasar2){
            $i = $i+1;
                $dasar .= '<tr>';
                $dasar .= "<td align=\"left\" valign=\"top\" style=\"width:4%\">" . $i. ".</td>";
                $dasar .= "<td style=\"width:100%\">" . $dasar2. "</td>";
                $dasar .= "</tr>";
        }
    }else{
        $dasar .= '<tr>';
        $dasar .= "<td align=\"left\" valign=\"top\" colspan=\"2\">" . $data_jenis_spt->dasar. ".</td>";
        $dasar .= "</tr>";
    }
?>

<div class="container-fluid bg-color" style="margin-top: 45px !important;">
    <div class="row">
        <div class="col col-xl-10 center">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center" style="margin-bottom: 40px;">
                        <h1>{{ __('Input LHP Reguler') }}</h1>
                    </div>

                    <div id="smartwizard" class="sw sw-justified sw-theme-arrows">

                    <ul class="nav">
                        <li class="nav-item">
                          <a class="nav-link inactive active" href="#step-1">
                            <strong>Langkah Pertama</strong> <br>Bab 1
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link inactive" href="#step-2">
                            <strong>Langkah Dua</strong> <br>Bab 2
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link inactive" href="#step-3">
                            <strong>Langkah Terakhir</strong> <br>Bab 3
                          </a>
                        </li>
                    </ul>
                   <form id="input-lhp" class="ajax-form needs-validation" novalidate>
                    @csrf
                    <!-- <input type="hidden" name="id" id="id"> -->
                    <input type="hidden" name="spt_id" value="{{$data_pemeriksaan[0]->spt_id}}">
                    <input type="text" name="id" id="id_ketua" value="{{$id}}" hidden="">
                        
                    <?php
                        $nomor_spt = '____';
                        $nomor_lhp = ""." / ".$nomor_spt." / 438.4 / ".now()->year.""; 
                    ?>
                    <div class="toolbar toolbar-top" role="toolbar" style="text-align: right;"></div><div class="tab-content" style="height: 205.438px;">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1" style="position: static; left: auto; max-width: 100%;">
                            <h3>BAB 1</h3>
                            <div class="step-1-lhp" style="width:800px; margin:0 auto;">
                                <hr>

                                    <div id="kop-surat">@include('admin.laporan.header')</div>
                                    <table class="laporan info">
                                        <td class="laporan info-nama" style="padding-left: 10px !important;">
                                            <p>Nomor <br></p>
                                            <p>Tanggal      <br></p>
                                            <p>Lampiran      <br></p>
                                            <p>Satuan Kerja  <br></p>
                                            <p>Tahun Anggaran<br></p>
                                        </td>
                                        <td class="laporan info-nama" style="padding-left: 75px !important;">
                                            <p>:  ____{!!$nomor_lhp!!} </p> <!-- sudah mengikuti ketentuan kode jenis lhp apa data masih blm ada -->
                                            <p>:  __{{now()->format('-M-Y')}} <input type="text" class="form-control datepick" style="width: 25%;display: inline;" name="custom_date" id="custom_date" autocomplete="off" placeholder="{{ __('Custom Date')}}" data-date-format="dd-mm-yyyy"></p> 
                                            <p>:  Satu Bendel</p>
                                            <p>:  {{$lokasi[0]->nama_lokasi}} Kabupaten Sidoarjo</p>
                                            <p>:  {{now()->year}}</p>
                                        </td>
                                    </table>
                                    <div class="step-1-lhp" style="width:800px; margin:0 auto;">
                                        <hr class="double" style="width:90%; margin: auto; border-radius: 2px;"><br>

                                        <div class="Bab-satu">
                                            <div class="no-bab"> BAB I  <u>SIMPULAN DAN REKOMENDASI</u><p class="nama-bab" style="text-indent: 1.5em;">SIMPULAN DAN REKOMENDASI</p></div>
                                            <div class="isi-awalan" style="text-align:justify;text-indent:26px;">Inspektorat Kabupaten Sidoarjo telah melakukan pemeriksaan pada {{$lokasi[0]->nama_lokasi}} Kabupaten Sidoarjo, dengan sampling beberapa kegiatan mulai bulan {{$spt[0]->updated_at->format('M Y')}} s/d saat pemeriksaan ({{Carbon\Carbon::parse($spt[0]->tgl_mulai)->format('d M Y')}}) Secara umum penggunaan anggaran telah dilaksanakan sesuai dengan ketentuan yang berlaku namun masih ditemukan beberapa kelemahan yang perlu mendapat perhatian lebih lanjut, yaitu :</div><br>
                                            
                                            <table class="tabel simpulan">
                                                <?php
                                                    for($i=0;$i<count($data_pemeriksaan);$i++) //judultemuan yang ditampilkan hanya data dari anggota tim
                                                    {
                                                        $number = $i + 1;
                                                        // dd($data_pemeriksaan);
                                                        echo "<tr>";/*"<p style='text-indent: 0.6cm;'>judultemuan ini masih kosong</p>"*/
                                                        echo "<td>".$number.". ".$data_pemeriksaan[$i]->judultemuan."<br>".json_decode($data_pemeriksaan[$i]->kriteria)."</td>"; // isi
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2" style="position: static; left: auto; max-width: 100%;">
                            <h3>BAB II</h3>
                            <div style="width:800px; margin:0 auto;">
                                <div class="Bab-dua">
                                <div class="no-bab"> BAB II  <u>URAIAN HASIL PEMERIKSAAN</u></div>
                                    <p class="nama-bab" style="text-indent: 1.5em;">A.  DATA UMUM</p>
                                        <div class="isi point-1 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">1. Dasar Pemeriksaan :</p>
                                            <table class="dasar data_umum" width="100%" style="margin: 55px;margin-top: -7px;margin-bottom: 20px;">
                                                <tr>
                                                    <td style="width:85%;">
                                                        <table  class="data_umum isi-umum" width="100%">{!!$dasar!!}</table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="isi point-2 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">2. Tujuan Pemeriksaan :</p><br>
                                            <div class="point-2-isi" style="margin: 55px;margin-top: -28px;margin-bottom: 20px;">
                                                <!-- <p>a.  Menilai efisiensi dan efektivitas penggunaan sumber daya.<br></p>
                                                <p>b.  Menilai kepatuhan terhadap peraturan perundang-undangan.<br></p>
                                                <p>c.  Memberikan rekomendasi atas permasalahan yang ditemukan dalam pemeriksaan.<br></p> -->
                                                <textarea type="textarea" class="form-control" id="summernote-tujuan-pemeriksaan" name="sub_bab[tujuan-pemeriksaan]"></textarea>
                                            </div>
                                        </div>
                                        <div class="isi point-3 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">3. Ruang Lingkup Pemeriksaan :</p><br>
                                            <div class="point-3-isi" style="margin: 55px;margin-top: -28px;margin-bottom: 20px;">
                                                <textarea type="textarea" class="form-control" id="summernote-ruang-lingkup-pemeriksaan" name="sub_bab[ruang-lingkup-pemeriksaan]"></textarea>
                                            </div>
                                        </div>
                                        <div class="isi point-4 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">4. Batasan Pemeriksaan :</p><br>
                                            <div class="point-4-isi" style="margin: 55px;margin-top: -28px;margin-bottom: 20px;">
                                                <textarea type="textarea" class="form-control" id="summernote-batasan-pemeriksaan" name="sub_bab[batasan-pemeriksaan]"></textarea>
                                            </div>
                                        </div>
                                        <div class="isi point-5 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">5. Pendekatan Pemeriksaan :</p><br>
                                            <div class="point-5-isi" style="margin: 55px;margin-top: -28px;margin-bottom: 20px;">
                                                <textarea type="textarea" class="form-control" id="summernote-pendekatan-pemeriksaan" name="sub_bab[pendekatan-pemeriksaan]"></textarea>
                                            </div>
                                        </div>
                                        <div class="isi point-6 data_umum">
                                            <p style="margin-left: 30px;text-indent: 0.3cm;">6. Strategi Pelaporan :</p><br>
                                            <div class="point-6-isi" style="margin: 55px;margin-top: -28px;margin-bottom: 20px;">
                                                <p>Laporan Pemeriksaan disusun dengan skema :</p>
                                                <p>Bab I   Simpulan dan Rekomendasi hasil pemeriksaan</p>
                                                <p>Bab II  Uraian Hasil Pemeriksaan</p>
                                                <p>Bab III  Penutup</p>
                                            </div>
                                        </div>
                                    <p class="nama-bab"style="text-indent: 1.5em;">B.  HASIL PEMERIKSAAN</p>
                                        <div class="isi point-1 hasil_pemeriksaan">
                                            <div class="point isi-hasil-pemeriksaan" style="margin: 40px;margin-top: 0px;">
                                                <textarea type="textarea" class="form-control" id="summernote-hasil-pemeriksaan" name="sub_bab[hasil-pemeriksaan]"></textarea>
                                            </div>
                                        </div>
                                    <p class="nama-bab"style="text-indent: 1.5em;">C.  TEMUAN DAN REKOMENDASI</p>
                                        <div class="isi point-1 temuan_rekomendasi">
                                            <div class="point isi-hasil-pemeriksaan" style="margin: 40px;margin-top: 0px;">
                                                <table class="tabel simpulan">
                                                <?php
                                                    // for($i=0;$i<count($data_pemeriksaan);$i++) //judultemuan yang ditampilkan hanya data dari anggota tim
                                                    foreach ($data_pemeriksaan as $key => $value) {
                                                        // dd($data_pemeriksaan);
                                                        $number = $key + 1;
                                                        echo "<tr>";/*"<p style='text-indent: 0.6cm;'>judultemuan ini masih kosong</p>"*/
                                                        echo "<td>".$number.". ".$value->judultemuan.json_decode($value->kriteria).json_decode($value->kondisi)."</td>"; // penomoran masih belum bisa auto
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                        echo "<td>".'Sebab<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;"><textarea type="textarea" class="form-control" name="point_kka_lhp['.$key.']">'.$value->sebab.'</textarea></div>'."</td>"; // isi
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                        echo "<td>".'Akibatnya<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;"><textarea type="textarea" class="form-control" name="point_kka_lhp['.$key.']">'.$value->akibat.'</textarea></div>'."</td>"; // isi
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                        echo "<td>".'Komentar yang diperiksa<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;"><textarea type="textarea" class="form-control" name="point_kka_lhp['.$key.']">'.$value->komentar.'</textarea></div>'."</td>"; // isi
                                                        echo "</tr>";
                                                        echo "<tr>";
                                                        echo "<td>".'Rekomendasi<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;"><textarea type="textarea" class="form-control" name="point_kka_lhp['.$key.']">'.$value->rekomendasi.'</textarea></div>'."</td>"; // isi
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </table>
                                            </div>
                                        </div>
                                <!-- point ke dua masih belum tau datanya. -->
                                
                            </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3" style="position: static; left: auto; max-width: 100%;">
                        <h3>BAB III</h3>
                            <div style="width:800px; margin:0 auto;">
                                <div class="Bab-dua">
                                    <div class="no-bab"> BAB III  <u>PENUTUP</u></div>
                                        <div class="isi-penutup">
                                            <p style="text-indent: 1cm;text-align: justify;margin-top: 15px;">Demikian Laporan Hasil Pemeriksaan pada {{$lokasi[0]->nama_lokasi}} Kabupaten Sidoarjo untuk segera ditindak lanjuti selambat - lambatnya "TOTAL HARI TINDAK LANJUT LHP belum diketahui nilainya dari mana !!! (sebutan hari tindak lanjut)" hari kerja setelah diterimanya Laporan Hasil Pemeriksaan</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;"><button class="btn sw-btn-prev disabled" type="button">Kembali</button><button class="btn sw-btn-next" type="button">Step Selanjutnya</button><button class="btn btn-success finish" id="finish" type="submit" style="display: none;background-color: #2dce89;border: 0px;">Unggah Paparan</button><button id="reset-btn" class="btn btn-danger" style="background-color: #ec0c38;border: 0px;">Reset Step / Kembali ke Awal</button></div>
                    <!-- type="submit" class="btn btn-primary offset-md-8 default-button" -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

        $('#custom_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
        }); 
    
      $(document).ready(function(){

          // Toolbar extra buttons
          // Toolbar extra buttons
          var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function(){ alert('Finish Clicked'); });
          var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function(){ $('#smartwizard').smartWizard("reset"); });
          
          // Step show event
          $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
              $("#prev-btn").removeClass('disabled');
              $("#next-btn").removeClass('disabled');
              if(stepPosition === 'first') {
                  $("#prev-btn").addClass('disabled');
              } else if(stepPosition === 'last') {
                    // #step-3
                  $('#finish').show();
                  $("#next-btn").addClass('disabled');
              } else {
                  $("#prev-btn").removeClass('disabled');
                  $("#next-btn").removeClass('disabled');
              }
          });

          // Smart Wizard
          $('#smartwizard').smartWizard({
              selected: 0,
              theme: 'arrows',
              toolbarSettings: {
                  toolbarPosition: 'both', // both bottom
                  toolbarExtraButtons: [btnFinish, btnCancel]
              }
          });

          // External Button Events
          $("#reset-btn").on("click", function() {
              // Reset wizard
              $('#smartwizard').smartWizard("reset");
              $('.finish').hide();
              return true;
          });

          $("#prev-btn").on("click", function() {
              // Navigate previous
              $('#smartwizard').smartWizard("prev");
              return true;
          });

          $("#next-btn").on("click", function() {
              // Navigate next
              $('#smartwizard').smartWizard("next");
              return true;
          });

          $('.finish').click(function(){
                var id = $("#id_ketua").val();
                // alert();
                $.confirm({
                    title: "{{ __('Perhatian!') }}",
                    content: "{{ __('Apakah anda sudah yakin dengan data yang anda inputkan ?') }}",
                    buttons: {
                        Simpan: {
                            btnClass: 'btn-success',
                            action: function(){                       
                                 window.location.href = (window.location.pathname == '/admin/kka/input-lhp/'+id) ? "{{route('unggah',$id)}}" : "{{route('unggah',$id)}}";
                            },
                        },
                        Kembali: function(){
                $.alert('Dibatalkan!');
                        }
                    }
                });
          });

          $("#animation").on("change", function() {
              // Change theme
              var options = {
                transition: {
                    animation: $(this).val()
                },
              };
              $('#smartwizard').smartWizard("setOptions", options);
              return true;
          });

      });

    /*start bab II*/
    $('#summernote-tujuan-pemeriksaan').summernote({
        placeholder: 'Tujuan Pemeriksaan',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#summernote-ruang-lingkup-pemeriksaan').summernote({
        placeholder: 'Ruang Lingkup Pemeriksaan',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    
    $('#summernote-batasan-pemeriksaan').summernote({
        placeholder: 'Ruang Lingkup Pemeriksaan',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    
    $('#summernote-pendekatan-pemeriksaan').summernote({
        placeholder: 'Ruang Lingkup Pemeriksaan',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#summernote-hasil-pemeriksaan').summernote({
        placeholder: 'Hasil Pemeriksaan',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    /*end bab II*/


    $('#summernote-lhp-kriteria').summernote({
        placeholder: 'Kriteria LHP',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-lhp-sebab').summernote({
        placeholder: 'Sebab LHP',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-lhp-akibat').summernote({
        placeholder: 'Akibat LHP',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-lhp-komen').summernote({
        placeholder: 'Komen LHP',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-kondisi').summernote({
        placeholder: 'Kondisi',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-kriteria').summernote({
        placeholder: 'Kriteria',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

     $('#kode').selectize({    
        /*sortField: 'text',*/
        allowEmptyOption: false,
        placeholder: 'Pilih Kode Temuan',
        create: false,
        onchange: function(value){
         
        },
    });

    $('#ref').selectize({    
            /*sortField: 'text',*/
            allowEmptyOption: false,
            placeholder: 'Pilih Refrensi',
            create: false,
            onchange: function(value){
             
        },
    });

    var current = null;
    function showresponddiv(messagedivid){
        var id = messagedivid.replace("Jlaporan-", "form-"),
            div = document.getElementById(id);
        // hide previous one
        if(current && current != div) {
            current.style.display =  'none';
        }   
        if (div.style.display=="none"){
            div.style.display="inline";
            current = div;
        } 
        else {
            div.style.display="none";
        }
    }

    $("#input-lhp").validate({
        rules: {
            id : {required: true},
            spt_id : {required: true},
            kode_lhp : {required: true},
            custom_date : {required: true},
            sub_bab : {required: true},
            point_kka_lhp : {required: true}

        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            var id = $('#id').val();

            base_url = "{{ route('laporan_lhp') }}";
            // console.log(base_url)
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        
            $.ajax({
                url: url,
                type: type,
                data: $('#input-lhp').serialize(),
                dataType: 'text',
                success: function(data){
                    //str = res.responseText;
                    console.log(data);
                    // $("#edit-kka-form")[0].reset();
                    // $('#shotModalEditKKA').modal('hide'); //show edit kka modal
                    // setTimeout(function(){// wait for 2 secs
                    //      location.reload(); // then reload the page
                    // }, 2000);
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        }
    });
    

</script>


@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/summernote-master/dist/summernote-lite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/jquery-smartwizard-master/dist/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/summernote-master/dist/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-smartwizard-master/dist/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush


