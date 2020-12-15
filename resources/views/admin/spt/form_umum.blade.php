<!-- start form pengajuan spt umum -->
<!-- <div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formSptUmumLabel" aria-hidden="true" id="formSptUmum" data-backdrop="static" data-keyboard="false" style="z-index: 1500;"> -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalSptUmum" aria-hidden="true" id="formSptUmum">
	<div class="modal-dialog modal-xl" style="max-width: 85%;">
    	<div class="modal-content">
    		<div class="modal-header">
	    		<h3>{{ __('Pengajuan SPT Bagian Umum') }}</h3>

	    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-spt-umum-form">
		        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
		        	<span class="btn-inner--text">{{ __('Close') }}</span>
		        </button>
		        <script type="text/javascript">
					$('#close-spt-umum-form').on('click', function(){
						if ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ){
							$('#formSptUmum').removeAttr('data-id-spt-umum');
						}
					})
				</script>
	    	</div>
	    	<div class="modal-body">
	    		<form id="spt-umum-form">
	    			<input type="hidden" name="id" id="id-spt-umum">
	    			<!-- <input type="hidden" name="jenis_spt_umum" id="jenis-spt-id" value="Spt Umum"> -->
					@csrf

					<!-- jenis spt bag umum -->
					<div class="form-group row">
						<label for="dasar" class="col-md-2 col-form-label ">{{ __('Jenis Spt') }}</label>
						<div class="col-md-10">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT1" name="unsur_dupak_umum" value="pengembangan profesi">
		                        <label class="custom-control-label" for="jenis-spt-umum-SPT1">PENGEMBANGAN PROFESI</label>
		                        <!-- <div class="col-md-10"> -->
								  <div class="box box-primary profesi" style="display : none;">
								    <div class="box-body" style="margin-left: 15px;">
								      <div class="form-check">
								        <input type="radio" class="form-check-input" name="sub_jenis_spt_umum" id="option1" value="Studi Banding">
								        <label class="form-check-label" for="option1">Studi Banding</label>
								      </div>
								      <div class="form-check">
								        <input type="radio" class="form-check-input" name="sub_jenis_spt_umum" id="option2" value="Konverensi/Kongres">
								        <label class="form-check-label" for="option2">Konverensi/Kongres</label>
								      </div>
								      <div class="form-check">
								        <input type="radio" name="sub_jenis_spt_umum" id="option3" class="form-check-input" value="Workshop">
								        <label class="form-check-label" for="option3">Workshop</label>
								      </div>
								      <div class="form-check">
								        <input type="radio" name="sub_jenis_spt_umum" id="option4" class="form-check-input" value="Diklat Penjenjangan">
								        <label class="form-check-label" for="option4">Diklat Penjenjangan</label>
								      </div>
								    </div>
								  </div>
								<!-- </div> -->
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT2" name="unsur_dupak_umum" value="penunjang">
		                        <label class="custom-control-label" for="jenis-spt-umum-SPT2">PENUNJANG</label>
		                        <div class="box box-primary penunjang" style="display : none;">
								    <div class="box-body" style="margin-left: 15px;">
								      <div class="form-check">
								        <input type="radio" class="form-check-input" name="sub_jenis_spt_umum" id="option5" value="Seminar/Lokakarya">
								        <label class="form-check-label" for="option5">Seminar/Lokakarya</label>
								      </div>
								      <div class="form-check">
								        <input type="radio" class="form-check-input" name="sub_jenis_spt_umum" id="option6" value="Diklat Teknis Substantif penunjang pengawasan">
								        <label class="form-check-label" for="option6">Diklat Teknis Substantif penunjang pengawasan</label>
								      </div>
								    </div>
								  </div>
							</div>
							<!-- <div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT3" name="jenis_spt_umum" value="Workshop">
		                    	<label class="custom-control-label" for="jenis-spt-umum-SPT3"></label>
		                	</div>
		                	<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input" id="jenis-spt-umum-SPT4" name="jenis_spt_umum" value="Diklat Penjenjangan" disabled="">
		                    	<label class="custom-control-label" for="jenis-spt-umum-SPT4"></label>
		                	</div> -->
		                	<small id="infoDasarHelp" class="form-text text-muted">Silahkan pilih Jenis Spt yang akan dibuat.</small>
		                </div>
		                <script type="text/javascript">
		                	$('#jenis-spt-umum-SPT1').on("click", function(){ 
							  // console.log('a');
							  $('.profesi').show('fast');
							  $('.penunjang').hide('fast');
							});
							$('#jenis-spt-umum-SPT2').on("click", function(){ 
							  // console.log('b');
							  $('.profesi').hide('fast');
							  $('.penunjang').show('fast');
							});
		                </script>
	                </div>

					<!-- dasar spt bag umum -->
					<div class="form-group row">
			            <label for="dasar" class="col-md-2 col-form-label ">{{ __('Dasar') }}</label>
			            <div class="col-md-10">
			                 <textarea rows="5" id="info-dasar-umum" class="form-control form-control-alternative @error('dasar') is-invalid @enderror" name="info_dasar_umum" ></textarea>
			                 <small id="infoDasarHelp" class="form-text text-muted">Masukkan dasar-dasar jenis SPT. Tekan <span style="color:red;">ENTER</span> untuk ganti baris.</small>
			            </div>
			        </div>

			        <!-- <div class="form-group row" id="input-lokasi-umum-container" style="display: none;">
					    <label for="lokasi" class="col-md-2 col-form-label">{{ __('Lokasi') }} </label>
						<div class="col">
							<select class="form-control selectize" id="lokasi-id-umum" name="lokasi_id_umum" placeholder="Pilih Lokasi">
								<option value="">{{ __('Pilih Lokasi') }}</option>
								@foreach($listLokasi as $lokasi)
								<option id="lokasi-{{$lokasi->id}}" class="form-control" value="{{$lokasi->id}}" >{{ $lokasi->nama_lokasi }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<script type="text/javascript">
						var select_lokasi = $('#lokasi-id-umum').selectize({	   
						   /*sortField: 'text',*/
						   allowEmptyOption: false,
						   placeholder: 'Pilih Lokasi',
						   closeAfterSelect: true,
						   create: false,
						   maxItems:10,
						   onchange: function(value){
						   	
						   },
						});
					</script> -->

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
					<!-- <button id="add-anggota-umum" class="btn btn-outline-primary btn-sm offset-md-2" type="button" data-toggle="modal" data-target="#anggotaSptUmumModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
					<small id="infoanggota" class="form-text text-muted offset-md-2">Anggota pertama dipilih akan automatis menjadi yang ditugaskan</small>	
					<div class="form-group row" id="input-anggota-umum" >
					    <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
						<div class="col table-responsive" id="tabel-anggota-umum-wrapper">											
						</div>
					</div> -->
					<!-- <script type="text/javascript">
						$('#add-anggota-umum').on('click', function(){
							if ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) {
								id_spt_umum = $('#formSptUmum').attr('data-id-spt-umum');
								$('#anggotaSptUmumModal').attr('id-spt-umum-anggota', id_spt_umum);
							}

						});
					</script> -->

					<div class="form-group row">
		                <label for="ppm" class="col-md-2 col-form-label ">{{ __('Narasumber/Moderator') }}</label>
		                    

		                <div class="col-md-6">
		                        <select class="selectize" name="anggota_moderator_spt_umum[]" multiple="multiple" id="anggota-moderator-spt-umum-id">
		                            @foreach($user_ppm as $i=>$user)
		                                <option value="{{$user->id}}">{{ $user->full_name_gelar }}</option>
		                            @endforeach
		                        </select>
		                </div>
		                <script type="text/javascript">
		                    $('#anggota-moderator-spt-umum-id').selectize({       
		                       /*sortField: 'text',*/
		                       // allowEmptyOption: false,
		                       placeholder: 'Pilih Narasumber / Moderator',
		                       // closeAfterSelect: true,
		                       // create: false,
		                       // maxItems:10,
		                       onItemAdd: function(item){
		                        $('#id-anggota-spt-umum-'+item).prop('checked', false);
		                        $('#id-anggota-spt-umum-'+item).prop('disabled', true);
		                        $("#name-user-"+item).css({ 'color': '#A9A9A9'});
		                       },
		                       onItemRemove: function(item){
		                        // $('#id-anggota-'+item).prop('checked', true);
		                        $('#id-anggota-spt-umum-'+item).prop('disabled', false);
		                        $("#name-user-"+item).css({ 'color': '#525f7f'});
		                       },
		                    });
		                    
		                </script>
		            </div>

		            <div class="form-group row">
			            <label for="dasar" class="col-md-1 col-form-label">{{ __('Peserta') }}</label>
			            <div class="col-md-10 col-form-label">
			                <input type="checkbox" name="select-all" id="select-all" /> <span style="color:red;"><b>pilih semua anggota</b></span>
			            </div>
			            <script type="text/javascript">
		                	$('#select-all').click(function(event) {   
							    if(this.checked) {
							        // Iterate each checkbox
							        $(':checkbox').each(function() {
							            this.checked = true;                        
							        });
							    } else {
							        $(':checkbox').each(function() {
							            this.checked = false;                       
							        });
							    }
							});
		                </script>
			        </div>

		            <!-- <div class="form-group" style="margin-left: -13px;">
		                <div class="col-md-2 col-form-label">{{ __('Peserta') }}</div>
		                <div class="col-md-6">
		                	<input type="checkbox" name="select-all" id="select-all" /> <b>pilih semua anggota</b>
		                </div>

		                <br>
		                
		                <script type="text/javascript">
		                	$('#select-all').click(function(event) {   
							    if(this.checked) {
							        // Iterate each checkbox
							        $(':checkbox').each(function() {
							            this.checked = true;                        
							        });
							    } else {
							        $(':checkbox').each(function() {
							            this.checked = false;                       
							        });
							    }
							});
		                </script>
		            </div> -->
		            <div class="form-group row">
			            <div class="col-md-12">
			                <div class="row">
			                    @foreach($user_ppm as $i=>$user)
			                        <div class="col-md-2" id="name-user-{{$user->id}}">{{ $user->full_name_gelar }}</div>
			                            <div class="col-md-1">
			                            <input class="form-check-input" name="anggota_spt_umum[]" multiple="multiple" id="id-anggota-spt-umum-{{$user->id}}" type="checkbox" value="{{$user->id}}"></div>
			                            <?php $i++ ?>
			                            @if($i%4 == 0)
			                                </div><div class="row">
			                            @endif
			                    @endforeach
			                </div>
			                <!-- <input type="hidden" name="id_anggota_ppm" id="anggota_ppm"> -->
			            </div>
		            </div>

					<!-- untuk melaksanakan -->
					<div class="form-group row">
			            <label for="dasar" class="col-md-2 col-form-label ">{{ __('Untuk') }}</label>
			            <div class="col-md-10">
			                 <textarea rows="5" id="info-untuk-kegiatan-umum" class="form-control form-control-alternative @error('dasar') is-invalid @enderror" name="info_untuk_umum" ></textarea>
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

