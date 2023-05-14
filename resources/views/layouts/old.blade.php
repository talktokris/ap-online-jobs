<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/logo.jpg')}}" style="height:50px;" ></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('home')}}" class="selected"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                        <li><a href=""><i class="fa fa-th-large" aria-hidden="true"></i>Jobs</a></li>
                        <li><a href=""><i class="fa fa-user" aria-hidden="true"></i>Professionals</a></li>
                        <li><a href="{{route('workers')}}" ><i class="fa fa-user" aria-hidden="true"></i>Workers</a></li>
                        <li><a href="{{route('maids')}}" ><i class="fa fa-user" aria-hidden="true"></i>Maids</a></li>
                        <li><a href="" ><i class="fa fa-gift" aria-hidden="true"></i>Packages</a></li>
                        @guest
                        <li><a href="{{route('login')}}"  role="button"><i class="fa fa-lock" aria-hidden="true"></i> Login or Register</a></li>
                        @else
                        <li class='dropdown'>
                            {{-- <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class="userIcon"><i class="fa fa-user"></i></span><i class="fa fa-angle-down class-trigger"></i></a> --}}
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><img class="menu-user-avatar" src="{{Auth::user()->profile->image != '' ? asset('storage/'.Auth::user()->profile->image) :  asset('images/avatar.jpg')}}" alt=""><i class="fa fa-angle-down class-trigger"></i></a>
                            <ul class='dropdown-menu'>
                                <li> <a href='#'><h4>Logged as:  {{ Auth::user()->name }}</h4></a></li>
                                <li role='separator' class='divider'></li>
                                <li><a href="{{route('profile.index')}}">Profile</a></li>
                                <li role='separator' class='divider'></li>
                                <li><a href='#'>Change Password</a></li>
                                <li role='separator' class='divider'></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                                    </a>
                                </li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
        <main>
            @yield('content')
        </main>
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-ends about-text">
                            <h2>ABOUT</h2>
                            <img  src="{{asset('images/footerLogo.png')}}" />
                            <p>Job network services such as candidate services which are free for job seekers; value-added features such as resume writing, highlighting</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-ends contact-footer">
                            <h2>Contact</h2>
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> 
                                    Unit C-6-6-9, 6th Floor , Blok C, SetiaWalk, Persiaran Wawasan,Pusat Bandar Puchong, 47100 Puchong, Selangor Darul Ehsan
                                </li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i>+603-5885 8024</li>
                                <li><i class="fa fa-envelope-o" aria-hidden="true"></i> info@jobnetwork.com.my</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-ends ">
                            <h2>Companies</h2>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Jobs</a></li>
                                <li><a href="#">Professionals</a></li>
                                <li><a href="#">Workers</a></li>
                                <li><a href="#">Maids</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Packages</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-ends">
                            <h2>Subscribe us</h2>
                            <p>Please enter your email address to subscribe to our newsletter</p>
                            <form>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email-address">
                                </div>
                                <button type="submit" class="btn btn-warning btn-block">Subscribe</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <a href="#">© 2018 JobHouse. All Rights Reserved. </a>
                </div>
            </div>
        </footer>
    </div><!--/#app-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script')
</body>
</html>