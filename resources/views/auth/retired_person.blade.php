@extends('layouts.app')
@section('content')
    <main style="margin-top: -40px; background-image: url({{asset('site/img/login.jpg')}});">
        <!-- Background image -->
        <div class="container rejester-form" >
            <div class="row">
                <div class="col-lg-6 col-xl-6 mx-auto">
                    <div class="flex-row my-5 border-0 shadow rounded-3 overflow-hidden ">
                        <div class="card-body p-4 p-sm-4" style="background-color: rgba(255, 255, 255, 0.8) !important;">
                            <form class=" shadow-3-strong p-3" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <!-- Email input -->
                                <h3 class="card-title text-center mb-5">Retired Person Login</h3>
                                <div class="form-outline mb-3">
                                    <input id="name" type="text" name="email" value="" placeholder="Username" required class="form-control" />
                                    <label class="form-label" for="form1Example1">Email address</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-2">
                                    <input type="password" id="name" type="password" name="password" value="" placeholder="Password" required class="form-control" />
                                    <label class="form-label" for="form1Example2">Password</label>
                                </div>
                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-2">
                                    <div class="d-grid mb-2">
                                        <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                            type="submit" style="border-radius: 0px !important;">Login</button>
                                    </div>
                                    <br><br>
                                    <a href="#!">Forgot password?</a>
                                    <div class="col text-center">
                                    </div>
                                    <div class="col d-flex justify-content-center">
                                        Not a member?&nbsp; <a href="{{route('retiredPersonnel.create')}}?type=pro">SignUp </a>
                                    </div>
                                    <!-- Submit button -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image -->
    </main>
@endsection