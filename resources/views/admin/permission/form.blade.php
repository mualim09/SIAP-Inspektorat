<div class="col-md-12 permission-form">
	<form id="permission-form" class="ajax-form">
        <input type="hidden" name="id" id="id">            
		@csrf
		<div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Permission name') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('permission_name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>           
        <div class="form-group">
        	<div class="col-md-8">
            	<button type="submit" class="btn btn-primary offset-md-3">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
	</form>
</div>