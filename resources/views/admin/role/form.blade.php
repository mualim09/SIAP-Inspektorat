<div class="col-md-12 role-form">
    <form id="role-form" class="ajax-form needs-validation" novalidate>
        <input type="hidden" name="id" id="id">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Role name') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('role_name') }}" required autocomplete="name" autofocus>                   

                @error('name')
                    <span class="invalid-feedback alert alert-warning" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="permissions[]" class="col-md-2 text-md-right">{{ __('Give permissions') }}</label>
            <div class="col-md-10">
                @foreach($permissions as $permission)
                <div class="d-inline-flex d-md col-md-5">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" name="permissions[]" id="permission-{{$permission->id}}" value="{{$permission->id}}" class="custom-control-input form-inline">
                    <label for="permission-{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                </div>
                </div>
                @endforeach
                <input type="hidden" name="permissions[]" value="9999">
                <input type="hidden" name="_method" value="POST">
                @error('permissions')
                    <span class="invalid-feedback" role="alert">
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