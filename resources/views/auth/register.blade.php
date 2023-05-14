@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="card auth-form">
                <div class="card-header"><h2>{{ __('Sign up today, its easy!') }}</h2></div>

                <div class="card-body">
                    <form method="POST" action="@auth @if(Auth::user()->hasRole('agent') ){{route('agent.saveuser')}} @endif @else{{ route('register') }} @endauth" aria-label="{{ __('Register') }}">
                        @csrf
                        @auth
                            @if(Auth::user()->hasRole('agent') )
                                <input type="hidden" name="agent_code" value="{{Auth::user()->agent_profile->agent_code}}">
                            @endif
                        @endauth
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Full Name" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="role" class="radio" type="radio" name="role" value="worker" required>
                                </div>
                                <label for="role" class="col-md-10">General Worker</label>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="role" class="radio" type="radio" name="role" value="maid" required>
                                </div>
                                <label for="role" class="col-md-10">Domestic Maid</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="agreement" class="checkbox" type="checkbox" name="agreement" required>
                                </div>
                                <label for="agreement" class="col-md-10">I have read and agree to the<a href="">Terms and Conditions</a> governing the use of onlinejobs.my</label>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
