@extends('layouts.app')

@section('content')
<div class="container signin-container">
    <div class="d-flex justify-content-center">        
        <div class="col-md-6 signin-form">
            <h3>{{ __('Login') }}</h3>
            <form method="POST" action="{{ route('login') }}">
                 @csrf
                <div class="form-group">
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus/>
                    
                    @error('email')
                       <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}"/>
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="form-group row login-row">
                    @if (Route::has('password.request'))
                    <a class="ForgetPwd" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                    <div class="offset-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-remember" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">                    
                    <button type="submit" class="btnSubmit">
                        {{ __('Login') }}
                    </button>
                </div>                
            </form>
        </div>
    </div>
</div>
@endsection