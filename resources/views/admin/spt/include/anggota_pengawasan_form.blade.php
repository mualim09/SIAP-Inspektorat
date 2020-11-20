<!-- Penanggungjawab /Pembantu pj-->
<div class="form-group row">	
	<label for="session_pj" class="col-md-2 col-form-label">{{ __('Penanggungjawab') }} </label>
	<div class="col-md-4">
		<select class="form-control" id="session-pj" name="session_pj">			        			
			<option class="form-control" value="{{$pj->id}}">{{ $pj->full_name_gelar }}</option>
		</select>
	</div>
	<label for="session_ket" class="col-md-2 col-form-label">{{ __('Ketua') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-ket" name="session_ket">
			<option value="">{{ __('Ketua') }}</option>
			@foreach($kets as $ket)
			<option class="form-control selectize" value="{{$ket->id}}">{{ $ket->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>	
</div>


<!-- Daltu / Dalnis-->
<div class="form-group row">	
	<label for="session_ppj" class="col-md-2 col-form-label">{{ __('Pembantu Penanggungjawab') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-ppj" name="session_ppj">
			<option value="">{{ __('Pembantu Penanggungjawab') }}</option>
			@foreach($ppjs as $ppj)
			<option class="form-control selectize" value="{{$ppj->id}}">{{ $ppj->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>
	<label for="session_anggota[]" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-anggota-1" name="session_anggota[]">
			<option value="">{{ __('Anggota') }}</option>
			@foreach($anggotas as $anggota)
			<option class="form-control selectize" value="{{$anggota->id}}">{{ $anggota->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>
	
</div>


 <!-- Ketua -->
<div class="form-group row">	
	<label for="session_pm" class="col-md-2 col-form-label">{{ __('Pengendali Mutu') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-pm" name="session_pm">
			<option value="">{{ __('Pengendali Mutu') }}</option>
			@foreach($pms as $pm)
			<option class="form-control selectize" value="{{$pm->id}}">{{ $pm->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>
	<label for="session_anggota[]" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-anggota-2" name="session_anggota[]">
			<option value="">{{ __('Anggota') }}</option>
			@foreach($anggotas as $anggota)
			<option class="form-control selectize" value="{{$anggota->id}}">{{ $anggota->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>
	
</div>

 <!-- Anggota -->
<div class="form-group row">
	<label for="session_pt" class="col-md-2 col-form-label">{{ __('Pengendali Teknis') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-pt" name="session_pt">
			<option value="">{{ __('Pengendali Teknis') }}</option>
			@foreach($pts as $pt)
			<option class="form-control selectize" value="{{$pt->id}}">{{ $pt->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>
	
	<label for="session_anggota[]" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
	<div class="col-md-4">
		<select class="form-control selectize" id="session-anggota-3" name="session_anggota[]">
			<option value="">{{ __('Anggota') }}</option>
			@foreach($anggotas as $anggota)
			<option class="form-control selectize" value="{{$anggota->id}}">{{ $anggota->full_name_gelar }}</option>
			@endforeach
		</select>
	</div>	
</div>

<script type="text/javascript">
	$('.selectize').selectize({
	   persist: false,
	   sortField: 'text',
	   allowEmptyOption: false,
  	});
	$("#new-anggota-spt-form").validate({
    rules: {
        session_anggota: {required: true, number:true},
        //session_peran: {required: true}
        /*session_peran : {
        	required: true,
        	normalizer: function( value ) {
	        	var regex = /^[a-zA-Z]+$/;
	        	if(regex.test(value) == false){
	        		$.alert("Must be in alphabets only");
	        		return false;
	        	}
	    	}
		}*/
    },
    submitHandler: function(form){
    var tgl_mulai = $('#spt-form').find('#tgl-mulai').val();
    var tgl_akhir = $('#spt-form').find('#tgl-akhir').val();
    var user_id = $('#session-anggota option:selected').val();
    var peran = $('#session-peran option:selected').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    //var id_spt = (typeof id_spt == 'undefined') ? null : id_spt;
  if ( typeof $('#anggotaSptModal').attr('id-spt-pengawasan-anggota') !== 'undefined' ){
    id_spt = $('#anggotaSptModal').attr('id-spt-pengawasan-anggota');
  }else{
    id_spt = '';
  }
        //alert(save_method);
        url = (save_method === 'edit') ? "{{ route('store_detail_anggota') }}" : "{{ route('store_session_anggota') }}" ;
        if(tgl_mulai == '' || tgl_akhir==''){
        	$.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
        }else{
        	//alert(url);
        	$.ajax({
                url: url,
                type: 'POST',
                //dataType: 'json',
                data: {_token: CSRF_TOKEN, user_id:user_id, peran:peran, spt_id:id_spt, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir},
                success: function(data){
                    //$('#list-anggota-session').DataTable().ajax.reload();
              //console.log(id_spt);
                    drawTableAnggota(id_spt);
                    clearOptions();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        }

    }
});

function drawTableAnggota(spt_id = ''){

	url = "{{ route('tabel_anggota_pengawasan') }}"

	$.ajax({
		url : url,
		data: {spt_id: spt_id},
		type: 'GET',
		success: function(res){
		$('#tabel-anggota-pengawasan-wrapper').html(res);
		},
		error: function(err){
		//console.log(err);
		}
	});
}

$('#close-anggota-pengawasan').on('click', function(){
	if ( typeof $('#anggotaSptModal').attr('id-spt-pengawasan-anggota') !== 'undefined' ){
		$('#anggotaSptModal').removeAttr('id-spt-pengawasan-anggota');
	}
})
</script>