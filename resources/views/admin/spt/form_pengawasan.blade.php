<!-- start form pengajuan spt pengawasan -->
<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formModal" data-backdrop="static" data-keyboard="false" style="z-index: 1500;">
  <div class="modal-dialog modal-xl" style="max-width: 75%;">
    <div class="modal-content">
    	<div class="modal-header">
    		<h3>{{ __('Pengajuan SPT') }}</h3>
    		<button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-spt-pengawasan-form">
	        	<span class="btn-inner--icon"><i class="fa fa-times"></i></span>
	        	<span class="btn-inner--text">{{ __('Close') }}</span>
	        </button>
    	</div>
		<div class="modal-body">
			<form id="spt-form" class="ajax-form needs-validation" novalidate>
				<input type="hidden" name="id" id="id">
				@csrf
				<div class="form-group row">
					<label for="jenis_spt_id" class="col-md-2 col-form-label text-right">{{ __('Jenis SPT') }} </label>
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

				<div class="form-group row" id="input-dasar-container" style="display:none">
				    <label for="input_dasar" class="col-md-2 col-form-label text-right">{{ __('Dasar') }} </label>
					<div class="col">
						<textarea name="input_dasar" id="input-dasar" class="form-control" ></textarea>
						<small id="input_dasarHelp" class="form-text text-muted">Masukkan DASAR SPT yang akan dibuat. Tekan <span style="color:red;">ENTER</span> untuk ganti baris.</small>
					</div>
				</div>

				<div class="form-group row">
				    <label for="tgl-mulai" class="col-md-2 col-form-label text-right">{{ __('Mulai') }}</label>
				    <div class="col-md-4">
						<input type="text" class="form-control datepicker" name="tgl_mulai" id="tgl-mulai" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">
					</div>
					<label for="tgl-akhir" class="col-md-2 col-form-label text-right">{{ __('Berakhir') }}</label>
				    <div class="col-md-4">
						<input type="text" class="form-control datepicker" name="tgl_akhir" id="tgl-akhir" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
					</div>
				</div>

				<div class="form-group row">
				    <label for="tgl-mulai" class="col-md-2 col-form-label text-right">{{ __('Lama') }}</label>
				    <div class="col-md-4">
						<input type="text" class="form-control" name="lama" id="lama" autocomplete="off" placeholder="{{ __('Lama')}}" disabled="disabled">
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

				<!-- <button id="add-anggota" class="btn btn-outline-primary btn-sm offset-md-2" type="button" data-toggle="modal" data-target="#anggotaSptModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
				<div class="form-group row" id="input-anggota" >
				    <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
					<div class="col table-responsive" id="tabel-anggota-pengawasan-wrapper">						
					</div>
				</div> -->
				

				<script type="text/javascript">
					$('#add-anggota').on('click', function(){
						if ( typeof $('#formModal').attr('data-id-spt-pengawasan') !== 'undefined' ) {
							id_spt_pengawasan = $('#formModal').attr('data-id-spt-pengawasan');
							$('#anggotaSptModal').attr('id-spt-pengawasan-anggota', id_spt_pengawasan);
						}

					})
				</script>

				<div class="form-group row" id="input-lokasi-container" style="display:none">
				    <label for="lokasi" class="col-md-2 col-form-label text-right">{{ __('Lokasi') }} </label>
					<div class="col">
						<select class="form-control selectize" id="lokasi-id" name="lokasi_id" placeholder="Pilih Lokasi">
							<option value="">{{ __('Pilih Lokasi') }}</option>
							@foreach($listLokasi as $lokasi)
							<option id="lokasi-{{$lokasi->id}}" class="form-control" value="{{$lokasi->id}}" >{{ $lokasi->lokasi }}</option>
							@endforeach
						</select>
					</div>
				</div>


				<div class="form-group row" id="input-tambahan-container" style="display:none">
				    <label for="tambahan" class="col-md-2 col-form-label text-right">{{ __('Tambahan') }} </label>
					<div class="col">
						<textarea name="tambahan" id="tambahan" class="form-control" ></textarea>
						<small id="tambahanHelp" class="form-text text-muted">Masukkan informasi tambahan mengenai SPT yang akan dibuat. Tekan <span style="color:red;">ENTER</span> untuk ganti baris.</small>
					</div>
				</div>
				@include('admin.spt.include.anggota_pengawasan_form')
				

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

