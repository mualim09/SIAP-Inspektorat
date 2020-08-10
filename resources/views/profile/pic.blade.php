<?php
if(isset($profile)){
	$self_pic = (auth()->user()->id == $profile->user_id) ? true : false;
	$pic_check = $profile->hasMedia('pic');
}else{
	$pic_check = false;
}

//dd($profile_pic);

?>

<div class="row justify-content-center">
    <div class="col-lg-3 order-lg-2">
        <div class="card-profile-image">            
        	<a href="#" data-target="#modalpic" data-toggle="modal" class="color-gray-darker td-hover-none">
                @if( $pic_check == true ) 
                	<img id="img-profile-thumb" src="{{ $profile->getFirstMediaUrl('pic','thumb') }}" class="rounded-circle"  style="">                
                @else
                	<img src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}" class="rounded-circle">
                @endif	                
            </a>
        </div>
    </div>
</div>

<!-- modal content profile pic -->
<div aria-hidden="true" aria-labelledby="myModalLabel" class="modal fade" id="modalpic" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="d-flex justify-content-end">
				<button type="button" class="btn btn-circle close-modal-btn" data-dismiss="modal" aria-label="Close">
		        	<i class="fa fa-times"></i>
		        </button>
	        </div>
			<div class="modal-body mb-0 p-0">				
                @if( $pic_check == true )
                	<img id="img-profile" src="{{ $profile->getFirstMediaUrl('pic') }}" class="img-responsive img-fluid"  style="width:100%" >
                @else
                	<img src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}" class="rounded-circle">
                @endif
			</div>
			<div class="modal-footer d-flex justify-content-start">
			@if(isset($profile) )			
				<form id="profile-pic" enctype="multipart/form-data" class="form-inline col-md-12">
					@csrf
					<input type="hidden" name="profile_id" value="{{ isset($profile->id)??$profile->id}}" id="profile-id">
					<!--<input type="file" id="pic" name="pic" placeholder="{{ __('Choose file') }}">
					<label class="justify-content-start" for="pic">{{ __('Choose file') }}</label>-->
					<div class="form-group custom-file col-md-7">						
						<input type="file" class="custom-file-input" id="pic" name="pic" placeholder="{{ __('Choose file') }}">
						<label class="custom-file-label justify-content-start" for="pic">{{ __('Choose file') }}</label>
					</div>
					<button class="btn btn-primary col-md-3 offset-md-2" type="submit">{{ __('Save') }}</button>
				</form>
			@else
				<div class="text-center"> {{ __('Update your profile to change profile picture.') }}</div>
			@endif
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">	
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

    $('#profile-pic').validate({
    	rules: {
    		pic: {extension: "png|jpe?g", maxsize: 1048576},    		
    	},
    	messages: {
			pic:{
				extension:"File must be jpg, jpeg and png extension.",
				maxsize: "File maximum: 1MB"
			}
		},
    	submitHandler: function(form){            
            var profile_id = $('#profile-id').val();
	        url = "pic-update";
	        /*type = (profile_id != '') ? 'PUT' : 'POST';*/
	        $.ajax({
	        	url: url,
	        	type: 'POST',
	        	data: new FormData($('#profile-pic')[0]),
	        	contentType: false,
	        	processData: false,
	        	success: function(data){
	        		console.log('success',data);
	        		$('#img-profile-thumb').attr('src', data.thumb );
	        		$('#img-profile').attr('src', data.real );
	        	},
	        	error: function(err){
	        		console.log(err);
	        	}
	        });
        }
    });
   
</script>