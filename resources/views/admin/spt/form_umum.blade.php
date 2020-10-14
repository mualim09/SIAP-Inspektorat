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
	    			<input type="hidden" name="jenis_spt_id" id="jenis-spt-id" value="0">
					@csrf
					<!-- dasar spt bag umum -->
					<div class="form-group row">
			            <label for="dasar" class="col-md-2 col-form-label ">{{ __('Dasar') }}</label>
			            <div class="col-md-10">
			                 <textarea rows="5" id="info-dasar" class="form-control form-control-alternative @error('dasar') is-invalid @enderror" name="info_dasar" ></textarea>
			                 <small id="infoDasarHelp" class="form-text text-muted">Masukkan dasar-dasar jenis SPT. Tekan <span style="color:red;">ENTER</span> untuk ganti baris.</small>
			            </div>
			        </div>

			        <!-- tanggal spt -->
					<div class="form-group row">		            
					    <label for="tgl-mulai" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
					    <div class="col-md-4">			            
							<input type="text" class="form-control datepicker" name="tgl_mulai_umum" id="tgl-mulai-umum" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">
						</div>
						<label for="tgl-akhir" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
					    <div class="col-md-4">
							<input type="text" class="form-control datepicker" name="tgl_akhir_umum" id="tgl-akhir-umum" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
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
							<input type="text" class="form-control" name="lama_spt_umum" id="lama-spt-umum" autocomplete="off" placeholder="{{ __('Lama')}}">						    
						</div>					
					</div>
					<!-- anggota spt -->
					<div class="form-group row" id="input-anggota-umum" >
					    <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
						<div class="col">
							<table id="list-anggota-umum-session" class="col"></table>
							<button id="add-anggota-umum" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaSptUmumModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
						</div>
					</div>

					<!-- untuk melaksanakan -->
					<div class="form-group row">
			            <label for="dasar" class="col-md-2 col-form-label ">{{ __('Untuk') }}</label>
			            <div class="col-md-10">
			                 <textarea rows="5" id="info-kegiatan" class="form-control form-control-alternative @error('dasar') is-invalid @enderror" name="info_kegiatan" ></textarea>
			                 <small id="infoKegiatanHelp" class="form-text text-muted">Tujuan kegiatan terkait SPT.</small>
			            </div>
			        </div>

			        <!-- submit button -->
			        <div class="form-group">
						<div class="col">
					    	<button type="submit" class="btn btn-primary offset-md-2">
					            {{ __('Submit') }}
					        </button>
					    </div>
					</div>
	    		</form>
	    	</div>
    	</div>
    </div>
</div>
<!-- end form pengajuan spt umum -->
<script type="text/javascript">
	    $("#spt-umum-form").validate({
        rules: {
            jenis_spt_id : {required: true},
            tgl_mulai_umum: {required: true},
            tgl_akhir_umum: {required: true},
            info_dasar : {teks: true},
            info_kegiatan : {teks: true},

        },

        submitHandler: function(form){
            var jenis_spt_id = $('#jenis-spt-id').val();
            var tgl_mulai_umum = $('#tgl-mulai-umum').val();
            var tgl_akhir_umum = $('#tgl-akhir-umum').val();
            var lama = $('#lama-spt-umum').val();            
            var info_dasar = $('#tambahan').val();
            var info_kegiatan = ( typeof $('.info-lanjutan:checked').val() !== 'undefined' ) ? '"lanjutan":"'+$('.info-lanjutan:checked').val()+'"' : '"lanjutan":'+null;            
            var id = $('#id').val();
            save_method = (id == '') ? 'new' : save_method;
            var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/' : 'spt/';
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            url = (save_method == 'new') ? "{{ route('store_spt_umum') }}" : url_prefix + 'umum/edit/' +id ;
            method = (save_method == 'new') ? "POST" : "PUT";
            type = "POST";            
            

            $.ajax({
                url: url,
                type: type,
                data: {jenis_spt_id:jenis_spt_id, lokasi_id:lokasi_id, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, lama:lama, tambahan:tambahan, info:info, _method: method},
                //data: $('#spt-form').serialize(),
                //dataType: 'json',

                /*data: $('#spt-form').serialize(),*/
                success: function(data){
                    $("#spt-form")[0].reset();
                    $('#formModal').modal('hide');
                    if(save_method == 'new') clearSessionAnggota();
                    //table.ajax.reload();
                    $('#penomoran-spt').DataTable().ajax.reload(null, false );
                },
                error: function(error){
                    err_list = '';
                    $.each(error.responseJSON, function(i,v){
                        //console.log(v);
                        if(i == 'errors'){
                            $.each(v, function(a,b){
                                //err_arr.push([a.charAt(0).toUpperCase() + a.slice(1)+' '+b.toString().replace('validation.','')+'\n']);
                                err_list += '<li style="text-align:left;">'+a.charAt(0).toUpperCase() + a.slice(1)+' '+b.toString().replace('validation.','')+'</li>';
                            });
                        }
                    });
                    console.log(error);
                    $.alert({
                        content: '<ul id="error-list">'+err_list+'</ul>' , 
                        title: 'Error!',
                        theme: 'modern',
                        type: 'red'
                    });
                    /*$('.ajax-form')[0].reset();*/
                    /*table.ajax.reload();*/
                }
            });
        }
    });
</script>