@include('admin.spt.include.anggota_umum_form')


<!-- end form pengajuan spt umum -->
<script type="text/javascript">

		// var current = null;
	 //    function showresponddiv(messagedivid){
	 //        var id = messagedivid.replace("jenis-spt-umum-", ""),
	 //            div = document.getElementById(id);
	 //        // hide previous one
	 //    }
	 $('#btn-new-spt-umum').on('click', function(){
        save_method_umum = 'new';
        $('#spt-umum-form')[0].reset();
        $('.profesi').hide('fast');
		$('.penunjang').hide('fast');
		$("#anggota-moderator-spt-umum-id")[0].selectize.clear();
        $('#new-anggota-spt-form-umum')[0].reset();
        clearSessionAnggotaUmum();
        clearOptionsUmum();
    });

	function clearSessionAnggotaUmum(){
		$.ajax({
            url: "{{ route('clear_session_anggota_umum') }}",
            type: "GET",
            success: function(data){
                //$('#list-anggota-session').DataTable().ajax.reload();
                //$('#list-anggota-session').DataTable().clear().destroy();
                //console.log(data);
            },
            error: function(err){
                console.log(err);
            }
        });
	}

	var select_lokasi = $('#lokasi-id-umum').selectize({	   
	   /*sortField: 'text',*/
	   allowEmptyOption: false,
	   placeholder: 'Pilih Lokasi',
	   closeAfterSelect: true,
	   create: false,
	   maxItems:10,
	   onchange: function(value){
	   	
	   },
	});



		$( "#formSptUmum" ).on('shown.bs.modal', function(){

			/*var id_spt = $('#id-umum').val();
			var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/get-anggota/umum/' : 'spt/get-anggota/umum/';
			url = (id_spt != '') ? url_prefix+id_spt : url_prefix+'0';*/

			url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/anggota/umum' : 'spt/anggota/umum';
	 		id_spt = ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) ? $('#formSptUmum').attr('data-id-spt-umum') : '';
	 		drawTableAnggotaUmum(id_spt);

			/*$('#list-anggota-umum-session').DataTable({        
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
			    deferRender: true,
			    columns: [
			        {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '10%'
			        },
			        {data: 'nama_anggota', name: 'nama_anggota', 'title': "{{ __('Nama') }}", width: '40%'},
			        // {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}", width: '40%'},
			        {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false, width: '10%'},
			    ],
			});*/
		});

	    $("#spt-umum-form").validate({
        /*rules: {
            jenis_spt_umum : {required: true},
            tgl_mulai_umum: {required: true},
            tgl_akhir_umum: {required: true},
            // lokasi_id_umum : {required: true},
            // info_kegiatan : {teks: true},

        },*/

        submitHandler: function(form){
            // var jenis_spt_umum = $("input[name='jenis_spt_umum']:checked").val();/*$('#jenis-spt-id').val();*/
            // alert(jenis_spt_umum);
            // var anggota_moderator_umum = $("input[name=anggota_moderator_spt_umum]").val();
            // var anggota_umum = $("input[name=anggota_spt_umum]").val();
            // var tgl_mulai_umum = $("#tgl-mulai-umum").val();
            // var tgl_akhir_umum = $("#tgl-akhir-umum").val();
            // var lama_umum = $('#lama-spt-umum').val();
            // var lokasi_umum_id = $('#lokasi-id-umum').val();
            // var info_dasar_umum = $('#info-dasar-umum').val();
            // var info_untuk_umum = $('#info-untuk-kegiatan-umum').val();

            //var id = $('#id-umum').val();
            //save_method_umum = (id == '') ? 'new' : save_method_umum;
            //var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/' : 'spt/';
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            spt_umum_id = ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) ? $('#formSptUmum').attr('data-id-spt-umum') : '';
            url = ( spt_umum_id === '') ? "{{ route('store_spt_umum') }}" : "{{ route('update_spt_umum') }}" ;
            // alert(url);
            method = (spt_umum_id === '') ? "POST" : "PUT";
            var formData = new FormData($(form)[0]);

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
                success: function(data){
                	// console.log(data);
                    // $("#spt-umum-form")[0].reset();
                    // $('#formSptUmum').modal('hide');
                    // //if(save_method_umum == 'new') clearSessionAnggota();
                    // //table.ajax.reload();
                    // $('#spt-umum-table').DataTable().ajax.reload();
                    // clearOptionsUmum();
                    //$('#list-anggota-umum-session').DataTable().clear().destroy();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });

	function unset_anggota(user_id){
		save_method_umum = 'delete';
	        var csrf_token = $('meta[name="csrf-token"]').attr('content');
	        var tgl_mulai = $('#tgl-mulai').val();
	        var tgl_akhir = $('#tgl-akhir').val();
	        spt_umum_id = ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) ? $('#formSptUmum').attr('data-id-spt-umum') : '';
	        $.confirm({
	            title: "{{ __('Delete Confirmation') }}",
	            content: "{{ __('Are you sure to delete ?') }}",
	            buttons: {
	                delete: {
	                    btnClass: 'btn-danger',
	                    action: function(){
	                    	url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? "admin/spt/session/anggota/umum/delete/"+user_id : "spt/session/anggota/umum/delete/"+user_id;
	                        //url = "session/anggota/delete/"+user_id;
	                        $.ajax({
	                            url: url,
	                            type: "POST",                
	                            data: {_method: 'delete', '_token' : csrf_token, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, user_id:user_id },
	                            success: function(data){
	                                //$('#list-anggota-umum-session').DataTable().ajax.reload();
	                                //console.log(data);
	                                drawTableAnggotaUmum(spt_umum_id);
	                            },
	                            error: function(err){
	                            	console.log(err);
	                            }
	                        });
	                    },
	                },
	                cancel: function(){
	                    $.alert('Canceled!');
	                }
	            }
	    });
	}

	/*var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/' : 'spt/';
	 id_spt = ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) ? $('#formSptUmum').attr('data-id-spt-umum') : '';
	 drawTableAnggotaUmum(id_spt);*/

	//function delete anggota umum
	function deleteAnggotaUmum(detail_id){
		//save_method = 'delete';
		var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/' : 'spt/';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        id_spt = ( typeof $('#formSptUmum').attr('data-id-spt-umum') !== 'undefined' ) ? $('#formSptUmum').attr('data-id-spt-umum') : '';
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        url = url_prefix+'delete-anggota-umum/' +detail_id;
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                //$('#list-anggota-session').DataTable().ajax.reload();
                                //console.log(url);
                                drawTableAnggotaUmum(id_spt);
                            }
                        });
                    },
                },
                cancel: function(){
                    $.alert('Canceled!');
                }
            }
        });
	}

	function drawTableAnggotaUmum(spt_id = ''){

            url = "{{ route('tabel_anggota_umum') }}"

            $.ajax({
              url : url,
              data: {spt_id: spt_id},
              type: 'GET',
              success: function(res){
                $('#tabel-anggota-umum-wrapper').html(res);
              },
              error: function(err){
                console.log(err);
              }
            });
		}

	

    /*$('#formSptUmum').on('hidden.bs.modal', function () {
		$('#spt-umum-form')[0].reset();
		$('#id-umum').val('');
		// $('#tambahan').val('');
		select_lokasi[0].selectize.clear();
		save_method_umum = null;
		$('#list-anggota-umum-session').DataTable().clear().destroy();
		// $('#input-tambahan-container').hide();
		// $('#input-lokasi-container').hide();

	});*/

		function clearOptionsUmum(){            
	        var optPeran = $('#session-anggota-umum').selectize();
	        var optAnggota = $('#session-anggota-umum').selectize();            
	        var controlPeran = optPeran[0].selectize;
	        var controlAnggota = optAnggota[0].selectize;
	        controlPeran.clear();
	        controlAnggota.clear();
	    }
	

	/*jquery hide selectize moderator for ppm Studi Banding & Diklat Penjenjangan*/
	// $(function() {
	//     $('#moderator_id').hide(); 
	//     $('input[type="radio"]').click(function(){
	//         var inputValue = $(this).attr("value");
	//         // console.log(inputValue != 'Studi Banding' && inputValue != 'Diklat Penjenjangan');
	//         if(inputValue != 'Workshop' && inputValue != 'Konverensi/Kongres') {
	//             $('#moderator_id').show('fast'); 
	//         } else {
	//             $('#moderator_id').hide('fast'); 
	//         } 
	//     });
	// });
</script>