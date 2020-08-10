<?php
	$isi = $spt->jenisSpt->isi;
	$isi = str_replace('[nama]', $spt->jenisSpt->name, $isi);
	$isi = str_replace('[lokasi]', $spt->lokasi, $isi);
	$isi = str_replace('[tgl_mulai]', $spt->tanggal_mulai, $isi);
	$isi = str_replace('[tgl_akhir]', $spt->tanggal_akhir, $isi);
	$isi = str_replace('[lama]', $spt->lama_spt, $isi);
	$created = \Carbon\Carbon::parse($spt->created_at);
	$approval = \Carbon\Carbon::parse($spt->created_at);
	
	/*$status = $spt->approval_status;
	switch($status){
		case 'approved':
			$header_spt = "
				<h2><u>SURAT TUGAS</u></H2>
				<h3>No. 800/".$spt->nomor."/404.4/".$created->format('Y')."</h3>";
			break;
		case 'rejected':
			$header_spt = "
				<h2><u>SPT DITOLAK</u></H2>
				<h3>No.---/----/----/----</h3>";
			break;
		default :
			$header_spt = "
			<h2><u>SPT DALAM PROSES</u></H2>
			<h3>No. 800/____/404.4/".$created->format('Y')."</h3>";
	}*/
	$header_spt = "
				<p><b><u>SURAT TUGAS</u></b></p>
				<p>No.".$spt->jenisSpt->kode_kelompok."/".$spt->nomor."/404.4/".$created->format('Y')."</p>";
	
	//Pegawai SPT
	$n=0;
	$user_spt = '';
	foreach ($detail_spt as $detail){
		$n = $n+1;
		$user_spt .= "<tr>";
			$user_spt .= "<td>" . $n. ".</td>";			
			$user_spt .= ($detail->user != null ) ?"<td>" . $detail->user->first_name. ' ' .$detail->user->last_name .' '.$detail->user->gelar ."</td>" : '<td></td>';
			$user_spt .= "<td>" . $detail->peran. "</td>";
			$user_spt .= "<td>" . $detail->lama. " Hari</td>";
		$user_spt .= "</tr>";		
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
	<style>
		
		ol{margin:0;}
		.clear{
			clear: both;
		}
		div.spt{
			width: 100%;
			margin: 0px auto;
			font-size: 14px;
		}
		div.logo-banner{
			margin: 0px auto;
			width:95%;
			display:block;
		}
		.header-spt{
			width:35%;
			margin:5px auto;
			display:block;
			text-align:center;			
		}
		.header-spt h2, .header-spt h3{
			margin: 0px;
			
		}
		p{margin: 5px 0}
		div.dasar-spt span{
			float: left;
			display: block;
			width: 10%;
			padding-left: 5px;
			
		}
		div.dasar-spt div.isi-dasar{
			width: 90%;
			float: right;
			padding:0px 0px;
			
		}
		.dasar-spt, .isi-spt, .pegawai-spt{
			margin: 0px auto;
			width: 95%;
			display:block;
			padding-left: 10px;
			clear:both;
			
		}
		.pegawai-spt{
			
		}
		.table-user-spt{
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
			border:0px;
			
		}
		.table-user-spt th{
			vertical-align: middle;
			text-align: center;
		}
		.table-user-spt td, .table-user-spt th{
			border: 0px solid #ddd;
			padding: 5px;
		}
		div.ttd-inspektur{
			width: 45%;
			float: right;			
		}
		.ttd-inspektur span{
			display: block;
			text-align: center;
			padding : 10px;
			width: 100%;
		}
		.ttd-inspektur span.nama-inspektur{
			margin-top: 80px;
		}

    </style>
</head>
<body style="width:21cm !important;">	
	<header>
		@include('admin.laporan.header')
	</header>
	<container class="a4">
		<div class="spt">
			
			<div class="header-spt text-center">			
				{!!$header_spt!!}
			</div>
			<div class="dasar-spt">
				<span>Dasar : </span>
				<div class="isi-dasar">{!! $spt->jenisSpt->dasar !!}</div>
				<br class="clear" />
			</div>
			<div class="pegawai-spt">
			<span>Ditugaskan Kepada</span>
				<table class="table-user-spt table1">					
					{!!$user_spt!!}
				</table>
			</div>
			<div class="isi-spt">
			{!!$isi!!}
			</div>
			<div class="ttd-inspektur">
			<span class="tgl-ttd">Sidoarjo, {{$approval->formatLocalized('%d %B %Y')}}</span>
			<span class="an-inspektur">INSPEKTUR KABUPATEN SIDOARJO</span>
			<span class="nama-inspektur"><u><b>ANDJAR SURJADIANTO, S.Sos</b></u></span>
			<span class="nip-inspektur"><b>Nip. 197009261990031005</b></span>
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