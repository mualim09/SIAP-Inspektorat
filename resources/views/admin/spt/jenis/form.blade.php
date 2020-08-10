<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formModal">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
    	<div class="d-flex justify-content-end">
			
        </div>
    	<div class="modal-header">
    		<h3>Form Jenis SPT</h3>
    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close">
	        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
	        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        </button>
    	</div>
		<div class="modal-body">
			<form id="jenis-spt-form" class="ajax-form needs-validation" novalidate>
			<!-- <div class="row">
				<div class="col-md-10 row">
					<h3>Form Jenis SPT</h3>
				</div>
				<div class="col text-md-right">
					<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close">
			        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
			        	<span class="btn-inner--text">{{ __('Close') }}</span>
			        </button>
				</div>
			</div> -->
			<div class="form-group row">
				<label for="sebutan" class="col-md-2 col-form-label text-md-right">{{ __('Sebutan') }}</label>
	            <div class="col-md-8">
	                 <input type="text" name="sebutan" id="sebutan" class="form-control">
	                 <small id="sebutanHelp" class="form-text text-muted">Inputan ini digunakan untuk memasukkan sebutan umum terkait SPT. contoh : Evaluasi RENJA, SAKIP, Kasus TGR, dan lain-lain.</small>
	            </div>
			</div>
			<hr>			
				<input type="hidden" name="id" id="id">
		        @csrf
				
				<div id="kop-surat">@include('admin.laporan.header')</div>

				<div class="container" id="nomor-surat">					
					<h3 class="col text-center"><u>SURAT PERINTAH TUGAS</u></h3>					
					<div class="col-md-5 align-center offset-md-4">
						Nomor : <input type="text" name="kode_kelompok" placeholder="kode" class="col-xm-2" style="width:60px" id="kode-kelompok">/<u>NOMOR</u>/438.4/{{ date('Y') }}
					</div>
				</div>

		        <div class="form-group row">
		            <label for="dasar" class="col-md-2 col-form-label text-md-right">{{ __('Dasar') }}</label>
		            <div class="col-md-8">
		                 <textarea rows="5" id="dasar" class="form-control form-control-alternative @error('dasar') is-invalid @enderror" name="dasar" ></textarea>
		                 <small id="dasarHelp" class="form-text text-muted">Masukkan dasar-dasar jenis SPT. tekan<span style="color:red;">ENTER</span> untuk ganti baris.</small>
		            </div>
		        </div>
		        <div class="container">
		        	<h4 class="col text-center "><u>DITUGASKAN</u></h4>
		        </div>
		        <div class="row">
		            <div class="col-md-2 text-md-right">{{ __('Kepada :') }}</div>
		            <div class="col-md-8">
		            	<figure class="highlight text-center align-middle pt-md-3 pb-md-3" style="background:rgba(0, 0, 0, .05);">AREA INI BERISI ANGGOTA SPT, DAN DIINPUTKAN WAKTU PEMBUATAN SPT</figure>
		            </div>
		            
		        </div>		        

		        <div class="col-md-8 offset-md-2">
		        	<div>Untuk melaksanakan <input type="text" name="name" placeholder="Nama aktual Jenis SPT yang ditampilkan dalam lembar SPT" style="width:500px;" id="name"> Kabupaten Sidoarjo.</div>
		        </div>

		        <hr>
		        <div class="col-md-12"><p>Dibawah ini untuk menambahkan input lokasi jika diperlukan lokasi dalam pengajuan SPT dan input tambahan lainnya jika SPT yang diajukan membutuhkan informasi tambahan.</p></div>
		        <fieldset class="form-group">
			    	<div class="row">
				    	<legend class="col-md-2 text-md-right col-form-label pt-0">{{ __('Lokasi') }}</legend>
				        <div class="col-md-8 row ml-1">
					        <div class="custom-control custom-radio mb-3">
							  <input name="input[lokasi]" class="custom-control-input" id="lokasi-yes" type="radio" value="1">
							  <label class="custom-control-label mr-3" for="lokasi-yes">Ya</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="input[lokasi]" class="custom-control-input" id="lokasi-no" type="radio" value="0" >
							  <label class="custom-control-label mr-3" for="lokasi-no">Tidak</label>
							</div>  
						</div>
					</div>
				</fieldset>

				<fieldset class="form-group">
			    	<div class="row">
				    	<legend class="col-md-2 text-md-right col-form-label pt-0">{{ __('Tambahan') }}</legend>
				        <div class="col-md-8 row ml-1">
					        <div class="custom-control custom-radio mb-3">
							  <input name="input[tambahan]" class="custom-control-input" id="input-yes" type="radio" value="1">
							  <label class="custom-control-label mr-3" for="input-yes">Ya</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="input[tambahan]" class="custom-control-input" id="input-no" type="radio" value="0" >
							  <label class="custom-control-label mr-3" for="input-no">Tidak</label>
							</div>
							<small id="inputHelp" class="form-text text-muted">Pilih <span style="color:red;">Ya</span> untuk menampilkan inputan tambahan saat melakukan pengajuan SPT, dan <span style="color:red;">Tidak</span> jika tidak ada tambahan inputan.</small>
						</div>
					</div>
				</fieldset>

				<fieldset class="form-group">
			    	<div class="row">
				    	<legend class="col-md-2 text-md-right col-form-label pt-0">{{ __('Radio') }}</legend>
				        <div class="col-md-8 row ml-1">
					        <div class="custom-control custom-radio mb-3">
							  <input name="radio_input" class="custom-control-input" id="radio-yes" type="radio" value="1">
							  <label class="custom-control-label mr-3" for="radio-yes">Ya</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="radio_input" class="custom-control-input" id="radio-no" type="radio" value="0" >
							  <label class="custom-control-label mr-3" for="radio-no">Tidak</label>
							</div>
							<small id="inputHelp" class="form-text text-muted">Pilih <span style="color:red;">Ya</span> untuk menampilkan pilihan tambahan saat melakukan pengajuan SPT, dan <span style="color:red;">Tidak</span> jika tidak ada pilihan tambahan. Contoh : Izin melakukan cerai dan Surat keterangan cerai</small>
						</div>
					</div>
				</fieldset>

				<div class="col-md-8 offset-md-2" id="radio-tambahan" style="display: none;">
					@for($i=1;$i<=2;$i++)
					<div class="form-group row">
						<label for="radio[{{$i}}]" class="col-md-2 col-form-label text-md-right">{{ __('Radio #'.$i) }}</label>
						<input type="text" name="radio[{{$i}}]" class="col form-control" id="radio-{{$i}}">
					</div>
					@endfor
				</div>

				<div class="col-md-8 offset-md-2">
		        	<div>Kepada pihak-pihak yang bersangkutan diminta kesediaannya untuk memberikan bantuan serta keterangan-keterangan yang diperlukan guna kelancaran dalam penyelesaian tugas yang dimaksud.</div>
		        </div>

				<script type="text/javascript">
					$('input[name=radio_input]').change(function() {
					    if (this.value == '1') {
					        //tampilkan form input tambahan
					        $('#radio-tambahan').show();
					    }
					    else if (this.value == '0') {
					        //sembunyikan form input tambahan dan reset value ke empty
					        $('#radio-tambahan').hide();
					    }
					});
				</script>

		        <!-- Kategori SPT masuk ke unsur utama : pendidikan, pengawasan, pengembangan profesi -->
		        <!-- <fieldset class="form-group">
			    	<div class="row">
				    	<legend class="col-md-2 text-md-right col-form-label pt-0">{{ __('Kategori') }}</legend>
				        <div class="col-md-8 row ml-1">
					        <div class="custom-control custom-radio mb-3">
							  <input name="kategori" class="custom-control-input" id="kategori-pendidikan" type="radio" value="pendidikan">
							  <label class="custom-control-label mr-3" for="kategori-pendidikan">Pendidikan</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kategori" class="custom-control-input" id="kategori-pengawasan" type="radio" value="pengawasan" checked="" >
							  <label class="custom-control-label mr-3" for="kategori-pengawasan">Pengawasan</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kategori" class="custom-control-input" id="kategori-pengembangan" type="radio" value="pengembangan">
							  <label class="custom-control-label mr-3" for="kategori-pengembangan">Pengembangan Profesi</label>
							</div>				        
						</div>
					</div>
				</fieldset> -->
				
			    <!-- <fieldset class="form-group">			    	
			    	<div class="row">				    	
				        <label for="kode_kelompok" class="col-md-2 col-form-label text-md-right">{{ __('Kode') }}</label>
			            <div class="col-md-8">
			                <input id="kode-kelompok" type="text" class="form-control @error('kode_kelompok') is-invalid @enderror col-md-3" name="kode_kelompok" required autofocus placeholder="0000">

			                @error('kode_kelompok')
			                    <span class="invalid-feedback alert alert-warning" role="alert">
			                        <strong>{{ $message }}</strong>
			                    </span>
			                @enderror
			                <small id="kodeHelp" class="form-text text-muted">Kode untuk pengelompokan SPT sesuai kode dalam penomoran SPT</small>
			            </div>
					</div>
				</fieldset> -->
				

		        <div class="form-group">
		        	<div class="col-md-8">
		            	<button type="submit" class="btn btn-primary offset-md-3">
		                    {{ __('Simpan') }}
		                </button>
		            </div>
		        </div>
			</form>
		</div>
    </div>
  </div>
</div>
<!-- <script type="text/javascript">
	$('.summernote').summernote({
		height: 300,
		tabsize: 2
	});
</script> -->