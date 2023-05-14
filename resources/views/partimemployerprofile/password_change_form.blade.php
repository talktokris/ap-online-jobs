@extends('partimemployerprofile.index')
@section('partimemployerprofiles')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-6">
            <div class="card mt-6 mb-6">
                <div class="card-header"><h2><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Change Password') }}</h2></div>

                <div class="card-body">
                <form method="POST" action="{{route('partimemployerprofile.updatePassword')}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="old_password">{{ __('Old Password') }}</label>
                            <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" placeholder="Old Password" required>

                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
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
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-block" style="background: #E05024">
                                {{ __('Change Password') }}
                            </button>

                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a> --}}
                        </div>
                        {{-- <div class="newuser text-center"><i class="fa fa-user" aria-hidden="true"></i> New User? <a href="{{route('register')}}">Register Here</a></div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection