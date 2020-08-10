<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    	
    	<div class="modal-header">
    		<h3>{{ __('Propose SPT') }}</h3>
    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close">
	        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
	        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        </button>
    	</div>
		<div class="modal-body">
			<form id="spt-form" class="ajax-form needs-validation" novalidate>
				<input type="hidden" name="id" id="id">
		        @csrf
		        <div class="form-group row">		        	
		        	<label for="name" class="col-md-2 col-form-label">{{ __('Nama SPT')}} </label>
		        	<div class="col-md-4">
		        		<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="{{ __('Nama SPT') }}" autofocus autocomplete="off">
		        	</div>
		        	<label for="jenis_spt_id" class="col-md-2 col-form-label">{{ __('Jenis SPT') }} </label>
		        	<div class="col-md-4">
		        		<select class="form-control select2" id="jenis-spt" name="jenis_spt_id" style="width:100%">
		        			@foreach($jenis_spt as $jenis)
		        			<option class="form-control select2" value="{{$jenis->id}}" >{{ $jenis->name }}</option>
		        			@endforeach
		        		</select>		        		
		        	</div>
		        </div>
		        
		        <div class="form-group row">		            
		            <label for="tgl-mulai" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
		            <div class="col-md-4">			            
						<input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl-mulai" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">						    
					</div>
					<label for="tgl-akhir" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
		            <div class="col-md-4">			            
						<input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl-akhir" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}">						    
					</div>
		        </div>

		        <div class="form-group row">
		            <label for="lokasi" class="col-md-2 col-form-label">{{ __('Lokasi') }}</label>
		            <div class="col">
		            	<textarea class="form-control" id="lokasi" name="lokasi"></textarea>
		            </div>		            
		        </div>
		       
		        
		        {{-- Anggota SPT --}}
		        <div class="card">
		        	<div class="card-header text-center">{{ __('Anggota Tim')}}</div>
			        <div class="card card-body duplicate-holder">
			        	<div class="form-group row">
				            <label for="anggota-spt" class="col-md-2 col-form-label">{{ __('Anggota') }}</label>
				            <div class="input-group col-form-input">
				            	<input type="text" class="form-control" name="nama_anggota" id="nama-anggota" placeholder="{{ __('Nama Anggota')}}" >
				            	<input type="text" class="form-control" name="peran_anggota" id="peran-anggota" placeholder="{{ __('Peran Anggota')}}" >
				            </div>		            
				        </div>
			        	{{--<textarea id="anggota" name="anggota" disabled="disabled"></textarea>--}}
			        </div>
			    </div>
		        <input type="hidden" name="hiddenAng" value="" id="hidden-ang">

		        <script type="text/javascript">
		        	var el = '<div class="form-group row duplicate"><label class="col-md-2 col-form-label" for="anggota[]">Nama</label><div class="col-md-4 col-form-input"><input type="text" name="anggota[]" class="form-control" id="input-anggota"></div><label for="peran[]" class="col-md-2 col-form-label">Peran</label><div class="col-md-4 col-form-input"><input type="text" name="peran[]" class="form-control" id="input-peran"></div></div>';	        	

		        	$('.clone').click(function(){
		        		$('.duplicate-holder').append(el);
		        	})
		        	$('.add').click(function(){
		        		var nama = $('#nama-anggota').val();
		        		var peran = $('#peran-anggota').val();
		        		var namaPeran = '{"nama":"'+nama+'","peran":"'+peran+'"},';
		        		/*$('#anggota').val(function(){
		        			return this.value+namaPeran;
		        		});*/
		        		$('#hidden-ang').val(function(){
		        			return this.value+namaPeran;
		        		});
		        		$('#nama-anggota').val('');
		        		$('#peran-anggota').val('');
		        	});
		        			        	
		        </script>
		        {{-- END Anggota SPT --}}

		       

		        <div class="form-group row">
		        	<div class="col">
		            	<button type="submit" class="btn btn-primary offset-md-3" >
		                    {{ __('Submit') }}
		                </button>
		                <button type="button" class="btn btn-outline-primary offset-md-1 clone"><i class="fa fa-plus"></i><span>{{__('Tambah Anggota')}}</span></button>		                
		            </div>
		        </div>
			</form>
		</div>
    </div>
  </div>
</div>


@push('css')
	<link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
	<script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
@endpush