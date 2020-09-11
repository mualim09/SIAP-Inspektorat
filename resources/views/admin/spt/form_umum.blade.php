<!-- start form pengajuan spt umum -->
<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formSptUmumLabel" aria-hidden="true" id="formSptUmum" data-backdrop="static" data-keyboard="false" style="z-index: 1500;">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
    		<div class="modal-header">
	    		<h3>{{ __('Pengajuan SPT Bagian Umum') }}</h3>
	    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-spt-form">
		        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
		        	<span class="btn-inner--text">{{ __('Close') }}</span>
		        </button>
	    	</div>
	    	<div class="modal-body">
	    		<form id="spt-umum-form">
	    			<input type="hidden" name="id" id="id">
					@csrf
					<div class="form-group row">		            
					    <label for="tgl-mulai" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
					    <div class="col-md-4">			            
							<input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl-mulai-umum" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">
						</div>
						<label for="tgl-akhir" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
					    <div class="col-md-4">
							<input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl-akhir-umum" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
						</div>
						<script type="text/javascript">							
						    $("#tgl-mulai-umum").on('changeDate', function(selected) {
						        var startDate = new Date(selected.date.valueOf());
						        $("#tgl-akhir-umum").datepicker('setStartDate', startDate);
						        $('#tgl-akhir-umum').prop('disabled',false);
						        $('#tgl-akhir-umum').focus();
						    });
							
							$('#tgl-akhir-umum').on('changeDate', function(){
								var start = $("#tgl-mulai-umum").val();
								var end = $("#tgl-akhir-umum").val();
								url = "{{route('durasi_spt')}}"//'admin/spt/durasi/' +start+'/'+end;
			                        $.ajax({
			                            url: url,
			                            type: "GET",
			                            //dataType: 'JSON',
			                            data: {start:start, end:end},
			                            success: function(data){
			                                console.log(data);
			                                $('#lama-spt-umum').val(data);
			                            },
			                            error: function(response, status, error){
			                            	//console.log(response);
			                            }
			                        });
							});
						</script>
					</div>
					<div class="form-group row">		            
					    <label for="lama-spt-umum" class="col-md-2 col-form-label">{{ __('Lama') }}</label>
					    <div class="col-md-4">			            
							<input type="text" class="form-control" name="lama" id="lama-spt-umum" autocomplete="off" placeholder="{{ __('Lama')}}">						    
						</div>					
					</div>
					<div class="form-group row" id="input-anggota" >
					    <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
						<div class="col">
							<table id="list-anggota-session" class="col"></table>
							<button id="add-anggota" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaSptModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
						</div>
					</div>
	    		</form>
	    	</div>
    	</div>
    </div>
</div>
<!-- end form pengajuan spt umum -->