<script type="text/javascript">
	$('#close-spt-pengawasan-form').on('click', function(){
		if ( typeof $('#formModal').attr('data-id-spt-pengawasan') !== 'undefined' ){
			$('#formModal').removeAttr('data-id-spt-pengawasan');//close-anggota
		}
	})
</script>
<!-- end form pengajuan spt pengawasan -->




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
                    //console.log(results.tambahan);
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

	   	if('undefined' !== typeof id_jenis_spt){
	   		//cek dasar spt dari jenis spt, jika null tampilkan textbox dasar spt
	   		
	   		$.ajax({
	   			url : "{{ route('cek_dasar_spt') }}",
	   			type: "GET",
		    	//dataType: "JSON",
		    	data: {id: id_jenis_spt }, 
	   			success: function(response){
	   				//console.log(response);
	   				if('undefined' !== typeof response.dasar && '' === response.dasar){
	   					$('#input-dasar-container').show('fast');
	   				}else{
	   					$('#input-dasar-container').hide('fast');
	   					$('#input-dasar').val('');
	   				}
	   				
	   			},
	   			error: function(error){
	   				console.log(error);
	   			}
	   		});
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

    function setDasar(dasar){
    	var element = document.getElementById('input-dasar');
    	if(dasar !== '') {
    		element.value = dasar;
    	}else{
    		element.value = '';
    	}
    }

/*   var select_anggota = $('#session-anggota').selectize({
	   persist: false,
	   sortField: 'text',
	   allowEmptyOption: false,
	   placeholder: 'Anggota SPT',
  	});

  var select_peran = $('#session-peran').selectize({
	   allowEmptyOption: false,
	   placeholder: 'Peran SPT',
	   create: false,
	   onchange: function(value){

	   },
  });*/

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
		//save_method = 'delete';
		var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/' : 'spt/';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        id_spt = ( typeof $('#formModal').attr('data-id-spt-pengawasan') !== 'undefined' ) ? $('#formModal').attr('data-id-spt-pengawasan') : '';
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
                                //$('#list-anggota-session').DataTable().ajax.reload();
                                //console.log(url);
                                drawTableAnggota(id_spt);
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

	//var id_spt = $('#id').val();
	//tambahan
	if(tambahan != '' && save_method == 'edit'){
		//$('#tambahan').text(tambahan);
		$('#input-tambahan-container').show('fast');
		if(typeof tambahan !== 'undefined')
		{setDataTambahan(tambahan);}
	}
	//tambahan end

	//dasar
	if('undefined' !== typeof dasar && save_method == 'edit'){
		$('#input-dasar-container').show('fast');
		if(typeof dasar !== 'undefined')
		{setDasar(dasar);}
	}

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

    /*var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/get-anggota/' : 'spt/get-anggota/';
	url = (typeof id_spt !== 'undefined') ? url_prefix+id_spt : url_prefix+'0';*/
	//console.log(url);
	url = "{{ route('get_anggota_spt') }}";

	/*datatable setup*/
  id_spt = ( typeof $('#formModal').attr('data-id-spt-pengawasan') !== 'undefined' ) ? $('#formModal').attr('data-id-spt-pengawasan') : '';
  //drawTableAnggota(id_spt);

});

	//clear datatable anggota
	$('#formModal').on('hidden.bs.modal', function () {
		$('#spt-form')[0].reset();
		$('#id').val('');
		$('#tambahan').val('');
		$('#input-dasar').val('');
		select_lokasi[0].selectize.clear();
		save_method = null;
		//$('#list-anggota-session').DataTable().clear().destroy();
		$('#input-tambahan-container').hide();
		$('#input-lokasi-container').hide();
	});

//deleting an item from anggota session
function unset(user_id){
	save_method = 'delete';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var tgl_mulai = $('#tgl-mulai').val();
        var tgl_akhir = $('#tgl-akhir').val();
        id_spt = ( typeof $('#formModal').attr('data-id-spt-pengawasan') !== 'undefined' ) ? $('#formModal').attr('data-id-spt-pengawasan') : '';
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
                                //$('#list-anggota-session').DataTable().ajax.reload();
                                //console.log(data);
                                drawTableAnggota(id_spt);
                            },
                            error: function(err){
                            	//console.log(err);
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
