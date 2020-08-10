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
        p{margin: 5px 0}
        div.dasar-spt span, div.pegawai-spt span{
            float: left;
            display: block;
            width: 10%;
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
            <p>:  {{$data_spt->nomor}}/{{$data_jenis_spt->kode_kelompok}}/404.4/{{now()->year}}</p>
            <p>:  __{{$data_spt->updated_at->format('-M-Y')}}</p>
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
                for($i=1;$i<=count($data_pemeriksaan);$i++)
                {
                    echo "<tr>";
                    for ($j=1;$j<=count($data_pemeriksaan);$j++)
                    {
                        echo "<td>".$i.". ".$data_pemeriksaan[0]->judultemuan."<br>"."<p style='text-indent: 0.6cm;'>judultemuan ini masih kosong</p>"."</td>"; // isi
                    }
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
                        <p>a.  Menilai efisiensi dan efektivitas penggunaan sumber daya.<br></p>
                        <p>b.  Menilai kepatuhan terhadap peraturan perundang-undangan.<br></p>
                        <p>c.  Memberikan rekomendasi atas permasalahan yang ditemukan dalam pemeriksaan.<br></p>
                    </div>
                </div>
                <div class="isi point-3 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">3. Ruang Lingkup Pemeriksaan :</p><br>
                    
                </div>
                <div class="isi point-4 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">4. Batasan Pemeriksaan :</p><br>
                    
                </div>
                <div class="isi point-5 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">5. Pendekatan Pemeriksaan :</p><br>
                    
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
            <p class="nama-bab" style="text-indent: 1.5em;">B.  HASIL PEMERIKSAAN</p>
            <div class="isi point-1 data_umum">
                    <p style="margin-left: 30px;text-indent: 1.3cm;">B.1. Aspek Organisasi dan Tata Kerja :</p>
                    <div class="isi-B1">
                        <p style="text-indent: 0.8cm;">1.  Pelaksanaan Tugas dan Fungsi. Tidak ada kekosongan jabatan Struktural di Badan Perencanaan Pembangunan Daerah Kabupaten Sidoarjo.</p><br>
                    </div>
            </div>
        <!-- point ke dua masih belum tau datanya. -->
        
    </div>
    <div class="Bab-tiga">
        <div class="no-bab"> BAB III  <u>PENUTUP</u><!-- <p class="nama-bab" style="text-indent: 1.5em;">1.  DATA UMUM</p> --></div>
    </div>

    <container>
       
    </container>

    <footer>
        <!-- <div class="row">
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
        </div> -->
    </footer>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>