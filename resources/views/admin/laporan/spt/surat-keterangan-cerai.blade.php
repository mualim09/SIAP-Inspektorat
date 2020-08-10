<?php
	//setup variabel
	$created = \Carbon\Carbon::parse($spt->created_at);
	$approval = \Carbon\Carbon::parse($spt->created_at);
	$arr_name = explode(' ', $spt->jenisSpt->name);
	$short_name = lcfirst($arr_name[0]);
	$i=0; 
	$dasar_spt = array_filter(explode("\n",strip_tags($spt->jenisSpt->dasar))); //explode by new line (ENTER)
	preg_match_all('/(?P<ket>(?<=keterangan:)(.*))/', $spt->jenisSpt->dasar, $matches);
	//dd($matches['ket']);
	$dasar = '';
	
	if(isset(($matches['ket'])) && count($matches['ket'])>1){
		foreach($matches['ket'] as $dasar2){
			$i = $i+1;
				$dasar .= '<tr>';
				$dasar .= "<td align=\"left\" valign=\"top\" style=\"width:4%\">" . $i. ".</td>";
				$dasar .= "<td style=\"width:96%; text-align:justify\">" . $dasar2. "</td>";
				$dasar .= "</tr>";
		}
	}else{
		$ket = $matches['ket'][0];
		$dasar .= '<tr>';
		$dasar .= "<td align=\"left\" valign=\"top\" colspan=\"2\" style=\"text-align:justify\" >".$ket."</td>";
		$dasar .= "</tr>";
	}

	

	$nomor_spt = ($spt->nomor) ? $spt->nomor : '____';
	$header_spt = "
				<h5 style=\"font-size:12pt;\"><b><u>SURAT TUGAS</u></b></h5>
				<h5 style=\"font-size:12pt;\">Nomor : ".$spt->jenisSpt->kode_kelompok." / ".$nomor_spt." / 438.4 / ".$created->format('Y')."</h5>";
	

	//Pegawai SPT
	$n=0;
	$user_spt = '';
	foreach ($detail_spt as $detail){
		$n = $n+1;
		$user_spt .= "<tr>";		
		$user_spt .= "<td align=\"left\" style=\"width:4%\">" . $n. ".</td>";
		$user_spt .= "<td style=\"width:48%\">" . $detail->user->full_name_gelar. "</td>";
		$user_spt .= "<td  style=\"width:48%\">" . $detail->peran. "</td>";
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
	<link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
	
</head>
<body>
	<header id="header-logo">
		@include('admin.laporan.header')
	</header>

	<container>
		<div id="spt-container">		
			<div id="header-spt" style="display: block;margin: 5px auto; text-align: center; width: 35%;">			
				{!!$header_spt!!}
			</div>
			
			<div id="dasar-spt">
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
			</div>

			<div id="pegawai-spt">
				<div class="bold center" style="line-height: 1.5">DITUGASKAN :</div>
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
							<table width="100%">{!!$user_spt!!}</table>
						</td>
					</tr>
				</table>
			</div>
			<div id="isi-spt">
				<table width="100%">
					<tr>
						<td style="width:15%">&nbsp;</td>
						<td style="text-align:justify">
							<p>Untuk melakukan pemeriksaan atas terjadinya  
								@if($spt->tambahan !== null)
								{{$spt->tambahan}}
								@endif
							</p>
							<p>
								Jangka waktu {{ $short_name }} selama {{ $spt->lama_hari }} kerja pada periode tanggal {{$spt->periode}}.
							</p>
							<p>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas yang dimaksud.</p>
						</td>
					</tr>
				</table>
			</div>
			<div class="ttd-inspektur">
			<span class="tgl-ttd">Sidoarjo, ___ {{$approval->formatLocalized('%B %Y')}}</span>
			<span style="margin-left:-27px;width:10%;float:left"><b>a.n</b></span><span><b>BUPATI SIDOARJO</b></span>
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
