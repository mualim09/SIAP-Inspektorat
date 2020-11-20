<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="anggotaSptUmumModal" data-backdrop="static" data-keyboard="true" style="z-index: 2000;">
	<div class="modal-lg modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Anggota SPT</h3>
				<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-anggota-spt-umum">
		        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
		        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        	</button>
	        	<script type="text/javascript">
					$('#close-anggota-spt-umum').on('click', function(){
						if ( typeof $('#anggotaSptUmumModal').attr('id-spt-umum-anggota') !== 'undefined' ){
							$('#anggotaSptUmumModal').removeAttr('id-spt-umum-anggota');
						}
					})
				</script>
			</div>
			<div class="modal-body">
				
				<form  id="new-anggota-spt-form-umum" class="ajax-form needs-validation" novalidate>
					<input type="hidden" name="spt_id_umum" id="spt-id-umum-anggota">
			        @csrf
			        <div class="form-group row">
			        	<label for="anggota" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
			        	<!-- <label for="anggota" class="col-md-2 col-form-label">{{ $listAnggota }} </label> -->
			        	<div class="col-md-4">
			        		<select class="form-control selectize" id="session-anggota-umum" name="session_anggota_umum">
			        			<option value="">{{ __('Anggota SPT') }}</option>
			        			@foreach($listAnggota as $anggota)
			        			<option class="form-control selectize" value="{{$anggota->id}}" >{{ $anggota->full_name_gelar }}</option>
			        			@endforeach
			        		</select>
			        	</div>
			        	<script type="text/javascript">
			        		/*var select_anggota_umum = $('#session-anggota-umum').selectize({	   
							   persist: false,
							   sortField: 'text',
							   allowEmptyOption: false,
							   placeholder: 'Anggota SPT',	  
						  	});*/
			        	</script>
			        	<div class="col-md-3">
			        		<div class="md-form input-group mb-3">
						      <input type="text" class="form-control" name="lama_jam" id="lama-jam-id" autocomplete="off" placeholder="{{ __('Lama jam')}}">
						      <div class="input-group-prepend">
						        <span class="input-group-text md-addon">/jam</span>
						      </div>
						    </div>
			        		<!-- <input type="text" class="form-control" name="lama_jam" id="lama-jam-id" autocomplete="off" placeholder="{{ __('Lama jam')}}"> -->
			        	</div>
			        	<div class="col-md-3">
			        		<input type="text" class="form-control" name="nilai_dupak" id="dupak-id" autocomplete="off" placeholder="{{ __('Dupak')}}">
			        	</div>
			        <small class="form-text text-muted">Inputkan Nama, Nilai Dupak, dan total jam 1(satu) per 1(satu) dari tiap - tiap anggota yang dipilih!</small>
			        </div>
			        
			        <div class="form-group">
			        	<div class="col-md-6">
			            	<button type="submit" class="btn btn-primary offset-md-4">
			                    {{ __('Submit') }}
			                </button>
			            </div>
			        </div>
				</form>
				
				<script type="text/javascript">
					$("#new-anggota-spt-form-umum").validate({
		            rules: {
		                session_anggota_umum: {required: true, number:true},
		                //session_peran: {required: true}
		                session_peran : {
		                	required: true,
		                	normalizer: function( value ) {
					        	var regex = /^[a-zA-Z]+$/;
					        	if(regex.test(value) == false){
					        		alert("Must be in alphabets only");
					        		return false;
					        	}
					    	}
						}
		            },
		            submitHandler: function(form){
		            	var tgl_mulai = $('#spt-umum-form').find('#tgl-mulai-umum').val();
		            	var tgl_akhir = $('#spt-umum-form').find('#tgl-akhir-umum').val();
		            	var lama_jam = $('#new-anggota-spt-form-umum').find('#lama-jam-id').val();
		            	var dupak_anggota = $('#new-anggota-spt-form-umum').find('#dupak-id').val();
		                var user_id = $('#session-anggota-umum option:selected').val();
		                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		                //var spt_id = $('#spt-umum-form').find('#id-umum').val();
		                //break save_method_umum;
		                if ( typeof $('#anggotaSptUmumModal').attr('id-spt-umum-anggota') !== 'undefined' ){
		                    id_spt = $('#anggotaSptUmumModal').attr('id-spt-umum-anggota');
		                    url =  "{{ route('store_detail_anggota_umum') }}";
		                }else{
		                    id_spt = '';
		                    url = "{{ route('store_session_anggota_umum') }}";
		                }

		                //url = (save_method_umum == 'new') ?  "{{ route('store_session_anggota_umum') }}" : "{{ route('store_detail_anggota_umum') }}";
		                //$.alert(save_method_umum);
		                if(tgl_mulai == '' || tgl_akhir==''){
		                	$.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
		                }else{
		                	 //alert(url);
		                	$.ajax({
			                    url: url,
			                    type: 'post',
			                    data: {_token: CSRF_TOKEN, user_id:user_id, spt_id:id_spt, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir, lama_jam:lama_jam, dupak_anggota:dupak_anggota},
			                    success: function(data){		                        		                        
			                        //$('#list-anggota-umum-session').DataTable().ajax.reload();
			                        drawTableAnggotaUmum(id_spt);
			                        /*$("#lama-jam-id").val('');
			                        $("#dupak-id").val('');*/
			                        clearOptionsUmum();
			                    },
			                    error: function(error){
			                        console.log('Error :', error);
			                    }
			                });
		                }
		            }
		        });

				</script>
			</div>
		</div>
	</div>
</div>