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

		.pemeriksaan-tujuan-KKA-KKP{
			padding-top: 20px;
			padding-left : 50px;
			font-size: 16px;
			width: 50%;
		}
		.pemeriksaan-info-KKA-KKP{
			padding-top: 20px;
			font-size: 16px;
			width: 50%;
			padding-left: 100px;
		}
		.pemeriksaan-awal-isi{
			letter-spacing: 1px;
			padding-top: 20px;
			padding-left : 65px;
			font-size: 16px;
			margin-right: 35px;
		}

		.pemeriksaan-akhir-isi{
			letter-spacing: 1px;
			padding-top: 20px;
			padding-left : 65px;
			font-size: 16px;
			margin-right: 35px;
		}

		.dasar-spt, .pegawai-spt{
			margin: 0px auto;
			width: 90%;
			display:block;
			padding-left: 10px;
			clear:both;
			
		}

		.komentar{
			padding-top: 20px;
			padding-left : 65px;
			font-size: 16px;
			margin-right: 35px;
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
<?php 
			$DataLaporan = $Laporan;
			$namaPembuat = $getNameUser;

	?>
<body>
	<header>
		@include('admin.laporan.header')
	</header>

	<table class="laporan">
		<td class="pemeriksaan-tujuan-KKA-KKP">
			<p>Nama Auditan  : {{$getSPT[0]->lokasi_spt}}<br></p>
			<p>Sasaran Audit : {{$isiLaporan[0]->sasaran_audit}}<br></p>
			<p>Periode Audit : {{$getSPT[0]->periodekka}}<br></p>
		</td>
		<td class="pemeriksaan-info-KKA-KKP">
			<?php $i = 1; ?>
			<?php (count($isiLaporan) > 1) ? $data = $i : $data = $i++; ?> <!-- kayaknya engga ngeloop -->
			<p>KKA Nomor : {{$data}}<br></p>
			<p>Dibuat Oleh : {{$namaPembuat->full_name}}<br></p>
			<p>Direviu Oleh : {{$getPenyetujuLaporan->full_name}}<br></p>
			<p>Disetujui : {{$getdaltu->full_name}}</p>
			<!-- //$user->hasRole('Perencanaan') ) ? 'pengawasan' : 'umum' -->
		</td>
	</table>
	<div class="row">
		<div class="col pemeriksaan-awal-isi">
			<!-- {{$DataLaporan->file_laporan['judultemuan']}} <br> -->
			{{$isiLaporan[0]->judultemuan}}<br>
			Kode Temuan : {{$kode_temuan[0]->select_supersub_kode}} {{$kode_temuan[0]->deskripsi}}<br>
			Kegiatan  	: {{$DataLaporan->file_laporan['KegiatanKKP']}}<br>
			KPA 	  	: {{$DataLaporan->file_laporan['KPA']}}<br>
			PPTK 	  	: {{$DataLaporan->file_laporan['PPTK']}}<br>
			BPP  	  	: {{$DataLaporan->file_laporan['BPP']}}<br>

		</div>
	</div>
<!-- css untuk sring style="text-align: justify; text-justify: newspaper" -->
	<container>
		<div class="row">
			<div class="col pemeriksaan-akhir-isi">
				
					<P style="text-decoration: underline;">Kondisi</P>
					<?php $decoded = base64_decode($isiLaporan[0]->kondisi, true);?>
					<?php if(base64_encode($decoded) != $isiLaporan[0]->kondisi) {  echo json_decode($isiLaporan[0]->kondisi);?>
							<?php ?>
					<?php } else { echo $isiLaporan[0]->kondisi; } ?>
					<br>
					<p style="text-decoration: underline;">Kriteria</p>
					<?php $decoded = base64_decode($isiLaporan[0]->kriteria, true);?>
					<?php if(base64_encode($decoded) != $isiLaporan[0]->kriteria) {  echo json_decode($isiLaporan[0]->kriteria);?>
							<?php ?>
					<?php } else { echo $isiLaporan[0]->kriteria;}?> <br>

				
			</div>
		</div>
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