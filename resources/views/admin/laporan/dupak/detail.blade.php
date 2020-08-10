	<container>
		<div id="header-surat" class="text-center"> 
			<h3>{{ strtoupper( __('laporan angka kredit') )}}</h3>
			<h6>{{ strtoupper( __('Masa Penilaian tanggal :_______ s.d ______ ').date('Y') ) }}</h6>
		</div>
		<div>
			<table width="50%" border="0">
				<tr>
					<td width="45%">Nama</td>
					<td width="50%">: {{ $user->full_name }} {{$user->gelar}}</td>
				</tr>
				<tr>
					<td>NIP / Nomor Seri Karpeg</td>
					<td>: {{ $user->nip }}</td>
				</tr>
				<tr>
					<td>Pendidikan Terakhir</td>
					<td>: {{ $user->pendidikan['tingkat'] }}</td>
				</tr>
				<tr>
					<td>Pangkat/Gol. Ruang/TMT</td>
					<td>: {{ $user->pangkat }}</td>
				</tr>
				<tr>
					<td>Jabatan </td>
					<td>: {{ $user->jabatan }}</td>
				</tr>
				<tr>
					<td>Unit Kerja</td>
					<td>: {{ __('Inspektorat Daerah Kabupaten Sidoarjo') }}</td>
				</tr>
			</table>
		</div>

		<div id="dupak-container">
			<table width="100%">
				<tr bgcolor="#b3b3b3" align="center">
					<th width="5%" rowspan="2">No.</th>
					<th width="30%" rowspan="2">Uraian Sub Unsur</th>
					<th width="15%" colspan="2">Jumlah angka kredit</th>
					<th width="15%" colspan="2">Jumlah hari</th>
					<th width="15%" rowspan="2">Perbedaan</th>
					<th width="20%" rowspan="2">Ket. Perbedaan</th>
				</tr>
				<tr bgcolor="#b3b3b3">					
					<td align="center">Diusulkan</td>
					<td align="center">Disetujui</td>
					<td align="center">Diusulkan</td>
					<td align="center">Disetujui</td>
				</tr>
				<tr bgcolor="#b3b3b3">
					<td align="center">1</td>
					<td align="center">2</td>
					<td align="center">3</td>
					<td align="center">4</td>
					<td align="center">5</td>
					<td align="center">6</td>
					<td align="center">7</td>
					<td align="center">8</td>
				</tr>
				<tr>
					<td>I</td>
					<td>PENDIDIKAN SEKOLAH</td>
					<td align="center">{{ $dupak_pendidikan }}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>II.</td>
					<td>ANGKA KREDIT PENJENJANGAN</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>  A.</td>
					<td>Unsur Utama</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>2. Pengawasan</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@php
				$i =1;
				@endphp
				@foreach($dupak_pengawasan_spt as $dupak_pengawasan)
				<tr>
					<td></td>
					<td>&nbsp;&nbsp;{{$i .' '. $dupak_pengawasan->spt->name}}</td>
					<td align="center">{{$dupak_pengawasan->dupak}}</td>
					<td></td>
					<td align="center">{{$dupak_pengawasan->lama}}</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@php
				$i++
				@endphp
				@endforeach
			</table>
		</div>
		<div id="pengesahan">
			<table width="100%">
				<tr>					
					<td width="30%" align="center">
						Sidoarjo, ___________ {{date('Y')}}<br />
						<br /><br /><br />
						<u>{{ $user->full_name }} {{$user->gelar}}</u><br />
						{{ $user->jabatan }}<br />
						NIP. {{ $user->nip }}
					</td>
					<td width="40%" align="center">
						Diperiksa<br />
						<br /><br /><br />
						<u>Dra. Laely Widjajati, M.Si</u><br />
						Pembina Utama Muda<br />
						NIP. 19681102199031003
					</td>
					<td width="30%" align="center">
						Direview<br />
						<br /><br /><br />
						<u>Andjar Surjadianto, S.Sos</u><br />
						Pembina Tk.I (IV/b)<br />
						NIP. 19700926 199003 1 005
					</td>
				</tr>
			</table>
		</div>

	</container>

	<footer>
		
	</footer>