<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formModal" data-backdrop="static" data-keyboard="false" style="z-index: 1500;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">    	
    	<div class="modal-header">
    		<h3>{{ __('Pengajuan SPT') }}</h3>
    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-spt-form">
	        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
	        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        </button>
    	</div>
		<div class="modal-body">
			<form id="spt-form" class="ajax-form needs-validation" novalidate>
				<input type="hidden" name="id" id="id">
				@csrf
				<div class="form-group row">
					<label for="jenis_spt_id" class="col-md-2 col-form-label">{{ __('Jenis SPT') }} </label>
					<div class="col">
						<select class="form-control" id="jenis-spt" name="jenis_spt" placeholder="Cari Jenis SPT">
							@foreach($jenis_spt as $jenis)
							<option id="jenis-spt-{{$jenis->id}}" class="form-control" value="{{$jenis->id}};{{$jenis->input['lokasi']}};{{$jenis->input['tambahan']}};{{$jenis->cek_radio}}">{{ $jenis->nama_sebutan }}</option>
							@endforeach
						</select>
						<input type="hidden" name="jenis_spt_id" id="id-jenis-spt">
						<input type="hidden" name="input_lokasi" id="input-lokasi">
						<input type="hidden" name="input_tambahan" id="input-tambahan">
					</div>

				</div>
				<div class="col-md-8 offset-md-2" id="lanjutan">
					<div class="custom-control custom-radio mb-3">
                        <input name="info[lanjutan]" class="custom-control-input info-lanjutan" id="info-lanjutan" type="checkbox" value="1">
                        <label class="custom-control-label mr-3" for="info-lanjutan">Lanjutan</label>
                    </div>
				</div>


				<div class="col-md-8 offset-md-2" id="radio-tambahan" style="display: none;">
				</div>

				<div class="form-group row">		            
				    <label for="tgl-mulai" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
				    <div class="col-md-4">			            
						<input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl-mulai" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">						    
					</div>
					<label for="tgl-akhir" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
				    <div class="col-md-4">			            
						<input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl-akhir" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">						    
					</div>
				</div>

				<div class="form-group row">		            
				    <label for="tgl-mulai" class="col-md-2 col-form-label">{{ __('Lama') }}</label>
				    <div class="col-md-4">			            
						<input type="text" class="form-control" name="lama" id="lama" autocomplete="off" placeholder="{{ __('Lama')}}">						    
					</div>					
				</div>
				<script type="text/javascript">
					$('.datepicker').each(function() {
				        $(this).datepicker({
				            language: "{{ config('app.locale')}}",
				            format: 'dd-mm-yyyy',
				            autoclose: true,
				            todayHighlight: true,
				        });     
				    });
				    $("#tgl-mulai").on('changeDate', function(selected) {
				        var startDate = new Date(selected.date.valueOf());
				        $("#tgl-akhir").datepicker('setStartDate', startDate);
				        $('#tgl-akhir').prop('disabled',false);
				        $('#tgl-akhir').focus();
				        /*if($("#tgl-mulai").val() > $("#tgl-akhir").val()){
				          $("#tgl-akhir").val($("#tgl-mulai").val());
				        }
				        $(this).closest('div').next().find('input').focus();
				        */
				    });
					
					$('#tgl-akhir').on('changeDate', function(){
						var start = $("#tgl-mulai").val();
						var end = $("#tgl-akhir").val();
						url = "{{route('durasi_spt')}}"//'admin/spt/durasi/' +start+'/'+end;
	                        $.ajax({
	                            url: url,
	                            type: "GET",
	                            //dataType: 'JSON',
	                            data: {start:start, end:end},
	                            success: function(data){
	                                //console.log(data);
	                                $('#lama').val(data);
	                            },
	                            error: function(response, status, error){
	                            	//console.log(response);
	                            }
	                        });
					});
				</script>

				<div class="form-group row" id="input-anggota" >
				    <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
					<div class="col">
						<table id="list-anggota-session" class="col"></table>
						<button id="add-anggota" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaSptModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
					</div>
				</div>

				<div class="form-group row" id="input-lokasi-container" style="display:none">
				    <label for="lokasi" class="col-md-2 col-form-label">{{ __('Lokasi') }} </label>
					<div class="col">
						<select class="form-control selectize" id="lokasi-id" name="lokasi_id" placeholder="Pilih Lokasi">
							<option value="">{{ __('Pilih Lokasi') }}</option>
							@foreach($listLokasi as $lokasi)
							<option id="lokasi-{{$lokasi->id}}" class="form-control" value="{{$lokasi->id}}" >{{ $lokasi->nama_lokasi }}</option>
							@endforeach
						</select>
					</div>
				</div>


				<div class="form-group row" id="input-tambahan-container" style="display:none">
				    <label for="tambahan" class="col-md-2 col-form-label">{{ __('Tambahan') }} </label>
					<div class="col">
						<textarea name="tambahan" id="tambahan" class="form-control" ></textarea>
						<small id="tambahanHelp" class="form-text text-muted">Masukkan informasi tambahan mengenai SPT yang akan dibuat. tekan <span style="color:red;">ENTER</span> untuk ganti baris.</small>
					</div>
				</div>


				<!-- Hidden form untuk disesuaikan dengan jenis SPT -->
				<div class="form-group row hidden">
					@include('admin.spt.include')
				</div>		               

				<div class="form-group">
					<div class="col">
				    	<button type="submit" class="btn btn-primary offset-md-1">
				            {{ __('Submit') }}
				        </button>
				    </div>
				</div>
			</form>
		</div>
    </div>
  </div>
