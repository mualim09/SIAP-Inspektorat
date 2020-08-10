<?php
$self_cover = (auth()->user()->id == $profile->user_id) ? true : false;
?>

<div class="row justify-content-center">
    <div class="col-lg-3 order-lg-2">
        <div class="card-profile-image">
            @if($self_cover == true )
            <form method="post" id="coverImage" enctype="multipart/form-data">
            	@csrf
            	<a href="#">
	                @if(isset($profile->cover))
	                	<img src="{{ asset('assets/uploads').'/'.$profile->id.'/'.$profile->cover }}" class="rounded-circle img-responsive"  style="margin-top: {{$image->position}}">                
	                @else
	                	<img src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}" class="rounded-circle">
	                @endif
	                <label for="file-upload" class="custom-file-upload" title="Change Cover Image">
                        <i class="fa fa-file-image-o"></i>&nbsp; Change Cover
                    </label>
	                <input id="file-upload" name="file" type="file" />	                
	            </a>
	        </form>
	        @else
	        	<a href="#">
	                @if(isset($profile->cover))
	                	<img src="{{ asset('assets/uploads').'/'.$profile->id.'/'.$profile->cover }}" class="rounded-circle img-responsive"  style="margin-top: {{$image->position}}">                
	                @else
	                	<img src="{{ asset('assets/img/theme/team-4-800x800.jpg') }}" class="rounded-circle">
	                @endif	                
	            </a>
	        @endif
        </div>
    </div>
</div>
