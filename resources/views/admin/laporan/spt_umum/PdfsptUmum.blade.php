<?php
    //setup variabel
    $created = \Carbon\Carbon::parse($spt->created_at);
    $approval = \Carbon\Carbon::parse($spt->created_at);
    $arr_name = explode(' ', $spt->jenis_spt_umum);
    $short_name = lcfirst($arr_name[0]);
    $i=0; 
    $dasar_spt = array_filter(explode("\n",strip_tags($spt->info_dasar_umum))); //explode by new line (ENTER)
    $dasar = '';
    
    if(count($dasar_spt)>1){
        foreach($dasar_spt as $dasar2){
            $i = $i+1;
                $dasar .= '<tr>';
                $dasar .= "<td align=\"left\" valign=\"top\" style=\"width:4%\">" . $i. ".</td>";
                $dasar .= "<td style=\"width:96%; text-align:justify\">" . $dasar2. "</td>";
                $dasar .= "</tr>";
        }
    }else{
        $dasar .= '<tr>';
        $dasar .= "<td align=\"left\" valign=\"top\" colspan=\"2\" style=\"text-align:justify\" >" . $spt->info_dasar_umum. ".</td>";
        $dasar .= "</tr>";
    }

    

    // $nomor_spt = ($spt->nomor) ? $spt->nomor : echo '&nbsp;&nbsp;&nbsp;';
    
    $kode_kelompok = '';
    /*if ($spt->jenis_spt_umum == 'SPT Umum') {
        $kode_kelompok = '800';
    }*/if($spt->jenis_spt_umum == 'SPT Pengembangan Profesi'){
        $kode_kelompok = '800';
    }if($spt->jenis_spt_umum == 'SPT Penunjang'){
        $kode_kelompok = '800';
    }if($spt->jenis_spt_umum == 'SPT Diklat'){
        $kode_kelompok = '800';
    }
    $nomor_spt = ($spt->nomor == '') ? '&nbsp;&nbsp;&nbsp;' : $spt->nomor;
    $nomor_lampiran = "".$kode_kelompok." / ". '___' ." / 438.4 / ".$created->format('Y')."";
    $header_spt = "
                <h5 ><b><u>SURAT TUGAS</u></b></h5>
                <h5 >Nomor : ".$kode_kelompok." / ".$nomor_spt." / 438.4 / ".$created->format('Y')."</h5>";
    

    //Pegawai terlampir
    $n=0;
    $user_spt = '';
        $user_spt .= "<tr id=".'tb_user'.">";
        $user_spt .= "<th id=".'tb_user'.">" ."NO". "</th>";
        $user_spt .= "<th id=".'tb_user'.">" ."NAMA". "</th>";
        $user_spt .= "<th id=".'tb_user'.">" ."NIP". "</th>";
        $user_spt .= "<th id=".'tb_user'.">" ."GOL". "</th>";
        $user_spt .= "<th id=".'tb_user'.">" ."JABATAN". "</th>";
        $user_spt .= "<th id=".'tb_user'.">" ."INSTANSI". "</th>";
        $user_spt .= "</tr>";
    foreach ($detail_spt as $detail){
        $n = $n+1;
        $user_spt .= "<tr id=".'tb_user'.">";        
        $user_spt .= "<td id=".'tb_user'." align=\"left\" style=\"width:4%\">" . $n. ".</td>";
        $user_spt .= "<td id=".'tb_user'." style=\"width:48%\">" . $detail->user->full_name_gelar. "</td>";
        // $user_spt .= "<td  style=\"width:48%\">" . $detail->peran. "</td>";
        $user_spt .= "<td id=".'tb_user'." style=\"width:48%\">". $detail['user']->nip ."</td>";
        $user_spt .= "<td id=".'tb_user'." style=\"width:48%\">". $detail['user']->pangkat ."</td>";
        $user_spt .= "<td id=".'tb_user'." style=\"width:48%\">". $detail['user']->jabatan ."</td>";
        $user_spt .= "<td id=".'tb_user'." style=\"width:48%\">". "Inspektorat Daerah" ."</td>";
        $user_spt .= "</tr>";
    }

    // user kepada 
    $user_ditunjuk = '';
    $total_dkk = count($detail_spt);
    // dd();
    for ($i = 0; $i <= 0; $i++) {
        // dd($detail_spt[$i]);
        $user_ditunjuk = $detail_spt[$i]['user']->first_name.' '.$detail_spt[$i]['user']->last_name.'.'.$detail_spt[$i]['user']->gelar.' , '.$detail_spt[$i]['user']->nip.' Pangkat/Gol.ruang:'.' '.$detail_spt[$i]['user']->pangkat.' Jabatan '.$detail_spt[$i]['user']->jabatan.' pada Inspektorat Daerah Kabupaten Sidoarjo '.(count($detail_spt) > 0 ? "dkk ( $total_dkk orang sebagaimana daftar nama terlampir)" : '');
        // dd($user_ditunjuk);
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

        div.lampiran{
            margin-left: 440px;
        }

        table#tabel_user,th#tb_user,td#tb_user {
            border: 1px solid black;
            border-collapse: collapse;
        }

        div.lampiran{
            page-break-before: always;
        }
    </style>
</head>

<body>
    <header>
        @include('admin.laporan.header')
    </header>

    <div id="header-spt" style="display: block;margin: 5px auto; text-align: center; width: 45%;">          
        {!!$header_spt!!}
    </div>

    <table width="100%">
        <tr>
            <td style="width:15%" valign="top">
                <table width="100%">
                    <tr>
                        <td>Dasar</td>
                        <td align="right">:</td>
                    </tr>
                </table>
            </td>
            <td style="width:85%">
                <table width="100%">{!!$dasar!!}</table>
            </td>
        </tr>
    </table>

    <div class="bold center" style="line-height: 1.5">MEMERINTAHKAN :</div>

    <table width="100%">
        <tr>
            <td style="width:15%" valign="top">
                <table width="100%">
                    <tr>
                        <td>Kepada</td>
                        <td align="right">:</td>
                    </tr>
                </table>
            </td>
            <td style="width:85%">
                <p style="text-align: justify;">{{$user_ditunjuk}}</p>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td style="width:15%" valign="top">
                <table width="100%">
                    <tr>
                        <td>Untuk</td>
                        <td align="right">:</td>
                    </tr>
                </table>
            </td>
            <td style="text-align:justify">
                <p>Melaksanakan {{$spt->info_untuk_umum}}
                    
                </p>
                <!-- <p>
                    Jangka waktu {{ $short_name }} selama {{ $spt->lama_hari }} kerja pada periode tanggal {{$spt->periode}}.
                </p>
                <p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas yang dimaksud.</p> -->
            </td>
        </tr>
    </table>

    <div class="ttd-inspektur" style="clear: both;">
        <span>Dikeluarkan di : SIDOARJO</span>
        <span class="tgl-ttd"><u>Pada Tanggal, {{$approval->format('d M Y')}}</u></span>
        <span style="margin-left:-27px;width:10%;float:left"></span><span><b>INSPEKTUR KABUPATEN SIDOARJO</b></span>
        <span class="nama-inspektur"><u><b>ANDJAR SURJADIANTO, S.Sos</b></u></span>
        <span class="nip-inspektur">Pembina Utama Muda</span>
        <span class="nip-inspektur">NIP. 197009261990031005</span>
    </div>
    <div class="clear"></div>

    <container>
       
    </container>

        <div class="lampiran" id="lampiran">
            <span class="lampiran-surat">Lampiran Surat</span><br>
            <span class="lampiran-surat">Nomor :{{$nomor_lampiran}}</span><br>
            <span class="lampiran-surat">Tanggal : {{($spt->tgl_register == null) ? 'Tanggal Belum di ttd' : $spt->tgl_register}}</span>
        </div><br>
            <table id="tabel_user" width="75%" style="margin-left: auto;margin-right: auto;">{!!$user_spt!!}</table>
        <div class="ttd-inspektur" style="clear: both;">
            <span style="margin-left:-27px;width:10%;float:left"></span><span><b>INSPEKTUR KABUPATEN SIDOARJO</b></span>
            <span class="nama-inspektur"><u><b>ANDJAR SURJADIANTO, S.Sos</b></u></span>
            <span class="nip-inspektur">Pembina Utama Muda</span>
            <span class="nip-inspektur">NIP. 197009261990031005</span>
        </div>
        <div class="clear"></div>

    <footer>

    </footer>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>