</div>

<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="anggotaSptModal" data-backdrop="static" data-keyboard="true" style="z-index: 2000;">
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
				<form  id="new-anggota-spt-form" class="ajax-form needs-validation" novalidate>
					<input type="hidden" name="spt_id" id="spt-id">
			        @csrf
			        <div class="form-group row">
			        	<label for="anggota" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
			        	<div class="col-md-4">
			        		<select class="form-control selectize" id="session-anggota" name="session_anggota">
			        			<option value="">{{ __('Anggota SPT') }}</option>
			        			@foreach($listAnggota as $anggota)
			        			<option class="form-control selectize" value="{{$anggota->id}}" >{{ $anggota->full_name . $anggota->gelar }}</option>
			        			@endforeach
			        		</select>
			        	</div>
			        	<div class="col-md-4">
			        		<select class="form-control selectize" id="session-peran" name="session_peran">
			        			<option value="">{{ __('Peran SPT') }}</option>
			        			@foreach($listPeran as $peran)
			        			<option class="form-control" value="{{$peran}}" >{{ $peran }}</option>
			        			@endforeach
			        		</select>
			        	</div>
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
					$("#new-anggota-spt-form").validate({
		            rules: {
		                session_anggota: {required: true, number:true},
		                session_peran: {required: true}
		            },
		            submitHandler: function(form){
		            	var tgl_mulai = $('#spt-form').find('#tgl-mulai').val();
		            	var tgl_akhir = $('#spt-form').find('#tgl-akhir').val();
		                var user_id = $('#session-anggota option:selected').val();
		                var peran = $('#session-peran option:selected').val();
		                var spt_id = $('#spt-form').find('#id').val();
		                url = (spt_id !== '') ? "{{ route('store_detail_anggota') }}" : "{{ route('store_session_anggota') }}" ;
		                if(tgl_mulai == '' || tgl_akhir==''){
		                	$.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
		                }else{
		                	//alert(url);
		                	$.ajax({
			                    url: url,
			                    type: 'post',
			                    data: {user_id:user_id, peran:peran, spt_id:spt_id, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir},
			                    success: function(data){		                        		                        
			                        $('#list-anggota-session').DataTable().ajax.reload();
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



<script type="text/javascript">	

	//selectize
	var select_jenis_spt = $('#jenis-spt').selectize({
	   allowEmptyOption: false,
	   placeholder: 'Jenis SPT',
	   create: false,
	   onChange: function(value){
	   	var arr_val = value.split(';');
	   	var id_jenis_spt = arr_val[0];
	   	var input_lokasi = arr_val[1];
	   	var input_tambahan = arr_val[2];
	   	var cek_radio = arr_val[3];
	   	$('#id-jenis-spt').val(id_jenis_spt);
	   	
	   	//show hide radio
	   	if(cek_radio == 1){
	   		$('#input-radio').show('fast');
	   		$('#lanjutan').hide();
	   		//ajax proses untuk mendapatkan radio button value
			$.ajax({
                url: '{{ url("/admin/jenis-spt/get-radio-value") }}' + '/' + id_jenis_spt ,
                success: function(results) {
                    $('#radio-tambahan').html(results);
                    $('#radio-tambahan').show('fast');
                },
                error: function() {
                    callback();
                }
            });
	   	}else{
	   		$('#radio-tambahan').hide('fast');
	   		$('.radio_input').remove();
	   	}

	   	//show hide input lokasi
	   	if(input_lokasi == 1){
	   		$('#input-lokasi-container').show('fast');
	   		$('#input-lokasi').val(input_lokasi);
	   	}else{
	   		$('#input-lokasi-container').hide('fast');
	   		$('#input-lokasi').val(0);
	   	}

	   	if(input_tambahan == 1 && save_method == 'new'){
	   		$('#input-tambahan').val(input_tambahan);
	   		$('#input-tambahan-container').show('fast');
	   		//ajax proses untuk mendapatkan radio button value
			$.ajax({
                url: '{{ url("/admin/spt/last-data-tambahan") }}/'+id_jenis_spt,
                success: function(results) {
                    console.log(results.tambahan);
                    //$('#tambahan').text(results.tambahan);
                    //last_tambahan = results.tambahan;
                    if(typeof results.tambahan !== 'undefined' ){
                    	setDataTambahan(results.tambahan);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
            
	   	}else if(input_tambahan == 1){
	   		$('#input-tambahan-container').show('fast');
	   	}
	   	else{
	   		$('#input-tambahan-container').hide('fast');
	   		$('#input-tambahan').val(0);
	   		$('#tambahan').val('');
	   	}

	   },
    });

    function setDataTambahan(data_tambahan){
    	var element_tambahan = document.getElementById('tambahan');
    	if(data_tambahan !== '') {
    		element_tambahan.value = data_tambahan;
    	}else{
    		element_tambahan.value = '';
    	}
    }

   var select_anggota = $('#session-anggota').selectize({	   
	   persist: false,
	   sortField: 'text',
	   allowEmptyOption: false,
	   placeholder: 'Anggota SPT',	  
  	});

  var select_peran = $('#session-peran').selectize({	   
	   /*sortField: 'text',*/
	   allowEmptyOption: false,
	   placeholder: 'Peran SPT',
	   create: false,
	   onchange: function(value){
	   	
	   },
  });

  var select_lokasi = $('#lokasi-id').selectize({	   
	   /*sortField: 'text',*/
	   allowEmptyOption: false,
	   placeholder: 'Pilih Lokasi',
	   closeAfterSelect: true,
	   create: false,
	   maxItems:10,
	   onchange: function(value){
	   	
	   },
  });

	function deleteAnggota(detail_id){
		save_method = 'delete';
		var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/' : 'spt/';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        url = url_prefix+'delete-anggota/' +detail_id;
                        $.ajax({
                            url: url,
                            type: "POST",                
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                $('#list-anggota-session').DataTable().ajax.reload();
                                console.log(data);                        
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

	function clearOptions(){            
        var optPeran = $('#session-peran').selectize();
        var optAnggota = $('#session-anggota').selectize();            
        var controlPeran = optPeran[0].selectize;
        var controlAnggota = optAnggota[0].selectize;
        controlPeran.clear();
        controlAnggota.clear();
    }
        
</script>

<script type="text/javascript">
$( "#formModal" ).on('shown.bs.modal', function(){

	var id_spt = $('#id').val();
	//tambahan
	if(tambahan != '' && save_method == 'edit'){
		//$('#tambahan').text(tambahan);
		$('#input-tambahan-container').show('fast');
		if(typeof tambahan !== 'undefined') 
		{setDataTambahan(tambahan);}
	}
	//tambahan end

	//lokasi start
	if(typeof lokasi !== 'undefined' && save_method == 'edit'){
		select_lokasi[0].selectize.setValue(lokasi);
		$('#input-lokasi-container').show();
	}
	//lokasi end
	
    if(save_method == 'edit'){
    	select_jenis_spt[0].selectize.setValue(jenis_spt_id+';'+input_lokasi+';'+input_tambahan+';'+cek_radio);
    }else{
    	select_jenis_spt[0].selectize.clear();
    }

	url = (id_spt != '') ? "{{url('/admin/spt/get-anggota')}}"+"/"+id_spt : "{{ url('/admin/spt/get-anggota') }}/0";


	/*datatable setup*/    
    $('#list-anggota-session').DataTable({        
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
	
	//clear datatable anggota
	$('#formModal').on('hidden.bs.modal', function () {
		$('#spt-form')[0].reset();
		$('#id').val('');
		$('#tambahan').val('');
		select_lokasi[0].selectize.clear();
		save_method = null;
		$('#list-anggota-session').DataTable().clear().destroy();
		$('#input-tambahan-container').hide();
		$('#input-lokasi-container').hide();
	});

//deleting an item from anggota session
function unset(user_id){
	save_method = 'delete';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var tgl_mulai = $('#tgl-mulai').val();
        var tgl_akhir = $('#tgl-akhir').val();
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                    	url = (window.location.pathname == '/admin') ? "admin/spt/session/anggota/delete/"+user_id : "spt/session/anggota/delete/"+user_id;
                        //url = "session/anggota/delete/"+user_id;
                        $.ajax({
                            url: url,
                            type: "POST",                
                            data: {_method: 'delete', '_token' : csrf_token, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, user_id:user_id },
                            success: function(data){
                                $('#list-anggota-session').DataTable().ajax.reload();
                                console.log(data);                        
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

</script>

@push('css')
	<link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
	<script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>	
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush