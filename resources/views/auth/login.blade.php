@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="container-fluid h-100 bg-light">
    <div class="d-flex h-100 justify-content-center align-items-center">
        <div class="login-card">
            <div class="card login">
                <!--div class="card-header">{{ __('Login') }}</div-->
                <div class="login-header p-2">
                    <img src="http://static1.squarespace.com/static/5693040d1c1210fdda3bfe69/t/56ace0354d088eb3998c608b/1524776404667/?format=1500w" class="img-fluid" width="100"/>
                    <!--div><b>Hi There,Please Sign in</b></div-->
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback wrong-credentials" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required> 

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback wrong-credentials" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary login-submit">
                                    Sign in&nbsp;
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                                {{-- <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
