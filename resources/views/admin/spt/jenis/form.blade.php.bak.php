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
				<input type="hidden" name="id" id="id">
		        @csrf
				<div class="form-group row">
		            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Nama') }}</label>
		            <div class="col-md-6">
		                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus placeholder="Pemeriksaan Reguler">

		                @error('name')
		                    <span class="invalid-feedback alert alert-warning" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		                <small id="nameHelp" class="form-text text-muted"><span style="color:red;">Jangan</span> gunakan singkatan untuk nama jenis SPT seperti renja, riktu, monev, dan singkatan lainnya.</small>
		            </div>
		        </div>

		        <div class="form-group row">
		            <label for="dasar" class="col-md-2 col-form-label text-md-right">{{ __('Dasar') }}</label>
		            <div class="col-md-8">
		                 <textarea rows="5" id="dasar" class="summernote form-control form-control-alternative @error('dasar') is-invalid @enderror" name="dasar" ></textarea>
		            </div>
		        </div>
		        
		        <div class="form-group row">
		            <label for="isi" class="col-md-2 col-form-label text-md-right">{{ __('Isi') }}</label>
		            <div class="col-md-8">
		                 <textarea rows="5" id="isi" class="summernote form-control form-control-alternative @error('isi') is-invalid @enderror" name="isi" ></textarea>
		            </div>
		        </div>

		        <!-- Kategori SPT masuk ke unsur utama : pendidikan, pengawasan, pengembangan profesi -->
		        <fieldset class="form-group">
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
				</fieldset>
				
			    <fieldset class="form-group">			    	
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
				</fieldset>
				

		        <div class="form-group">
		        	<div class="col-md-8">
		            	<button type="submit" class="btn btn-primary offset-md-3">
		                    {{ __('Submit') }}
		                </button>
		            </div>
		        </div>
			</form>
		</div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('.summernote').summernote({
		height: 300,
		tabsize: 2
	});
</script>