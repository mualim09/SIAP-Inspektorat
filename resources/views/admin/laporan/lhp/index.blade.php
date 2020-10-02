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
<!DOCTYPE html>
<html>
<head>
    <title>
        @if(isset($title))
            {{$title}}
        @else
            Inspektorat Daerah Kabupaten Sidoarjo
        @endif
    </title>
    <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style type="text/css">
        .header-text{
            color:#000;
        }
        h1, h2, h3, h4, h5, h6{margin-bottom: 0px;}
        hr.double{margin: 0 0;border-style: double;}
        .clear{clear: both;}
        .tiny-text{font-size: 0.7em;text-align: center; margin: 0 0; padding: 0 0;}
        ol{margin:0;}
        .clear{
            clear: both;
        }
        .bold{
            font-weight: bold;
        }
        .center{
            text-align: center;
        }
        div#spt-container{
            width: 100%;
            margin: 0px auto;
            font-size: 12pt;
        }
        div.logo-banner{
            margin: 0px auto;
            width:95%;
            display:block;
        }
        div.header-spt{display: block;margin: 5px auto; text-align: center; width: 35%;}
        .header-spt h2, .header-spt h3{
            margin: 0px;
            
        }

        table.info{
            margin: 0px 30px 0px 30px;
            font-size: 15px;
        }

        div.no-bab,.nama-bab{
            font-weight: bold;
            padding-top: 10px;
            margin: 0px 0px 0px 40px;
        }

        div.nama-bab{
            font-weight: bold;
            padding-top: 10px;
            margin: 0px 0px 0px 48px;
        }

        div.isi-awalan{
            text-align: justify;
            padding-bottom: 13px;
            margin: 0px 85px 0px 85px;
            display: block;
        }

        .judul{
            padding-top: 20px;
            padding-bottom: 13px;
            text-align: center;
            margin: 0px 30px 0px 30px;
            display: block;
            font-size: 19px;
        }

        .komentar{
            padding-top: 20px;
            padding-left : 65px;
            font-size: 16px;
            margin-right: 35px;
        }
        
        table.simpulan{
            text-align: justify;
            padding-bottom: 13px;
            width: 550px;
            margin: auto;
            /*border: 1px solid red;*/
            /*margin-left: 58px;*/
            /*margin-right: 58px;*/
        }

        table.data_umum{
            /*margin-top: -20px*/
            padding-bottom: 13px;
            width: 530px;
            margin: auto;
        }

        table.isi-umum{
            text-align: justify;
        }

        div.point-2-isi,.point-6-isi{
            text-align: justify;
            margin: -25px 85px 0px 85px;
        }

        div.isi-B1 > p{
            text-align: justify;
            margin: 0px 0px 0px 40px;
        }

        .paraf_yg_diperiksa{
            padding-top: 20px;
            padding-left : 65px;
            font-size: 16px;
            margin-right: 35px;
        }
        
        div.ttd-inspektur{
            padding-top:10px;
            width: 44%;
            float: right;           
        }
        .ttd-inspektur span{
            display: block;
            text-align: left;
            /*padding : 10px;*/
            width: 80%;
        }
        .ttd-inspektur span.nama-inspektur{
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <header>
        @include('admin.laporan.header')
    </header>

    <div class="Judul-lhp judul">LAPORAN HASIL PEMERIKSAAN<br>PADA {{strtoupper($data_lokasi->nama_lokasi)}} DAERAH<br>KABUPATEN SIDOARJO</div>

    <hr class="double" style="width:89%; margin: auto;">
    <table class="laporan info">
        <td class="laporan info-nama" style="padding-left: 10px !important;">
            <p>Nomor Tanggal <br></p>
            <p>Tanggal      <br></p>
            <p>Lampiran      <br></p>
            <p>Satuan Kerja  <br></p>
            <p>Tahun Anggaran<br></p>
        </td>
        <td class="laporan info-nama" style="padding-left: 75px !important;">
            <?php $nomor = ($data_jenis_spt->sebutan == 'Audit Operasional') ? '700' : '_____';?>
            <p>:  {{$nomor}} / _____ / 404.4 / {{now()->year}}</p>
            <p>:  ____{{$data_spt->updated_at->format('-M-Y')}}</p>
            <p>:  Satu Bendel</p>
            <p>:  {{$data_lokasi->nama_lokasi}}</p>
            <p>:  {{now()->year}}</p>
        </td>
    </table>
    <hr class="double" style="width:89%; margin: auto; border-radius: 2px;">

    <div class="Bab-satu">
        <div class="no-bab"> BAB I  <u>SIMPULAN DAN REKOMENDASI</u><p class="nama-bab" style="text-indent: 1.5em;">SIMPULAN DAN REKOMENDASI</p></div>
        <div class="isi-awalan" >Inspektorat Kabupaten Sidoarjo telah melakukan pemeriksaan pada {{$data_lokasi->nama_lokasi}} Kabupaten Sidoarjo, dengan sampling beberapa kegiatan mulai bulan {{$data_spt->updated_at->format('M Y')}} s/d saat pemeriksaan ({{Carbon\Carbon::parse($data_spt->tgl_mulai)->format('d M Y')}}) Secara umum penggunaan anggaran telah dilaksanakan sesuai dengan ketentuan yang berlaku namun masih ditemukan beberapa kelemahan yang perlu mendapat perhatian lebih lanjut, yaitu :</div>
        
        <table class="tabel simpulan">
            <?php
                for($i=0;$i<count($data_Laporan);$i++) //judultemuan yang ditampilkan hanya data dari anggota tim
                {
                    $number = $i + 1;
                    // dd($data_pemeriksaan);
                    echo "<tr>";/*"<p style='text-indent: 0.6cm;'>judultemuan ini masih kosong</p>"*/
                    echo "<td>".$number.". ".$data_Laporan[$i]->judultemuan."<br>".json_decode($data_Laporan[$i]->kriteria)."</td>"; // isi
                    echo "</tr>";
                }
            ?>
        </table>

    </div>
    <div class="Bab-dua">
        <div class="no-bab"> BAB II  <u>URAIAN HASIL PEMERIKSAAN</u></div>
            <p class="nama-bab" style="text-indent: 1.5em;">A.  DATA UMUM</p>
                <div class="isi point-1 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">1. Dasar Pemeriksaan :</p>
                    <table class="dasar data_umum" width="100%">
                        <tr>
                            <td style="width:85%;">
                                <table  class="data_umum isi-umum" width="100%">{!!$dasar!!}</table>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="isi point-2 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">2. Tujuan Pemeriksaan :</p><br>
                    <div class="point-2-isi">
                        <?php echo json_decode($data_detail->info_laporan_pemeriksaan)->tujuan_pemeriksaan; ?>
                    </div>
                </div>
                <div class="isi point-3 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">3. Ruang Lingkup Pemeriksaan :</p><br>
                    <div class="point-2-isi">
                        <?php echo json_decode($data_detail->info_laporan_pemeriksaan)->ruang_lingkup_pemeriksaan; ?>
                    </div>
                </div>
                <div class="isi point-4 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">4. Batasan Pemeriksaan :</p><br>
                    <div class="point-2-isi">
                        <?php echo json_decode($data_detail->info_laporan_pemeriksaan)->batasan_pemeriksaan; ?>
                    </div>
                </div>
                <div class="isi point-5 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">5. Pendekatan Pemeriksaan :</p><br>
                    <div class="point-2-isi">
                        <?php echo json_decode($data_detail->info_laporan_pemeriksaan)->pendekatan_pemeriksaan; ?>
                    </div>
                </div>
                <div class="isi point-6 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">6. Strategi Pelaporan :</p><br>
                    <div class="point-6-isi">
                        <p>Laporan Pemeriksaan disusun dengan skema :</p>
                        <p>Bab I   Simpulan dan Rekomendasi hasil pemeriksaan</p>
                        <p>Bab II  Uraian Hasil Pemeriksaan</p>
                        <p>Bab III  Penutup</p>
                    </div>
                </div>
            <p class="nama-bab" style="text-indent: 1.5em;">C.  TEMUAN DAN REKOMENDASI</p>
            <div class="isi point-1 data_umum">
                    <div class="isi point-1 temuan_rekomendasi">
                        <div class="point isi-hasil-pemeriksaan" style="margin: 40px;margin-top: 0px;">
                            <table class="tabel simpulan">
                            <?php
                                // for($i=0;$i<count($data_pemeriksaan);$i++) //judultemuan yang ditampilkan hanya data dari anggota tim
                                foreach ($data_Laporan as $key => $value) {
                                    // dd($data_pemeriksaan);
                                    $number = $key + 1;
                                    echo "<tr>";
                                    echo "<td>".$number.". ".$value->judultemuan.'<br>kondisi'.$value->kondisi.'kriteria'.json_decode($value->kriteria)."</td>"; // penomoran masih belum bisa auto
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>".'Sebab<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;">'.$value->sebab.''."</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>".'Akibat<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;">'.$value->akibat.''."</td>"; // isi
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>".'Komentar<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;">'.$value->komentar.''."</td>"; // isi
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>".'Rekomendasi<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;">'.$value->rekomendasi.''."</td>"; // isi
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                        </div>
                    </div>
            </div>
        <!-- point ke dua masih belum tau datanya. -->
        
    </div>
    <div class="Bab-tiga">
        <div class="no-bab"> BAB III  <u>PENUTUP</u><!-- <p class="nama-bab" style="text-indent: 1.5em;">1.  DATA UMUM</p> -->
            <p style="text-indent: 1cm;text-align: justify;margin-top: 15px;font-weight: normal;">Demikian Laporan Hasil Pemeriksaan pada {{$data_lokasi->nama_lokasi}} Kabupaten Sidoarjo untuk segera ditindak lanjuti selambat - lambatnya "TOTAL HARI TINDAK LANJUT LHP belum diketahui nilainya dari mana !!! (sebutan hari tindak lanjut)" hari kerja setelah diterimanya Laporan Hasil Pemeriksaan</p>
        </div>
    </div>

    <container>
       
    </container>

    <footer>
        <div class="row">
            <div class="footer komentar">
                <p style="font-weight: bold;font-style: italic;">Komentar Pejabat Yang Diperiksa :</p>
                ..........................................................................................................................................<br>
                ..........................................................................................................................................<br>
                ..........................................................................................................................................<br>
                ..........................................................................................................................................<br>
            </div><br>
        </div>
        <div class="row">
            <div class="footer paraf_yg_diperiksa">
                <p style="font-weight: bold;font-style: italic;">Nama dan Paraf Pejabat Yang Diperiksa :</p>
                <br><br>
                ........................................................
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>