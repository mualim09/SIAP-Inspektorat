<?php
	
	$i=0; 
	$dasar_spt = array_filter(explode(";",strip_tags($spt->jenisSpt->dasar)));
	//$dasar_spt = preg_split("/;/$", strip_tags($spt->jenisSpt->dasar), PREG_SPLIT_NO_EMPTY);
	$dasar = '';
	foreach($dasar_spt as $dasar2){
		$i = $i+1;
		if(strlen($dasar2) > 10){
			$dasar .= '<tr>';
			//setup column for first list
			if($i == 1){				
				$dasar .= '<td align="left">Dasar</td>';
				$dasar .= '<td>:</td>';
			}else{
				$dasar .= "<td></td>";
				$dasar .= "<td></td>";
			}
			$dasar .= "<td align=\"right\" valign=\"top\">" . $i. ".</td>";
			$dasar .= "<td style=\"padding-left:5px;\">" . $dasar2. "</td>";
			$dasar .= "</tr>";
			
		}
		
	}

	$isi = $spt->jenisSpt->isi;
	$isi = str_replace('[nama]', $spt->jenisSpt->name, $isi);
	$isi = str_replace('[lokasi]', $spt->lokasi_spt, $isi);
	$isi = str_replace('[tgl_mulai]', $spt->tanggal_mulai, $isi);
	$isi = str_replace('[tgl_akhir]', $spt->tanggal_akhir, $isi);
	$isi = str_replace('[periode]', $spt->periode , $isi);
	$isi = str_replace('[lama_hari]', $spt->lama_hari, $isi);
	$created = \Carbon\Carbon::parse($spt->created_at);
	$approval = \Carbon\Carbon::parse($spt->created_at);
	
	$nomor_spt = ($spt->nomor) ? $spt->nomor : '____';
	$header_spt = "
				<h5><b><u>SURAT TUGAS</u></b></h5>
				<h5>No.".$spt->jenisSpt->kode_kelompok." / ".$nomor_spt." / 438.4 / ".$created->format('Y')."</h5>";
	

	//Pegawai SPT
	$n=0;
	$user_spt = '';
	foreach ($detail_spt as $detail){
		$n = $n+1;
		$user_spt .= "<tr>";
		if($n == 1){
			$user_spt .= '<td align="left" style="width:10%">Kepada&nbsp;&nbsp;&nbsp;:</td>';
			//$user_spt .= '<td style="width:1%">:</td>';
		}elseif($n>1){
			$user_spt .= "<td style=\"width:7%\">&nbsp;</td>";
			//$user_spt .= "<td style=\"width:1%\">&nbsp;</td>";
		}
		
		$user_spt .= "<td align=\"left\" style=\"width:2%\">" . $n. ".</td>";
		$user_spt .= "<td style=\"padding-left:5px;\">" . $detail->user->full_name. "</td>";
		$user_spt .= "<td>" . $detail->peran. "</td>";
		$user_spt .= "</tr>";		
	}
	/*for($n=1;$n>=count($detail_spt);$n++){
		$user_spt .= "<tr>";
		if($n == 1){
			$user_spt .= '<td align="left">Kepada</td>';
			$user_spt .= '<td>:</td>';
		}else{
			$user_spt .= "<td>&nbsp;</td>";
			$user_spt .= "<td>&nbsp;</td>";
		}
		
		$user_spt .= "<td align=\"right\">" . $n. ".</td>";
		$user_spt .= "<td style=\"padding-left:5px;\">" . $detail->user->full_name. "</td>";
		$user_spt .= "<td>" . $detail->peran. "</td>";
		$user_spt .= "</tr>";
	}*/
	
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
		div.spt{
			width: 100%;
			margin: 0px auto;
			font-size: 12px;
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
		/*div.dasar-spt div.isi-dasar, div.pegawai-spt div.list-pegawai{
			width: 90%;
			float: right;
			padding:0px 0px;
			
		}*/
		div.isi-isi{
			
			float: right;
		}
		.dasar-spt, .pegawai-spt{
			margin: 0px auto;
			width: 90%;
			display:block;
			padding-left: 10px;
			clear:both;
			
		}
		.pegawai-spt{
			
		}
		
		div.ttd-inspektur{
			padding-top:25px;
			width: 35%;
			float: right;			
		}
		.ttd-inspektur span{
			display: block;
			text-align: left;
			/*padding : 10px;*/
			width: 80%;
		}
		.ttd-inspektur span.nama-inspektur{
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<header>
		@include('admin.laporan.header')
	</header>

	<container>
		<div class="spt">		
			<div class="header-spt center">			
				{!!$header_spt!!}
			</div>
			
			<div class="dasar-spt">
				<!-- <span>Dasar :</span> -->
				<!-- <div class="isi-dasar">{!! $spt->jenisSpt->dasar !!}</div> -->
				<div class="isi-dasar">
					<table class="dasar-spt-table" width="100%" >{!!$dasar!!}</table>

				</div>				
				<br class="clear" />
			</div>

			<div class="pegawai-spt">
				<div class="bold center">DITUGASKAN :</div>
				<!-- <span>Kepada :</span> -->
				<div class="list-pegawai">
					<table class="table-user-spt table1" width="100%" >					
						{!!$user_spt!!}
					</table>					
				</div>
				<br class="clear" />
			</div>
			<div class="isi-spt">
				<table width="100%">
					<tr>
						<td style="width:15%">&nbsp;</td>
						<td align="justify">{!!$isi!!}</td>
					</tr>
				</table>
				<!-- <div class="isi-isi">{!!$isi!!}</div>
				<br class="clear" />	 -->		
			</div>
			<div class="ttd-inspektur">
			<span class="tgl-ttd">Sidoarjo, ___ {{$approval->formatLocalized('%B %Y')}}</span>
			<span style="margin-left:-20px;width:10%;float:left"><b>a.n</b></span><span><b>BUPATI SIDOARJO</b></span>
			<span class="an-inspektur">INSPEKTUR</span>
			<span class="nama-inspektur"><u><b>ANDJAR SURJADIANTO, S.Sos</b></u></span>
			<span class="nip-inspektur">Pembina Utama Muda</span>
			<span class="nip-inspektur">NIP. 197009261990031005</span>
			</div>
			<div class="clear"></div>
			
	</div>
		
	</container>

	<footer>
		<!-- footer element -->
	</footer>

	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
