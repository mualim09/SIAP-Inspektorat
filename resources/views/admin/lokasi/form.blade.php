<!-- <div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formModal">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
    	<div class="d-flex justify-content-end">
			
        </div>
    	<div class="modal-header">
    		<h2>Form Input Lokasi</h2>
    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close">
		        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
		        	<span class="btn-inner--text">{{ __('Close') }}</span>
		        </button>
    	</div>
		<div class="modal-body"> -->
			<form id="lokasi-form" class="ajax-form needs-validation" novalidate>
				<input type="hidden" name="id" id="id">
		        @csrf
				<div class="form-group row">
		            <label for="lokasi" class="col-lg-4 col-form-label text-md-right">{{ __('Lokasi') }}</label>
		            <div class="col-md-8">
		                <input id="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" required autofocus>

		                @error('lokasi')
		                    <span class="invalid-feedback alert alert-warning" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		                <small class="form-text text-muted" style="">Inputan objek pemeriksaan beserta singkatan <br/><span style="font-weight: bold">(Badan Kepegawaian Daerah (BKD), Desa Jati, Kelurahan Sukodono)</span></small>
		            </div>
		        </div>
		        <div class="form-group row">
		            <label for="sebutan_pimpinan" class="col-lg-4 col-form-label text-md-right">{{ __('Sebutan Pimpinan') }}</label>
		            <div class="col-md-7">
		                <input id="sebutan_pimpinan" type="text" class="form-control @error('sebutan_pimpinan') is-invalid @enderror" name="sebutan_pimpinan" required autofocus>

		                @error('sebutan_pimpinan')
		                    <span class="invalid-feedback alert alert-warning" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		            </div>
		        </div>

		        <div class="form-group row">
					<label for="kecamatan_spt_id" class="col-lg-4 col-form-label text-md-right">{{ __('Kecamatan') }} </label>
		        	<div class="col-md-7">
					    <select class="form-control selectize" id="pangkat" name="kecamatan" placeholder="Cari Jenis SPT">
		                    <option value="">{{ __('Pilih Kecamatan') }}</option>
							<option class="form-control" value="Kecamatan Sidoarjo" >Kecamatan Sidoarjo</option>
							<option class="form-control" value="Kecamatan Candi" >Kecamatan Candi</option>
							<option class="form-control" value="Kecamatan Buduran" >Kecamatan Buduran</option>
							<option class="form-control" value="Kecamatan Gedangan" >Kecamatan Gedangan</option>
							<option class="form-control" value="Kecamatan Sedati" >Kecamatan Sedati</option>
							<option class="form-control" value="Kecamatan Waru" >Kecamatan Waru</option>
							<option class="form-control" value="Kecamatan Taman" >Kecamatan Taman</option>
							<option class="form-control" value="Kecamatan Krian" >Kecamatan Krian</option>
							<option class="form-control" value="Kecamatan Wonoayu" >Kecamatan Wonoayu</option>
							<option class="form-control" value="Kecamatan Balongbendo" >Kecamatan Balongbendo</option>
							<option class="form-control" value="Kecamatan Tarik" >Kecamatan Tarik</option>
							<option class="form-control" value="Kecamatan Tulangan" >Kecamatan Tulangan</option>
							<option class="form-control" value="Kecamatan Prambon" >Kecamatan Prambon</option>
							<option class="form-control" value="Kecamatan Krembung" >Kecamatan Krembung</option>
							<option class="form-control" value="Kecamatan Tanggulangin" >Kecamatan Tanggulangin</option>
							<option class="form-control" value="Kecamatan Sukodono" >Kecamatan Sukodono</option>
							<option class="form-control" value="Kecamatan Jabon" >Kecamatan Jabon</option>
							<option class="form-control" value="Kecamatan Porong" >Kecamatan Porong</option>
	                	</select>           
				</div>
				
			    <fieldset class="form-group">			    	
			    	<div class="row">
				    	<legend class="col-lg-4 text-md-right col-form-label pt-0">{{ __('Ketegori Lokasi') }}</legend>
				        <div class="col-md-7 row ml-1">
					        <div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-1" type="radio" checked="" value="OPD">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-1">OPD</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-2" type="radio" value="Desa">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-2">Desa</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-6" type="radio" value="Kelurahan">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-6">Kelurahan</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-7" type="radio" value="Kecamatan">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-7">Kecamatan</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-3" type="radio" value="LUD">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-3">LUD</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-4" type="radio" value="UPTD">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-4">UPTD</label>
							</div>
							<div class="custom-control custom-radio mb-3">
							  <input name="kateg_lokasi" class="custom-control-input" id="kateg_lokasi-5" type="radio" value="Sekolah">
							  <label class="custom-control-label mr-3" for="kateg_lokasi-5">Sekolah</label>
							</div>					        
						</div>
					</div>
				</fieldset>
				

		        <div class="form-group">
		        	<div class="col-md-9">
		            	<button type="submit" class="btn btn-primary offset-md-8">
		                    {{ __('Submit') }}
		                </button>
		            </div>
		        </div>
			</form>
		<!-- </div>
    </div>
  </div>
</div> -->
<script type="text/javascript">
	$('#pangkat').selectize({    
	   /*sortField: 'text',*/
	   allowEmptyOption: false,
	   placeholder: 'Pangkat Pegawai',
	   create: false,
	   onchange: function(value){
	    
	   },
	});

</script>

@push('css')
   <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
@endpush

