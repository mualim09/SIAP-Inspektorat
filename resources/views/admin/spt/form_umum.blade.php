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
	    			<input type="hidden" name="jenis_spt_id" id="jenis-spt-id">
					@csrf

					<!-- jenis spt bag umum -->
					<div class="form-group row">
						<label for="dasar" class="col-md-2 col-form-label ">{{ __('Jenis Spt') }}</label>
						<div class="col-md-10">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT1" name="jenis_laporan" value="SPT1" onclick="showresponddiv(this.id)">
		                        <label class="custom-control-label" for="jenis-spt-umum-SPT1">SPT Umum</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT2" name="jenis_laporan" value="SPT2" onclick="showresponddiv(this.id)">
		                        <label class="custom-control-label" for="jenis-spt-umum-SPT2">SPT Workshop</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT3" name="jenis_laporan" value="SPT3" onclick="showresponddiv(this.id)">
		                    	<label class="custom-control-label" for="jenis-spt-umum-SPT3">SPT Diklat</label>
		                	</div>
		                	<small id="infoDasarHelp" class="form-text text-muted">Silahkan pilih Jenis Spt yang akan dibuat.</small>
		                </div>
	                </div>

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

<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="anggotaSptUmumModal" data-backdrop="static" data-keyboard="true" style="z-index: 2000;">
	<div class="modal-lg modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Anggota SPT</h3>
				<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-anggota">
		        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
		        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        	</button>
			</div>
			<div class="modal-body">
				@if(Auth::user()->can(['Create SPT', 'Edit SPT']))
				<form  id="new-anggota-spt-form-umum" class="ajax-form needs-validation" novalidate>
					<input type="hidden" name="spt_id" id="spt-id">
			        @csrf
			        <div class="form-group row">
			        	<label for="anggota" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
			        	<div class="col-md-8">
			        		<select class="form-control selectize" id="session-anggota-umum" name="session_anggota_umum">
			        			<option value="">{{ __('Anggota SPT') }}</option>
			        			@foreach($listAnggota as $anggota)
			        			<option class="form-control selectize" value="{{$anggota->id}}" >{{ $anggota->full_name . $anggota->gelar }}</option>
			        			@endforeach
			        		</select>
			        	</div>
			        	<!-- <div class="col-md-4">
			        		<select class="form-control selectize" id="session-peran" name="session_peran">
			        			<option value="">{{ __('Peran SPT') }}</option>
			        			@foreach($listPeran as $peran)
			        			<option class="form-control" value="{{$peran}}" >{{ $peran }}</option>
			        			@endforeach
			        		</select>
			        	</div> -->
			        	<!-- <div class="col-md-2">
			        		<input type="number" name="lama" id="lama" class="form-control" placeholder="Lama">
			        	</div> -->
			        </div>
			        
			        <div class="form-group">
			        	<div class="col-md-6">
			            	<button type="submit" class="btn btn-primary offset-md-4">
			                    {{ __('Submit') }}
			                </button>
			            </div>
			        </div>
				</form>
				@endif

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
		                var user_id = $('#session-anggota-umum option:selected').val();
		                var spt_id = $('#spt-umum-form').find('#id').val();
		                // console.log(tgl_mulai);
		                // console.log(tgl_akhir);
		                // console.log(user_id);
		                // console.log(spt_id);
		                // console.log(spt_id !== '');
		                url = (spt_id !== '') ? "{{ route('store_detail_anggota_umum') }}" : "{{ route('store_session_anggota_umum') }}" ;
		                if(tgl_mulai == '' || tgl_akhir==''){
		                	$.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
		                }else{
		                	// alert(url);
		                	$.ajax({
			                    url: url,
			                    type: 'post',
			                    data: {user_id:user_id, spt_id:spt_id, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir},
			                    success: function(data){		                        		                        
			                        $('#list-anggota-umum-session').DataTable().ajax.reload();
			                        clearOptions();
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


<!-- end form pengajuan spt umum -->
<script type="text/javascript">
		$( "#formSptUmum" ).on('shown.bs.modal', function(){

			var id_spt = $('#id').val();
			var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/get-anggota/umum/' : 'spt/get-anggota/umum/';
			url = (id_spt != '') ? url_prefix+id_spt : url_prefix+'0';

			$('#list-anggota-umum-session').DataTable({        
			    "language": {
			        "emptyTable":  "Data Anggota Belum dimasukkan"
			    },
			    dom: 'rt',
			    "pageLength": 50,
			    fixedColumns:   {
			        heightMatch: 'auto'
			    },
			    language: {
			        paginate: {
			          next: '&gt;', 
			          previous: '&lt;' 
			        }
			    },
			    "opts": {
			      "theme": "bootstrap",
			    },
			    retrieve: true,
			    processing: true,
			    aDataSort:true,
			    serverSide: true,
			    ajax: url,
			    /*deferRender: true,*/
			    columns: [
			        {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '10%'
			        },
			        {data: 'nama_anggota', name: 'nama_anggota', 'title': "{{ __('Nama') }}", width: '40%'},
			        {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}", width: '40%'},
			        {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false, width: '10%'},
			    ],
			});
		});


		$('#formSptUmum').on('hidden.bs.modal', function () {
			// $('#spt-form')[0].reset();
			// $('#id').val('');
			// $('#tambahan').val('');
			// select_lokasi[0].selectize.clear();
			// save_method = null;
			$('#list-anggota-umum-session').DataTable().clear().destroy();
			// $('#input-tambahan-container').hide();
			// $('#input-lokasi-container').hide();
		});

		function clearOptions(){            
	        // var optPeran = $('#session-peran').selectize();
	        var optAnggota = $('#session-anggota-umum').selectize();            
	        var controlPeran = optPeran[0].selectize;
	        var controlAnggota = optAnggota[0].selectize;
	        controlPeran.clear();
	        controlAnggota.clear();
	    }
		var current = null;
	    function showresponddiv(messagedivid){
	        var id = messagedivid.replace("jenis-spt-umum-", ""),
	            div = document.getElementById(id);
	        // console.log(id);
	        $('#jenis-spt-id[type=hidden]').attr('value',id);
	    }

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