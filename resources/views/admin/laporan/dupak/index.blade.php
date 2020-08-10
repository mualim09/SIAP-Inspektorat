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
	
	<style type="text/css">		
		.header-text{
			color:#000;
		}
		h1, h2, h3, h4, h5, h6{margin: 0 0;}
		tr.double{margin: 0 0;border-style: double;border-bottom: 2px double #000;}
		.clear{clear: both;}
		.tiny-text{font-size: 0.7em;text-align: center; margin: 0 0; padding: 0 0;}
		.text-center{text-align: center;}

		#personal-info table, #dupak-container table{border:1px solid #000; border-collapse: collapse;margin-bottom: 10px; margin-top: 10px;}
		#personal-info table td,  #dupak-container table th,#dupak-container table td{border:1px solid #000; padding-left: 5px;}
		.pl20{padding-left: 20px;}
		container, footer {font-size: 0.7em;}
		.page-break {
		    page-break-after: always;
		}
	</style>
</head>
<body>
	<header>
		@include('admin.laporan.header')
	</header>

	<container>
		<!-- container element -->
		
	</container>

	<footer>
		<!-- footer element -->
	</footer>

	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<div id="header-surat" class="text-center"> 
			<h3>{{ strtoupper( __('penetapan angka kredit jabatan fungsional auditor') )}}</h3>
			<span>Nomor : 860/____/438.4/2019</span>
			<h6>{{ strtoupper( __('Masa Penilaian tanggal :_______ s.d ______ ').date('Y') ) }}</h6>
		</div>
		<div id="personal-info">
			<table width="100%">
				<tr bgcolor="#b3b3b3">
					<th class="text-center" colspan="3" align="center"> {{ strtoupper( __('keterangan perorangan') ) }}</th>
				</tr>
				<tr>
					<td width="5%">1</td>
					<td width="45%">Nama</td>
					<td width="50%">{{ $user->full_name }} {{$user->gelar}}</td>
				</tr>
				<tr>
					<td>2</td>
					<td>NIP / Nomor Seri Karpeg</td>
					<td>{{ $user->nip }}</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Tempat dan Tanggal lahir</td>
					<td>{{ $user->tempat_tanggal_lahir }}</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Jenis Kelamin</td>
					<td>{{ $user->sex }}</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Pendidikan Tertinggi</td>
					<td>{{ $user->pendidikan['tingkat'] }}</td>
				</tr>
				<tr>
					<td>6</td>
					<td>Pangkat/Gol. Ruang/TMT</td>
					<td>{{ $user->pangkat }}</td>
				</tr>
				<tr>
					<td>7</td>
					<td>Jabatan Auditor/TMT</td>
					<td>{{ $user->jabatan }}</td>
				</tr>
				<tr>
					<td>8</td>
					<td>Unit Kerja</td>
					<td>{{ __('Inspektorat Daerah Kabupaten Sidoarjo') }}</td>
				</tr>
			</table>
		</div>

		<div id="dupak-container">
			<table width="100%">
				<tr bgcolor="#b3b3b3">
					<th colspan="6" align="center">PENETAPAN ANGKA KREDIT</th>
				</tr>
				<tr bgcolor="#b3b3b3">
					<th width="5%">No.</th>
					<th width="30%">Uraian</th>
					<th width="15%">Lama</th>
					<th width="15%">Baru</th>
					<th width="15%">Jumlah</th>
					<th width="20%">Angka Kredit Untuk Kenaikan Jabatan/Pangkat</th>
				</tr>
				<tr bgcolor="#b3b3b3">
					<td align="center">1</td>
					<td align="center">2</td>
					<td align="center">3</td>
					<td align="center">4</td>
					<td align="center">5</td>
					<td align="center">6</td>
				</tr>
				<tr>
					<td align="center">I.</td>
					<td>Pendidikan Sekolah</td>
					<td>{{ $dupak_pendidikan }}</td>
					<td>0</td>
					<td>{{ $dupak_pendidikan }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center">II.</td>
					<td>Angka Kredit Penjenjangan</td>
					<td>{{ __('-') }}</td>
					<td>{{__('-')}}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center">A.</td>
					<td>Unsur Utama</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center"></td>
					<td class="pl20">1. Pendidikan</td>
					<td>{{ __('-') }}</td>
					<td>{{__('-')}}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center"></td>
					<td>2. Pengawasan</td>
					<td>{{ $dupak_pengawasan_lama }}</td>
					<td>{{ $dupak_pengawasan_baru }}</td>
					<td>{{ $dupak_pengawasan_lama + $dupak_pengawasan_baru }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center"></td>
					<td class="pl20">3. Pengembangan Profesi</td>
					<td>{{ __('-') }}</td>
					<td>{{__('-')}}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td align="center">A.</td>
					<td>Unsur Penunjang</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
					<td>{{ __('-') }}</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td align="right"><strong>Jumlah AK Penjenjangan</strong></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<tr>
					<td></td>
					<td align="right"><strong>Jumlah ( I+II )</strong></td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
				</tr>
				<tr>
					<td colspan="6">
						Tidak dapat dipertimbangkan untuk dinaikkan dalam : <br/>
						Jabatan<span style="letter-spacing: 3em">&nbsp;</span>: - <br/>
						Pangkat/Gol<span style="letter-spacing: 2em">&nbsp;</span>:<br/>
						Pengembangan profesi selama dalam pangkat<span style="letter-spacing: 2em">&nbsp;</span>:
					</td>
				</tr>
			</table>
		</div>
		<div id="ttd-inspektur">
			<table width="100%">
				<tr>
					<td width="50%"></td>
					<td width="50%" align="center">
						Ditetapkan di : <br />
						Pada tanggal  : <br />
						Sekretaris Daerah Kabupaten Sidoarjo<br />
						selaku<br />
						Pejabat Yang Berwenang Menetapkan Angka Kredit,<br />
						<br /><br /><br />
						<u>Drs. ACHMAD ZAINI, MM</u><br />
						Pembina Utama Madya<br />
						NIP. 19640131 199103 1 002
					</td>
				</tr>
			</table>
		</div>

	</container>

	<footer>
		<div id="notes">
			<strong>Asli</strong> disampaikan dengan hormat kepada :<br/>
			Kepala BKN u.p Deputi Bidang Informasi Kepegawaian<br/>
			Tembusan Yth. :<br/>
			1. Auditor yang bersangkutan <br/>
			2. Pimpinan unit kerja yang bersangkutan <br/>
			3. Kepala Badan Kepegawaian Daerah Kabupaten Sidoarjo<br/>
			4. Kepala Pusat Pembinaan Jabatan Fungsional Auditor<br/>
			5. Kepala BPKP Perwakilan Jawa Timur<br/>
			6. Kepala Kantor Regional II BKN di Waru Sidoarjo<br/>
			7. Sekretaris Tim Penilai Angka Kredit Auditor<br/>
			8. Arsip
		</div>
	</footer>
	<div class="page-break"></div>
	@include('admin.laporan.dupak.detail')
	
</body>
</html>