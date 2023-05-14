@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-image:url('https://static.naukimg.com/s/5/114/i/homePageBanner.png')">
    <div class="container">
        <div class="row verticle-center">
            <div class="col-md-8">
                <h1 class="text-white">
                    <strong><small>Online Jobs</small><br/>Employer Area</strong>
                </h1>
            </div>
            <div class="col-md-4">
                <div class="card mt-4 mb-4">
                    <div class="card-header"><h1>{{ __('Employer Login') }}</h1></div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
    
                            <div class="form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail Address" required>
    
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
    
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
    
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-0 text-center">
                                <button type="submit" class="btn btn-warning btn-block">
                                    {{ __('Login') }}
                                </button>
    
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                            <div class="newuser text-center"> 
                                <p><i class="fa fa-user" aria-hidden="true"></i> New Employer? </p>
                                <a class="btn btn-outline-primary btn-block" href="{{route('employer.register')}}">Register Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection