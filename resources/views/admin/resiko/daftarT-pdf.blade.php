<style type="text/css">
	table {
	  	border-collapse: collapse;
	  	width: 100%;	
	}

	table, td, th {
		border: 1px solid black;
	}
	div.tabel-data{
		margin: 100px;
		display: block;
	}

	div.header-resiko{
		margin-top: 40px;
	}

	div.ttd-inspektur{
			width: 30%;
			float: right;
			margin-right: 80px;			
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
		.ttd-inspektur span.nip-inspektur{
			margin-top: -20px;
		}
		.ttd-inspektur span.an-inspektur{
			margin-top: -20px;
		}

	p{
		margin-top: -19px;
    	font-size: 17px;
	}

</style>

<div class="header-resiko">
	<center>
		<h1>"sementara get data bisa" tetapi tidak sesuai dengan id yang di dapat dari button table data resiko.</h1>
		<h1>{{ __('Daftar Tujuan Kegiatan') }}</h1>
		<p>Tahun Anggaran {{$date->year}}</p>
		
	</center>
</div>
<body>
	<?php
		$r = request()->route('id');
		$myVar = $r;
		$myVars= $myVar +0; 
		$i = 0;
		if ($myVars == $i) {
			echo "kondisi looping salah";
		}else{
			echo $myVars;
		}
	?>

	<div class="table-responsive tabel-data">
		<h4>Nama OPD : {{$skpd[$myVar]->relasi_tbl_skpd->nama_skpd}}</h1>
		<table class="table table-bordered">
			<thead>
				<tr>
				<?php $i ++ ?>
					<th>No</th>
					<th>Tujuan Perangkat Daerah</th>
					<th>Sasaran Perangkat Daerah</th>
					<th>Kegiatan yang mendukung capaian Sasaran Perangkat Daerah</th>
					<th>Tujuan Kegiatan</th>
				</tr>
			</thead>
			<tbody>
					<tr>
						<td>{{ $i }}</td>
						<td>{{$data[$myVars]->relasi_tbl_skpd->tujuan}}</td>
						<td>{{$data[$myVars]->relasi_tbl_skpd->sasaran}}</td>
						<td>{{$data[$myVars]->nama_kegiatan}}</td>
						<td>{{$data[$myVars]->tujuan_kegiatan}}</td>
					</tr>
			</tbody>
		</table>
	</div>
	<!--tanggal langsung otomatis mengikuti hari ini -->
	<div class="ttd-inspektur">
		<span class="tgl-ttd">Sidoarjo, {{$date->format('d F Y')}}</span>
		<span class="an-inspektur">INSPEKTUR KABUPATEN SIDOARJO</span>
		<span class="nama-inspektur"><u><b>ANDJAR SURJADIANTO, S.Sos</b></u></span>
		<span class="nip-inspektur"><b>Nip. 197009261990031005</b></span>
	</div>
</body>
