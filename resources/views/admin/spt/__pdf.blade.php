
<!DOCTYPE html>
<html>
<head>
	<!-- <title>JENIS SPT</title> -->
	<!-- tittle berisikan jenis SPT  -->
	
	<!-- </p> -->

	<style>
		.clear{
			clear: both;
		}
		div.spt{
			width: 100%;
			margin: 0px auto;
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
		div.dasar-spt span{
			float: left;
			display: block;
			width: 10%;
			padding-left: 5px;
		}
		div.dasar-spt div.isi-dasar{
			width: 90%;
			float: right;
		}
		.dasar-spt, .isi-spt, .pegawai-spt{
			margin: 0px auto;
			width: 95%;
			display:block;
			padding-left: 10px;
			clear:both;
		}
		.pegawai-spt{
			margin-left:25px;
		}
		.table-user-spt{
			width: 100%;
			border-collapse: collapse;
			margin-top: 5px;
		}
		.table-user-spt th{
			vertical-align: middle;
			text-align: center;
		}
		.table-user-spt td, .table-user-spt th{
			border: 1px solid #ddd;
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

<body>

	<div class="spt">
		<div class="logo-banner"><img src="{{ asset('images/kop_spt.jpg') }}" width="720px"></div>
			
			
			
			
				<?php
					
					$isi = $spt->jenisSpt->isi;
					
					$isi = str_replace('%LOKASI%', $spt->lokasi, $isi);
					
					$start = \Carbon\Carbon::parse($spt->tgl_mulai);
					$finish = \Carbon\Carbon::parse($spt->tgl_berakhir);
					$created = \Carbon\Carbon::parse($spt->created_at);
					$approval = \Carbon\Carbon::parse($spt->created_at);
					
					$status = $spt->status;
					switch($status){
						case 'disetujui':
							$header_spt = "
								<h2><u>SURAT TUGAS</u></H2>
								<h3>No. 800/".$spt->no."/404.4/".$approval->format('Y')."</h3>";
							break;
						case 'ditolak':
							$header_spt = "
								<h2><u>SPT DITOLAK</u></H2>
								<h3>No.---/----/----/----</h3>";
							break;
						default :
							$header_spt = "
							<h2><u>SPT DALAM PROSES</u></H2>
							<h3>No. 800/".$spt->nama."/404.4/".$approval->format('Y')."</h3>";
					}
					
					$isi = str_replace('%TGL_MULAI%', $start->formatLocalized('%d %B %Y'), $isi);
					$isi = str_replace('%TGL_AKHIR%', $finish->formatLocalized('%d %B %Y'), $isi);					
					$isi = str_replace('%LAMA_SPT%', $start->diffInDays($finish) . " Hari", $isi);
					
				?>
			<div class="header-spt">
			
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
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Sebagai</th>
						<th>Lama</th>
					</tr>
					@php
					$n=0;
					$user_spt = '';
					foreach ($detail_spt as $detail){
						$n = $n+1;
						$user_spt .= "<tr>";
							$user_spt .= "<td>" . $n. ".</td>";
							$user_spt .= "<td>" . $detail->user->full_name. "</td>";
							$user_spt .= "<td>" . $detail->peran. "</td>";
							$user_spt .= "<td align=\"center\">" . $detail->lama. " Hari</td>";
						$user_spt .= "</tr>";
						
					}
					echo $user_spt;
					@endphp
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
		
		
	
	</body>
</html>