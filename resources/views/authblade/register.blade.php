@extends('layouts.app')

@section('content')
<div class="container register-container">
    <div class="d-flex justify-content-center">        
        <div class="col-md-6 register-form">
            <h3>{{ __('Register') }}</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input id="firs-name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __('First name') }}" value="{{ old('first_name') }}" required autofocus/>
                        
                        @error('first_name')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="last-name" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ __('Last name') }}" value="{{ old('last_name') }}" required autofocus/>
                        
                        @error('last_name')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                        
                        @error('email')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}" required autofocus/>
                        
                        @error('phone')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autofocus/>
                        
                        @error('password')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password-confirmation" name="password_confirmation" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password"/>
                    </div>
                    <!-- End form -->
                    <div class="form-group">
                        <button type="submit" class="btnSubmit">
                            {{ __('Register') }}
                        </button>                        
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
